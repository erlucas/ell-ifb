jQuery.noConflict();
jQuery(document).ready(function($) { 
 
/*-----------------------------------------------------------------------------------*/
/*  Superfish Settings - http://users.tpg.com.au/j_birch/plugins/superfish/
/*-----------------------------------------------------------------------------------*/

  jQuery('nav ul').superfish({
            delay:       100,                             // 300ms delay on mouseout 
            animation:   {opacity:'show',height:'show'},  // fade-in and slide-down animation 
            speed:       'fast',                          // faster animation speed 
            autoArrows:  false,                           // disable generation of arrow mark-up 
            dropShadows: false                            // disable drop shadows 
  });
  jQuery('.main-nav').superfish({
            delay:       500,                             // 300ms delay on mouseout 
            animation:   {opacity:'show',height:'show'},  // fade-in and slide-down animation 
            speed:       'fast',                          // faster animation speed 
            autoArrows:  false,                           // disable generation of arrow mark-up 
            dropShadows: false                            // disable drop shadows 
  });


/*-----------------------------------------------------------------------------------*/
/*  jQuery script for list menu > dropdown select
/*-----------------------------------------------------------------------------------*/
  
      // Create the dropdown base
      jQuery("<select data-placeholder=Select... class=chzn-select />").appendTo("nav");
            
      // Create default option "Go to..."
      jQuery("<option />", {
         "selected": "selected",
         "value"   : "",
         "text"    : "Go to..."
      }).appendTo("nav select");
      // Populate dropdown with menu items
      jQuery("nav a").each(function() {
       var el = jQuery(this);
       jQuery("<option />", {
           "value"   : el.attr("href"),
           "text"    : el.text()
       }).appendTo("nav select");
      });

     // To make dropdown actually work
     // To make more unobtrusive: http://css-triczen.com/4064-unobtrusive-page-changer/
      jQuery("nav select").change(function() {
        window.location = jQuery(this).find("option:selected").val();
      });



/*-----------------------------------------------------------------------------------*/
/*  Slider Setup
/*-----------------------------------------------------------------------------------*/

if( jQuery().flexslider ) {
    jQuery('.flexslider').flexslider({
        animation: "fade",
        slideshowSpeed: 5000,           //Integer: Set the speed of the slideshow cycling, in milliseconds
        animationDuration: 600,         //Integer: Set the speed of animations, in milliseconds
        slideshow: true,             
        touchSwipe: true,                       
        pauseOnHover: true    
    });
}      

/*-----------------------------------------------------------------------------------*/
/*  Contact Form Validation
/*-----------------------------------------------------------------------------------*/
  
  if (jQuery().validate) {
    jQuery("#contact-form").validate();
  }

/*-----------------------------------------------------------------------------------*/
/*  Accordion Shortcode
/*-----------------------------------------------------------------------------------*/
  
  
  jQuery(".toggle").each( function () {
    if(jQuery(this).attr('data-zen-toggle') == 'open') {jQuery(this).accordion({ collapsible: true});
    } else { jQuery(this).accordion({ active: false, collapsible: true }); }
  });
  
  

/*-----------------------------------------------------------------------------------*/
/*  Opacity changes
/*-----------------------------------------------------------------------------------*/

  jQuery(".wp-post-image, .avatar").hover(function() { jQuery(this).animate({ opacity: 0.7 }, 200); }
  ,function () { jQuery(this).animate({ opacity: 1 }, 200); });


/*-----------------------------------------------------------------------------------*/
/*  Tabs Activation
/*-----------------------------------------------------------------------------------*/

  jQuery(".tabs").tabs({fx: { height: 'show', duration: 400 } });
  jQuery("#tabs").tabs({fx: { height: 'show', duration: 400 } });

});

