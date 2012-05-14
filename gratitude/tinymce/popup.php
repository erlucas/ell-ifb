<?php

// loads the shortcodes class, wordpress is loaded with it
require_once( 'shortcodes.class.php' );

// get popup type
$popup = trim( $_GET['popup'] );
$shortcode = new zen_shortcodes( $popup );

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head></head>
<body>
<div id="zen-popup">

	<div id="zen-shortcode-wrap">
		
		<div id="zen-sc-form-wrap">
		
			<div id="zen-sc-form-head">
			
				<?php echo $shortcode->popup_title; ?>
			
			</div>
			<!-- /#zen-sc-form-head -->
			
			<form method="post" id="zen-sc-form">
			
				<table id="zen-sc-form-table">
				
					<?php echo $shortcode->output; ?>
					
					<tbody>
						<tr class="form-row">
							<?php if( ! $shortcode->has_child ) : ?><td class="label">&nbsp;</td><?php endif; ?>
							<td class="field"><a href="#" class="button-primary zen-insert">Insert Shortcode</a></td>							
						</tr>
					</tbody>
				
				</table>
				<!-- /#zen-sc-form-table -->
				
			</form>
			<!-- /#zen-sc-form -->
		
		</div>
		<!-- /#zen-sc-form-wrap -->
		
		<div id="zen-sc-preview-wrap">
		
			<div id="zen-sc-preview-head">
		
				Shortcode Preview
					
			</div>
			<!-- /#zen-sc-preview-head -->
			
			<?php if( $shortcode->no_preview ) : ?>
			<div id="zen-sc-nopreview">Shortcode has no preview</div>		
			<?php else : ?>			
			<iframe src="<?php echo ZEN_TINYMCE_URI; ?>/preview.php?sc=" width="249" frameborder="0" id="zen-sc-preview"></iframe>
			<?php endif; ?>
			
		</div>
		<!-- /#zen-sc-preview-wrap -->
		
		<div class="clear"></div>
		
	</div>
	<!-- /#zen-shortcode-wrap -->

</div>
<!-- /#zen-popup -->

</body>
</html>