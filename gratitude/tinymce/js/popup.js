
// start the popup specefic scripts
// safe to use $
jQuery(document).ready(function($) {
    var zens = {
    	loadVals: function()
    	{
    		var shortcode = $('#_zen_shortcode').text(),
    			uShortcode = shortcode;
    		
    		// fill in the gaps eg {{param}}
    		$('.zen-input').each(function() {
    			var input = $(this),
    				id = input.attr('id'),
    				id = id.replace('zen_', ''),		// gets rid of the zen_ prefix
    				re = new RegExp("{{"+id+"}}","g");
    				
    			uShortcode = uShortcode.replace(re, input.val());
    		});
    		
    		// adds the filled-in shortcode as hidden input
    		$('#_zen_ushortcode').remove();
    		$('#zen-sc-form-table').prepend('<div id="_zen_ushortcode" class="hidden">' + uShortcode + '</div>');
    		
    		// updates preview
    		zens.updatePreview();
    	},
    	cLoadVals: function()
    	{
    		var shortcode = $('#_zen_cshortcode').text(),
    			pShortcode = '';
    			shortcodes = '';
    		
    		// fill in the gaps eg {{param}}
    		$('.child-clone-row').each(function() {
    			var row = $(this),
    				rShortcode = shortcode;
    			
    			$('.zen-cinput', this).each(function() {
    				var input = $(this),
    					id = input.attr('id'),
    					id = id.replace('zen_', '')		// gets rid of the zen_ prefix
    					re = new RegExp("{{"+id+"}}","g");
    					
    				rShortcode = rShortcode.replace(re, input.val());
    			});
    	
    			shortcodes = shortcodes + rShortcode + "\n";
    		});
    		
    		// adds the filled-in shortcode as hidden input
    		$('#_zen_cshortcodes').remove();
    		$('.child-clone-rows').prepend('<div id="_zen_cshortcodes" class="hidden">' + shortcodes + '</div>');
    		
    		// add to parent shortcode
    		this.loadVals();
    		pShortcode = $('#_zen_ushortcode').text().replace('{{child_shortcode}}', shortcodes);
    		
    		// add updated parent shortcode
    		$('#_zen_ushortcode').remove();
    		$('#zen-sc-form-table').prepend('<div id="_zen_ushortcode" class="hidden">' + pShortcode + '</div>');
    		
    		// updates preview
    		zens.updatePreview();
    	},
    	children: function()
    	{
    		// assign the cloning plugin
    		$('.child-clone-rows').appendo({
    			subSelect: '> div.child-clone-row:last-child',
    			allowDelete: false,
    			focusFirst: false
    		});
    		
    		// remove button
    		$('.child-clone-row-remove').live('click', function() {
    			var	btn = $(this),
    				row = btn.parent();
    			
    			if( $('.child-clone-row').size() > 1 )
    			{
    				row.remove();
    			}
    			else
    			{
    				alert('You need a minimum of one row');
    			}
    			
    			return false;
    		});
    		
    		// assign jUI sortable
    		$( ".child-clone-rows" ).sortable({
				placeholder: "sortable-placeholder",
				items: '.child-clone-row'
				
			});
    	},
    	updatePreview: function()
    	{
    		if( $('#zen-sc-preview').size() > 0 )
    		{
	    		var	shortcode = $('#_zen_ushortcode').html(),
	    			iframe = $('#zen-sc-preview'),
	    			iframeSrc = iframe.attr('src'),
	    			iframeSrc = iframeSrc.split('preview.php'),
	    			iframeSrc = iframeSrc[0] + 'preview.php';
    			
	    		// updates the src value
	    		iframe.attr( 'src', iframeSrc + '?sc=' + base64_encode( shortcode ) );
	    		
	    		// update the height
	    		$('#zen-sc-preview').height( $('#zen-popup').outerHeight()-42 );
    		}
    	},
    	resizeTB: function()
    	{
			var	ajaxCont = $('#TB_ajaxContent'),
				tbWindow = $('#TB_window'),
				zenPopup = $('#zen-popup'),
				no_preview = ($('#_zen_preview').text() == 'false') ? true : false;
			
			if( no_preview )
			{
				ajaxCont.css({
					paddingTop: 0,
					paddingLeft: 0,
					height: (tbWindow.outerHeight()-47),
					overflow: 'scroll', // IMPORTANT
					width: 560
				});
				
				tbWindow.css({
					width: ajaxCont.outerWidth(),
					marginLeft: -(ajaxCont.outerWidth()/2)
				});
				
				$('#zen-popup').addClass('no_preview');
			}
			else
			{
				ajaxCont.css({
					padding: 0,
					// height: (tbWindow.outerHeight()-47),
					height: zenPopup.outerHeight()-15,
					overflow: 'hidden' // IMPORTANT
				});
				
				tbWindow.css({
					width: ajaxCont.outerWidth(),
					height: (ajaxCont.outerHeight() + 30),
					marginLeft: -(ajaxCont.outerWidth()/2),
					marginTop: -((ajaxCont.outerHeight() + 47)/2),
					top: '50%'
				});
			}
    	},
    	load: function()
    	{
    		var	zens = this,
    			popup = $('#zen-popup'),
    			form = $('#zen-sc-form', popup),
    			shortcode = $('#_zen_shortcode', form).text(),
    			popupType = $('#_zen_popup', form).text(),
    			uShortcode = '';
    		
    		// resize TB
    		zens.resizeTB();
    		$(window).resize(function() { zens.resizeTB() });
    		
    		// initialise
    		zens.loadVals();
    		zens.children();
    		zens.cLoadVals();
    		
    		// update on children value change
    		$('.zen-cinput', form).live('change', function() {
    			zens.cLoadVals();
    		});
    		
    		// update on value change
    		$('.zen-input', form).change(function() {
    			zens.loadVals();
    		});
    		
    		// when insert is clicked
    		$('.zen-insert', form).click(function() {    		 			
    			if(window.tinyMCE)
				{
					window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, $('#_zen_ushortcode', form).html());
					tb_remove();
				}
    		});
    	}
	}
    
    // run
    $('#zen-popup').livequery( function() { zens.load(); } );
});