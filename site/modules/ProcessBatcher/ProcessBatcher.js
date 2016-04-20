$(document).ready(function(){

	/* GENERAL
	 ***********************************************************************/

	var $form = $("#batcher_form"); 

	// remove scripts, because they've already been executed since we are manipulating the DOM below (WireTabs)
	// which would cause any scripts to get executed twice
	$form.find("script").remove();
	
	//WireTabs	
	$form.WireTabs({
		items : $('#batcher_form > .Inputfields > .InputfieldWrapper')
	});	

	//Submit the right button when we are on the edit screen
	$(document).keypress(function(e){
		edit = $('.WireTabs li:first a').hasClass('on');
		if (e.which == 13 && edit) {
			$('#batcher_search').trigger('click');
		}
	})

	/* EDIT
	 ***********************************************************************/
	
	/**
	 * Change select of actions
	 */
	$('#batcherAction').change(function(){
		var option = $(this).find('option:selected').val();
		$('.batcherAction').closest('li.Inputfield').hide();
		$('#wrap_'+option).show().css('list-style-type', 'none');
	});
	
	/**
	 * Toggle all checkbox in th
	 */
	$('input.toggle_all').click(function(){
		if ($(this).prop('checked')) {
			$('.toggle').prop('checked', true);
		} else {
			$('.toggle').prop('checked', false);
		}
	});
	
	/**
	 * Setup fancybox for page edits
	 */
	var h = $(window).height()-65;
    var w = $(window).width() > 1150 ? 1150 : $(window).width()-100;
	
	$('.batcher_edit').fancybox({
		type : 'iframe',
		frameWidth : w,
		frameHeight : h
	});
	
	/**
	 * Fix for MarkupAdminDataTable: Don't enable sorting on first column
	 */
	if ($.tablesorter != undefined) $.tablesorter.defaults.headers = {0:{sorter:false}};
	

	/* CREATE
	 ***********************************************************************/
	
	$('table.batcher_create tbody').sortable();
	
	/**
	 *  Clone the last tr and set some values for the form elements
	 */
	var clonePageRow = function() {
		$tr = $('table.batcher_create tr:last');
		$clone = $tr.clone();
		$clone.find('input[type=text]').attr('value','');
		var template = $tr.find('option:selected').attr('value');
		if (template) {
			$clone.find('select option[value="'+template+'"]').attr('selected', 'selected');
		}
		$('table.batcher_create').append($clone);
		$clone.find('input:first').focus();
		return false;
	}
	
	$('.batcher_add').click(clonePageRow);
	$(document).bind('keydown', 'ctrl+n', clonePageRow);
	
	/**
	 * Remove a tr
	 */
	 var removeTr = function() {
	 	var $tr = $(this).closest('tr');
		if ($tr.prev('tr').find('input').length) $tr.remove();
		return false;	 	 				 
	 };

	if ($.isFunction($(document).on)) {
	    $(document).on('click', '.remove_page', removeTr);
	} else {
	    $('.remove_page').live('click', removeTr);
	} 	

		
	/**
	 * Modify checkboxes which are not checked to hidden fields, sending the value "0"
	 */
	$('#create_pages').click(function(){
		//Set checkbox type to hidden if not checked to make sure a value gets send
		$('input[type=checkbox]').each(function(){
			$checkbox = $(this);
			if (!$checkbox.prop('checked')) {
				var name = $checkbox.attr('name');
				$checkbox.replaceWith('<input type="hidden" name="'+name+'" value="0">');
			}
		});
	});
		
});