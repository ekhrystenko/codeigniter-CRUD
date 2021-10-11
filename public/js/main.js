$(document).ready(function () {


	// $("#datepicker").datepicker();
	// $('#datepicker').datepicker( {
	// 	changeMonth: true,
	// 	changeYear: true,
	// 	showButtonPanel: true,
	// 	dateFormat: 'MM yy',
	// 	onClose: function(dateText, inst) {
	// 		var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
	// 		var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
	// 		$(this).datepicker('setDate', new Date(year, month, 1));
	// 	}
	// });
	$("#datepicker").datepicker({
		showOn: "button",
		buttonImage: "https://snipp.ru/demo/437/calendar.gif",
		buttonImageOnly: true,
		beforeShowDay: disableDaysExceptFirst,
		dateFormat: 'mm-yy'
	})

	function disableDaysExceptFirst(date) {
		if (date.getDate() != 1) {
			return [false, date.getDate().toString() + "_day"];
		}
		return [true, ""];
	}


	const LockButton =  {

		$element: $('#send'),

		lock(status = false) {
			this.$element.attr('disabled', status);
		}
	}
	const Error =  {

		$element: $('.error'),

		show(text = 'Заполните поле!', color = 'red') {
			this.$element.show().text(text).css({'color': color});
		},
		hide(){
			this.$element.hide();
		}
	}


	$('#form').on('submit', function (e) {
		e.preventDefault();

		let search = $('input[name=search]').val();
		let date = $('input[name=date]').val();

		if (search == '') {
			Error.show();
			$('#table').hide()
			return;
		}

		LockButton.lock(true);
		$('#table tbody').empty();

		$.ajax({
			url: '/main/getResult',
			type: 'get',
			data: {search: search, date: date},
			dataType: 'json',
			success: function (data) {
				console.log(data.query)
				LockButton.lock();
				Error.hide();

				if (data.query.length > 0) {
					data.query.forEach((row) =>
						$('#table tbody').append(`
							<tr>
								<td>${row.id}</td>
								<td>${row.name}</td>
								<td>${row.email}</td>
								<td>${row.role_name}</td>
							</tr>
						`)
					);

					$('#table').show();
				} else {
					$('#table').hide();
					Error.show('Ничего не найдено!', 'black');
				}
			}
		});
	});

	$('#showModal').click(function () {
		$('#createModal').modal('show');

		$.ajax({
			url: '/main/create',
			type: 'post',
			data: {},
			dataType: 'json',
			success: function (response) {
				console.log(response)
				$('#response').html(response['html']);
			}
		})
	});

	$('body').on('submit', '#createForm', function (e) {
		e.preventDefault();

		$.ajax({
			url: '/main/store',
			type: 'post',
			data: $(this).serializeArray(),
			dataType: 'json',
			success: function (response) {

				if (response.status == 0) {
					if ($(response.name == '')) {
						$('.nameError').html(response.name).addClass('invalid-feedback d-block')
						// $('input[name=name]').addClass('is-invalid')
					} else {
						$('.nameError').html('').removeClass('invalid-feedback d-block')
						$('input[name=name]').removeClass('is-invalid')
					}

					if ($(response.email == '')) {
						$('.emailError').html(response.email).addClass('invalid-feedback d-block')
						// $('#email').addClass('is-invalid')
					} else {
						$('.emailError').html('').removeClass('invalid-feedback d-block')
						$('input #email').removeClass('is-invalid')
					}

					if ($(response.role == '')) {
						$('.roleError').html(response.role).addClass('invalid-feedback d-block')
						// $('#role').addClass('is-invalid')
					} else {
						$('.roleError').html('').removeClass('invalid-feedback d-block')
						$('#role').removeClass('is-invalid')
					}
				} else {
					$('#createModal').modal('hide')
				}
			}
		});
	});
});
