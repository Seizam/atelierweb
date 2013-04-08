function isiPhone(){
    return (
        (navigator.platform.indexOf("iPhone") != -1) ||
        (navigator.platform.indexOf("iPod") != -1)
    );
}

var $j = jQuery.noConflict();

function isTooLightYIQ(hexcolor){
	var r = parseInt(hexcolor.substr(0,2),16);
	var g = parseInt(hexcolor.substr(2,2),16);
	var b = parseInt(hexcolor.substr(4,2),16);
	var yiq = ((r*299)+(g*587)+(b*114))/1000;
	return yiq >= 128;
}

$j.fn.getIndex = function(){
	var $jp=$j(this).parent().children();
    return $jp.index(this);
}

$j.fn.setNav = function(){
	$j('#main_menu li ul').css({display: 'none'});

	$j('#main_menu li').each(function()
	{	
		var $jsublist = $j(this).find('ul:first');
		
		$j(this).hover(function()
		{	
			position = $j(this).position();
			
			if($j(this).parents().attr('class') == 'sub-menu')
			{	
				$jsublist.css({top: position.top+'px'});
				$jsublist.stop().css({height:'auto', display:'none'}).slideDown(200);
			}
			else
			{
				$jsublist.stop().css({overflow: 'visible', height:'auto', display:'none'}).slideDown(400);
				
				if(BrowserDetect.browser == 'Explorer' && BrowserDetect.version < 8)
 				{
 					hackMargin = -$j(this).width()-2;
					$jsublist.css({marginLeft: hackMargin+'px'});
				}
			}
		},
		function()
		{	
			$jsublist.stop().css({height:'auto', display:'none'}).slideUp(200);	
		});

	});
	
	$j('#menu_wrapper .nav ul li ul').css({display: 'none'});

	$j('#menu_wrapper .nav ul li').each(function()
	{
		
		var $jsublist = $j(this).find('ul:first');
		
		$j(this).hover(function()
		{	
			if(BrowserDetect.browser == 'Explorer' && BrowserDetect.version < 8)
 			{
 				$jsublist.css({top: position.top+'px'});		
 			}
 			else
 			{
 				$jsublist.css({top: position.top+'px'});
 			}
		
			$jsublist.stop().css({height:'auto', display:'none'}).slideDown(200);	
		},
		function()
		{	
			$jsublist.stop().css({height:'auto', display:'none'}).slideUp(200);	
		});		
		
	});
}

$j(document).ready(function(){ 

	$j(document).setNav();
	
	$j('.img_frame').fancybox({
	    helpers:  {
	        overlay : {
	            css : {
	                'background-color' : '#000'
	            }
	        }
	    }
	});
	
	$j('.pp_gallery a').fancybox({
	    helpers:  {
	        overlay : {
	            css : {
	                'background-color' : '#000'
	            }
	        }
	    }
	});
	
	$j('.flickr li a').fancybox({
	    helpers:  {
	        overlay : {
	            css : {
	                'background-color' : '#000'
	            }
	        }
	    }
	});
	
	$j('.lightbox').fancybox({
	    helpers:  {
	        overlay : {
	            css : {
	                'background-color' : '#000'
	            }
	        }
	    }
	});
	
	$j('.lightbox_youtube').fancybox({
		scrolling: 'no',
	    helpers:  {
	        overlay : {
	            css : {
	                'background-color' : '#000'
	            }
	        }
	    }
	});
	
	$j('.lightbox_vimeo').fancybox({
		scrolling: 'no',
	    helpers:  {
	        overlay : {
	            css : {
	                'background-color' : '#000'
	            }
	        }
	    }
	});
	
	$j('.lightbox_iframe').fancybox({
		type : 'iframe',
	    helpers:  {
	        overlay : {
	            css : {
	                'background-color' : '#000'
	            }
	        }
	    }
	});
	
	$j('a[rel=gallery]').fancybox({
	    helpers:  {
	        overlay : {
	            css : {
	                'background-color' : '#000'
	            }
	        }
	    }
	});
	
	if(BrowserDetect.browser == 'Explorer' && BrowserDetect.version < 8)
	{
		var zIndexNumber = 1000;
		$j('div').each(function() {
			$j(this).css('zIndex', zIndexNumber);
			zIndexNumber -= 10;
		});

		$j('#thumbNav').css('zIndex', 1000);
		$j('#thumbLeftNav').css('zIndex', 1000);
		$j('#thumbRightNav').css('zIndex', 1000);
		$j('#fancybox-wrap').css('zIndex', 1001);
		$j('#fancybox-overlay').css('zIndex', 1000);
	}
	
	$j(".pp_accordion_close").accordion({ active: 1, collapsible: true, clearStyle: true });
	
	$j(".pp_accordion").accordion({ active: 0, collapsible: true, clearStyle: true });
	
	$j(".tabs").tabs();
	
	var footerLi = 0;
	$j('#footer .sidebar_widget li.widget').each(function()
	{
		footerLi++;
		
		if(footerLi%$j('#pp_footer_style').val() == 0)
		{ 
			$j(this).addClass('last');
		}
	});
		
	$j.validator.setDefaults({
		submitHandler: function() { 
		    var actionUrl = $j('#widget_contact_form').attr('action');
		    
		    $j.ajax({
  		    	type: 'GET',
  		    	url: actionUrl,
  		    	data: $j('#widget_contact_form').serialize(),
  		    	success: function(msg){
  		    		$j('#widget_contact_form').hide();
  		    		$j('#reponse_msg').html(msg);
  		    	}
		    });
		    
		    return false;
		}
	});
		    
		
	$j('#widget_contact_form').validate({
		rules: {
		    your_name: "required",
		    email: {
		    	required: true,
		    	email: true
		    },
		    message: "required"
		},
		messages: {
		    your_name: "Please enter your name",
		    email: "Please enter a valid email address",
		    agree: "Please enter some message"
		}
	});
    
    $j('pre').each(function()
	{
		preContent = $j(this).html();
	});
 	
 	$j(".reflection").reflect();
	
	$j('.post_img').hover(function(){ 
		$j(this).animate({ opacity: 0.5 }, 300);
	},
	function()
	{	
		$j(this).animate({ opacity: 1 }, 300);
	});
	
	$j('.portfolio200_shadow').hover(function(){ 
		$j(this).find('.portfolio200_overlay').animate({ opacity: 1 }, 300);
		$j(this).parent('div').find('.portfolio_desc').addClass('hover');
	},
	function()
	{	
		$j(this).find('.portfolio200_overlay').animate({ opacity: 0 }, 100);
		$j(this).parent('div').find('.portfolio_desc').removeClass('hover');
	});
	
	$j('.portfolio642_shadow').hover(function(){ 
		$j(this).find('.portfolio642_overlay').animate({ opacity: 0.7 }, 400);
		$j(this).find('.portfolio642_overlay img').animate({ left: '0' }, 200);
	},
	function()
	{	
		$j(this).find('.portfolio642_overlay').animate({ opacity: 0 }, 400);
		$j(this).find('.portfolio642_overlay img').animate({ left: '100%' }, 200, function(){
			$j(this).css('left', '-100%');
		});
	});
	
	$j('.portfolio480_shadow').hover(function(){ 
		$j(this).find('.portfolio480_overlay').animate({ opacity: 0.7 }, 400);
	},
	function()
	{	
		$j(this).find('.portfolio480_overlay').animate({ opacity: 0 }, 400);
	});
	
	$j('.portfolio460_shadow').hover(function(){ 
		$j(this).find('.portfolio460_overlay').animate({ opacity: 1 }, 300);
		$j(this).parent('div').find('.portfolio_desc').addClass('hover');
	},
	function()
	{	
		$j(this).find('.portfolio460_overlay').animate({ opacity: 0 }, 100);
		$j(this).parent('div').find('.portfolio_desc').removeClass('hover');
	});
	
	$j('.portfolio220_shadow').hover(function(){ 
		$j(this).find('.portfolio220_overlay').animate({ opacity: 0.7 }, 400);
	},
	function()
	{	
		$j(this).find('.portfolio220_overlay').animate({ opacity: 0 }, 400);
	});
	
	$j('.portfolio305_shadow').hover(function(){ 
		$j(this).find('.portfolio305_overlay').animate({ opacity: 1 }, 300);
		$j(this).parent('div').find('.portfolio_desc').addClass('hover');
	},
	function()
	{	
		$j(this).find('.portfolio305_overlay').animate({ opacity: 0 }, 100);
		$j(this).parent('div').find('.portfolio_desc').removeClass('hover');
	});
	
	$j('.portfolio195_shadow').hover(function(){ 
		$j(this).find('.portfolio195_overlay').animate({ opacity: 1 }, 300);
		$j(this).parent('div').find('.portfolio_desc').addClass('hover');
	},
	function()
	{	
		$j(this).find('.portfolio195_overlay').animate({ opacity: 0 }, 100);
		$j(this).parent('div').find('.portfolio_desc').removeClass('hover');
	});
	
	$j('.post_shadow_link').hover(function(){ 
		$j(this).find('.post_shadow_overlay').animate({ opacity: 0.7 }, 400);
	},
	function()
	{	
		$j(this).find('.post_shadow_overlay').animate({ opacity: 0 }, 400);
	});
	
	$j('#option_btn').click(
    	function() {
    		if($j('#option_wrapper').css('left') != '0px')
    		{
 				$j('#option_wrapper').animate({"left": "0px"}, { duration: 800 });
	 			$j(this).animate({"left": "240px"}, { duration: 800 });
	 		}
	 		else
	 		{
	 			$j('#option_wrapper').animate({"left": "-245px"}, { duration: 800 });
    			$j('#option_btn').animate({"left": "0px"}, { duration: 800 });
	 		}
    	}
    );
	
	$j('#menu_wrapper .nav ul li a, #menu_wrapper div .nav li a, .portfolio-content a').each( function() {
	    var $jthis = $j(this);
	    $jthis.data('title',$jthis.attr('title'));
	    $jthis.removeAttr('title');
	});
	
	// Create the dropdown base
	$j("<select />").appendTo("#menu_border_wrapper");
	
	// Create default option "Go to..."
	$j("<option />", {
	   "selected": "selected",
	   "value"   : "",
	   "text"    : "- Main Menu -"
	}).appendTo("#menu_border_wrapper select");
	
	// Populate dropdown with menu items
	$j(".nav li").each(function() {
	 var current_item = $j(this).hasClass('current-menu-item'); 
	 var el = $j(this).children('a');
	 var menu_text = el.text();

	 if($j(this).parent('ul.sub-menu').length > 0)
	 {
	 	menu_text = "- "+menu_text;
	 }
	 
	 if($j(this).parent('ul.sub-menu').parent('li').parent('ul.sub-menu').length > 0)
	 {
	 	menu_text = el.text();
	 	menu_text = "- - "+menu_text;
	 }
	 
	 if(current_item)
	 {
	 	$j("<option />", {
	 		 "selected": "selected",
	    	 "value"   : el.attr("href"),
	    	 "text"    : menu_text
		 }).appendTo("#menu_border_wrapper select");
	 }
	 else
	 {
	 	$j("<option />", {
	     	"value"   : el.attr("href"),
	     	"text"    : menu_text
	 	}).appendTo("#menu_border_wrapper select");
	 }
	});
	
	$j("#menu_border_wrapper select").change(function() {
  		window.location = $j(this).find("option:selected").val();
	});
	
	$j("#pp_font").change(function(){
	    $j("#pp_font_family").attr('value', $j("#pp_font option:selected").attr('data-family'));
	
	    var ppCufonFont = 'http://fonts.googleapis.com/css?family='+$j(this).attr('value');
	    $j('#google_fonts-css').attr('href', ppCufonFont);
	    
	    $j.ajax({
  			type: 'GET',
  			url: $j('#form_option').attr('action'),
  			data: 'pp_font='+$j("#pp_font option:selected").attr('value')+'&pp_font_family='+$j("#pp_font option:selected").attr('data-family'),
  			success: function(){
   				if(pp_pattern == '')
				{
					location.href = location.href;
				}
  			}
		});
	    
	    if($j("#pp_font option:selected").attr('data-family') != '')
	    {
	    	$j('h1, h2, h3, h4, h5, h6').css('font-family', '"'+$j("#pp_font option:selected").attr('data-family')+'"');
	    }
	    else
	    {
	    	$j('h1, h2, h3, h4, h5, h6').css('font-family', 'Helvetica Neue');
	    }
	});
	
	var windowWidth = $j(window).width();
	var $jcontainer = $j('#portfolio_filter_wrapper');
	var $jportfolioColumn = $j('#pp_portfolio_columns').attr('value');
	var columnValue = 0;
	
	if(windowWidth > 500)
	{
		columnValue = $jcontainer.width() / $jportfolioColumn;
	}
	else
	{
		columnValue = $jcontainer.width() / 2;
	}
	// initialize isotope
	$jcontainer.isotope({
		resizable: false,
		masonry: { columnWidth: columnValue }
	});
	
	$j(window).smartresize(function(){
		var windowWidth = $j(window).width();
	
		if(windowWidth > 480)
		{
			columnValue = $jcontainer.width() / $jportfolioColumn;
		}
		else
		{
			columnValue = $jcontainer.width() / 2;
		}
	
		$jcontainer.isotope({
	    	// update columnWidth to a percentage of container width
	    	masonry: { columnWidth: columnValue }
	    });
	});
	
	// filter items when filter link is clicked
	$j('#portfolio_filters li a').click(function(){
	  	var selector = $j(this).attr('data-filter');
	  	$jcontainer.isotope({ filter: selector });
	  	$j('#portfolio_filters li a').removeClass('active');
	  	$j(this).addClass('active');
	  	return false;
	});
	
	$j('#searchform input[type=text]').attr('title', 'Enter keywords...');
	$j('input[title!=""]').hint();
	
	$j('.ajax_portfolio_link').click(
    	function() {
    		if($j('#pp_is_portfolio_open').attr('value')==0)
    		{
    			var targetDiv = $j(this).attr('data-rel');
    			
    			$j('#ajax_'+targetDiv).css({overflow: 'visible', height:'auto', display:'none'}).slideDown(1000);
		
			    $j('html, body').animate({
				    scrollTop: $j('#ajax_'+targetDiv).offset().top-10
				}, 1000);
				
				$j('#pp_is_portfolio_open').attr('value', 1);
    		}
    		else
    		{
	    		$j('.ajax_portfolio_wrapper').stop().slideUp(1000);	
	    	
		    	var targetDiv = $j(this).attr('data-rel');
		    	
		    	setTimeout(function(){
				    $j('#ajax_'+targetDiv).css({overflow: 'visible', height:'auto', display:'none'}).slideDown(1000);
		
			        $j('html, body').animate({
				        scrollTop: $j('#ajax_'+targetDiv).offset().top-10
				    }, 1000);
				    
				    $j('#pp_is_portfolio_open').attr('value', 1);
				}, 1000);
			}
    	}
    );
    
    $j('.ajax_portfolio_direction').click(
    	function() {
    		$j('.ajax_portfolio_wrapper').stop().slideUp(1000);	
    	
    		var targetDiv = $j(this).attr('data-rel');
    		
    		setTimeout(function(){
				$j('#ajax_'+targetDiv).css({overflow: 'visible', height:'auto', display:'none'}).slideDown(1000);

	    		$j('html, body').animate({
				    scrollTop: $j('#ajax_'+targetDiv).offset().top-10
				}, 1000);
				
				$j('#pp_is_portfolio_open').attr('value', 1);
			}, 1000);
    	}
    );
    
    $j('.ajax_close').click(
    	function() {
    		var targetDiv = $j(this).attr('data-rel');
    		$j('#ajax_'+targetDiv).stop().slideUp(600);
    		
    		$j('html, body').animate({
			    scrollTop: 0
			}, 800);
			
			$j('#pp_is_portfolio_open').attr('value', 0);
    	}
    );

});