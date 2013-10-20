$(document).ready(function(){
	$('.clear-form').on('click', function() {
		$formId = $(this).closest('form').attr('id');
		$clearingClass = $(this).data('clearing-class');
		$(":input."+$clearingClass, "#"+$formId).not(':button, :submit, :reset, :hidden').val('').removeAttr('checked').removeAttr('selected');
	});
	
	$(".btn-user-note-edit").click(function () {
		if ($(".form-user-note-edit").length > 0) {
			$(".form-user-note-edit #UserNoteId").val($(this).data('id'));
			$(".form-user-note-edit #UserNoteSummary").val($(this).data('summary'));
			$(".form-user-note-edit #UserNoteDescription").val($(this).data('description'));
			return false;
		}
	});
	
	$(".form-user-note-edit button[data-type='reset']").click(function () {
		$(".form-user-note-edit #UserNoteId").val('');
		$(".form-user-note-edit #UserNoteSummary").val('');
		$(".form-user-note-edit #UserNoteDescription").val('');
		return false;
	});
});