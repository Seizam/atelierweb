define [
   'cs!apps/pteApp'
   'cs!jcrop-api'
   'cs!jquery'
   'cs!settings'
], (app, jcrop, $, settings) ->
   app.controller "CropCtrl", ['$scope','$log', ($scope, $log) ->
      $scope.$watch 'pteCropSave', (x,y) ->
         if x is y
            return

         update_options =
            'pte-action': 'change-options'
            'pte_crop_save': if $scope.pteCropSave then 'true' else 'false'
         $log.log update_options

         updated = $scope.thumbnailResource.get update_options, ->
            $log.log "Updated options"
         return

      $scope.$watch 'aspectRatio', ->
         ar = $scope.aspectRatio || null
         jcrop.setOptions
            aspectRatio: ar
         return

      $scope.changeAR = ->
         $scope.userChanged = true

      $scope.toggleOptions = ->
         $scope.cropOptions = !$scope.cropOptions
         if !$scope.cropOptions
            $scope.aspectRatio = null
            $scope.userChanged = false
            $scope.updateSelected()
         return

      ###
      # Change the AspectRatio based on the selected thumbnails
      #
      # This will create some interesting issues with the new option that
      # allows the user to manually set the aspectRatio, so I need to step
      # through the different options and it would be a good idea to actually
      # create some sort of a unit test to verify that they actually work.
      #
      # 1. If the user has previously selected an AR, this is the default AR
      #    until the user closes the options. If the user clears the AR
      #    manually with the refresh button, respect that.
      #
      # 2. If wordpress' crop setting is set then set the AR.
      #
      # 3. In order to set the AR, each selected thumbnail needs to have the
      #    same AR.
      #
      # 4. For the default AR:
      #    if all the thumbnails have the same crop use it.
      #    else width/height
      #
      ###
      $scope.updateSelected = ->
         $scope.setInfoMessage null
         # Respect the user setting (#1)
         if $scope.userChanged
            return

         ar = null
         try
            selected = false
            allCrop = null
            for thumbnail in $scope.thumbnails
               # Get the crop/width/height and convert to numerals
               {crop, width, height} = thumbnail
               crop = +crop
               width = +width
               height = +height
               tmp_ar = width/height

               if thumbnail.selected
                  selected = true

               # Check if all the thumbnails have the same crop
               if crop > 0
                  if allCrop is null
                     allCrop = tmp_ar
                  else if allCrop > 0 and allCrop != tmp_ar
                     allCrop = -1

               # Check Wordpress Crop setting (#2)
               if thumbnail.selected and crop > 0
                  # Every AR should be the same (#3)
                  if ar isnt null and ar != tmp_ar
                     throw "PTE_EXCEPTION"
                  ar = tmp_ar

            # (#4) Set the default
            if ar is null and selected is false
               if allCrop isnt null and allCrop > 0
                  ar = allCrop
               else
                  ar = settings.width/settings.height
         catch error
            $scope.setInfoMessage $scope.i18n.crop_problems
            $scope.aspectRatio = null
            return

         $scope.aspectRatio = ar
         return # end updateSelected

      ###
      # Submit Crop to server
      ###
      $scope.submitCrop = ->
         if $scope.cropInProgress
            return
         $scope.cropInProgress = true
         # Check that there are thumbnails actually selected...
         selected_thumbs = $.map $scope.thumbnails, (thumb, i) ->
            if thumb.selected
               return thumb.name
            else
               return null
         if selected_thumbs.length is 0
            $scope.setErrorMessage $scope.i18n.no_t_selected
            $log.error $scope.i18n.no_t_selected
            $scope.cropInProgress = false
            return

         {x, y, w, h, x2, y2} = jcrop.tellSelect()
         if x is 0 and
         y is 0 and
         w is 0 and
         h is 0 and
         x2 is 0 and
         y2 is 0
            $scope.setErrorMessage $scope.i18n.no_c_selected
            $log.error $scope.i18n.no_c_selected
            $scope.cropInProgress = false
            return

         crop_options =
            'pte-action': 'resize-images'
            'id': settings.id
            'pte-sizes': selected_thumbs
            'w':w
            'h':h
            'x':x
            'y':y

         if $scope.pteCropSave
            crop_options['save'] = 'true'

         crop_results = $scope.thumbnailResource.get crop_options, ->
            $scope.cropInProgress = false

            if crop_results?.immediate
               return $scope.confirmResults crop_results

            $scope.setNonces
               'pte-nonce': crop_results['pte-nonce']
               'pte-delete-nonce': crop_results['pte-delete-nonce']

            $.each $scope.thumbnails, (i, thumb) ->
               if crop_results.thumbnails[thumb.name]
                  proposed =
                     url: crop_results.thumbnails[thumb.name].url
                     file: crop_results.thumbnails[thumb.name].file
                  thumb.proposed = proposed
                  thumb.showProposed = true
               return
            $scope.view on
            return

         return # end submitCrop

      #$scope.thumbnailObject = $scope.thumbnailResource.get {id: id}, ->

      # For Crop and Save
      $scope.cropText = ->
         if $scope.pteCropSave is on
            return $scope.i18n.cropSave
         return $scope.i18n.crop

      ###
      # Listener
      ###
      $scope.$on 'thumbnail_selected', (event) ->
         $scope.updateSelected()
         return

      $scope.updateSelected()
      return
   ]
   return app
