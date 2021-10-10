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

		let name = $('input[name=name]').val();
		let date = $('input[name=date]').val();

		if (name == '') {
			Error.show();
			$('#table').hide()
			return;
		}

		LockButton.lock(true);
		$('#table tbody').empty();

		$.ajax({
			url: '/main/getResult',
			type: 'get',
			data: {name: name, date: date},
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
});
