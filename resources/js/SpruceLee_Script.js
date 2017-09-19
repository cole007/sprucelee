/**
 * Spruce Lee plugin for Craft CMS
 *
 * Spruce Lee JS
 *
 * @author    @cole007
 * @copyright Copyright (c) 2017 @cole007
 * @link      http://ournameismud.co.uk/
 * @package   SpruceLee
 * @since     1.0.0
 */

 $(function() {
	$('form').on('click','.all.checkbox',function(e) {
		// e.preventDefault();

		var status = $(this).filter(':checkbox:checked').length;
		var fields = $(this).parent('.field.checkboxfield').siblings('.field.checkboxfield');
		if (status == 1) {
			$(fields).find('.checkbox').attr('checked',true);
		} else {
			$(fields).find('.checkbox').attr('checked',false);
		}
	});
});