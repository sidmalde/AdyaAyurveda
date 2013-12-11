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
	
	if($('#bottom-shade .alert:not(#cookies-alert)').length > 0){
		animBottomMargin();
		$('#bottom-shade .alert:not(#cookies-alert)').addClass('timed-from-start');
		setTimeout(function() {
			$('#bottom-shade .alert.timed-from-start').remove();
			animBottomMargin();
		}, 7500);
	}
	$('#bottom-shade').on('click', '.alert .close', function(e){
		var closingElem = $(e.currentTarget).closest('.alert');
		// the folllowing line is different than animBottomMargin();
		$('#container').animate({paddingBottom: $('#bottom-shade').outerHeight()-closingElem.outerHeight() + parseInt($('#bottom-shade').css('marginBottom').replace('px', '')) +'px'}, 500);
	});
	
	// DataTables
	if($('.datatable').length > 0){
		try{
			$.getScript('/js/jquery.dataTables.min.js').done(function(){
				$.getScript('/js/DT_bootstrap.js');
			});
		} catch(e){
			console.log('datatables js failed');
		}
	}
});

function animBottomMargin(){
	$('#container').animate({paddingBottom: $('#bottom-shade').outerHeight() + parseInt($('#bottom-shade').css('marginBottom').replace('px', '')) +'px'}, 500);
}