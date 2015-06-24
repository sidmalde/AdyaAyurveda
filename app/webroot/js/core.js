$(document).ready(function(){
	/*if ($( "#datepicker" ).length > 0) {
		$( "#datepicker" ).datepicker();
	}*/
	
	$('input.input-file-real').change(function() {
		$fakeInput = $(this).data('fake-input');
		$('#'+$fakeInput).val($(this).val().replace("C:\\fakepath\\", ""));
	});
	
	$('.input-file-real-clear').click(function() {
		$realInput = $(this).data('real-input');
		$fakeInput = $(this).data('fake-input');
		$('#'+$realInput).val('');
		$('#'+$fakeInput).val('');
	});
	
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
	
	if($('#map-canvas').length > 0){
		initializeMap();
	}
	
	if($('.viewMap').length > 0){
		$('.viewMap').click(function(){
			goToAddress($(this).data('latlng'));
		});
		$('.viewMap:first').click();
	}
	
	$('.datetimepicker').datetimepicker({
		format: 'DD-MM-YYYY H:mm',
	});
	
	$('.datepicker').datetimepicker({
		format: 'DD MM YYYY',
	});
	
	if ($("#bookingsCalendar").length > 0) {
		$('#bookingsCalendar').fullCalendar({
			header: {
				left: 'title',
				center: '',
				right: 'today, prev,next, agendaDay,agendaWeek,month'
			},
			/* height: 600, */
			defaultView: 'month',
			editable: true,
			timeFormat: 'H(:mm)',
			agenda: 'H:mm{ - H:mm}', // 5:00 - 6:30 // for agendaWeek and agendaDay
			'': 'H(:mm)t',            // for all other views
			/* month: 'MMMM yyyy',                             // September 2009 */
			titleFormat: {
				month: 'MMM YYYY',
				week: "D MMM YY", // Sep 7 - 13 2009
				day: 'D MMM, YYYY',
			},
			columnFormat : {
				month: 	"ddd",
				week: 	"ddd D MMM", // Sep 7 - 13 2009
				day:	"ddd D MMM",
			},
			eventSources: 'http://dev.adya-ayurveda.com/cfeed',
			events: function(start, end, callback) {
				start = moment(start).format('YYYY-MM-DD HH:mm:ss');
				end = moment(end).format('YYYY-MM-DD HH:mm:ss');
				
				$data = '';
				$.ajax({
					url: '/cfeed', // use the `url` property
					type: 'POST',
					data: {
						'start': start,
						'end': end,
					},
					dataType: 'json',
					success: function($data) {
						console.log($data);
						for(var propt in $data){
							$event = $data[propt];
							$event['start'] = moment($event['start']).format();
							$event['end'] = moment($event['end']).format();
							$('#bookingsCalendar').fullCalendar( 'renderEvent', $event);
						}
					},
					error: function(a, b, c) {
						console.log(a);
						console.log(b);
						console.log(c);
						
					},
					textColor: '#CCC' // a non-ajax option
				});
			},
			/* dayClick: function(date, allDay, jsEvent, view) {

				if (allDay) {
					alert('Clicked on the entire day: ' + date);
				}else{
					alert('Clicked on the slot: ' + date);
				}

			},
			eventResize: function(event,dayDelta,minuteDelta,revertFunc) {
				if (!confirm("The end date of " + event.title + "has been moved " + dayDelta + " days and " + minuteDelta + " minutes. Is this okay?")) {
					revertFunc();
				} else {
					event.newEnd 	= $.fullCalendar.formatDate($.fullCalendar.parseDate( event.end ), 'yyyy-MM-dd HH:mm:ss');
					event.minuteChange = minuteDelta;
					event.dayChange = dayDelta;
					event.minuteChange = minuteDelta;
					$.ajax({
						url: '/update-event', // use the `url` property
						type: 'POST',
						data: event,
						// dataType: 'json',
						success: function($data) {
							
						},
						error: function(a, b, c) {
							console.log(a);
							console.log(b);
							console.log(c);
							
						},
						color: 'blue',   // a non-ajax option
						textColor: '#CCC' // a non-ajax option
					});
				}
			},
			eventDrop: function(event,dayDelta) {
				console.log(event);
				console.log(dayDelta);

				var $minutes = (dayDelta._milliseconds / 1000) / 60;
				var $hours = $minutes / 60;
				var $days = dayDelta._days;
				
				console.log($minutes);
				console.log($hours);
				console.log($days);

				return;
				if (!confirm(event.title + " was moved " + dayDelta + " days and " + minuteDelta + " minutes. Is this okay?")) {
					revertFunc();
				} else {
					
					event.changeInHours = $hours;
					event.dayChange = dayDelta;
					event.minuteChange = minuteDelta;
					$.ajax({
						url: '/system-management/appointments/'+event.id+'/edit', // use the `url` property
						// url: 'http://londonvipgroup.dev.gurusols.com/update-event', // use the `url` property
						type: 'POST',
						data: event,
						// dataType: 'json',
						success: function($data) {
							console.log($data);
						},
						error: function(a, b, c) {
							console.log(a);
							console.log(b);
							console.log(c);
						},
						// color: 'blue',   // a non-ajax option
						// textColor: '#CCC' // a non-ajax option
					});
				}
			}, */
			eventClick: function(calEvent, jsEvent, view) {
				$('#viewAppointmentModal').removeData("modal");
				$.ajax({
					url: '/system-management/appointments/quick-view/'+calEvent.id,
					success: function (data) {
						$("#viewAppointmentModal").html(data);
					}
				});

				$("#viewAppointmentModal").modal({
					show: true
				});
			}
	    });
	}
});

function animBottomMargin(){
	$('#container').animate({paddingBottom: $('#bottom-shade').outerHeight() + parseInt($('#bottom-shade').css('marginBottom').replace('px', '')) +'px'}, 500);
}

var geocoder;
var map;
function initializeMap() {
	geocoder = new google.maps.Geocoder();
	var myLatlng = new google.maps.LatLng('51.618047', '-0.311307');
	var mapOptions = {
		center: myLatlng,
		zoom: 14,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
	var marker = new google.maps.Marker({
		position: myLatlng,
		map: map,
	});
}

function goToAddress($address) {
	geocoder.geocode( { 'address': $address}, function(results, status) {
		if (status == google.maps.GeocoderStatus.OK) {
			map.setCenter(results[0].geometry.location);
			var marker = new google.maps.Marker({
				map: map,
				position: results[0].geometry.location,
			});
		} else {
			alert('Geocode was not successful for the following reason: ' + status);
		}
	});
}