$(document).ready(function () {

	const Redirect = {

		redirect(response){
			window.setTimeout(function(){
				window.location.href = response;
			}, 2000)
		},

	}

	const LockButton =  {

		$element: $('#send'),

		lock(status = false) {
			this.$element.attr('disabled', status);
		}
	}

	const Loader =  {

		$element: $('#loading'),

		show() {
			this.$element.show();
		},

		hide(){
			this.$element.hide();
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

		Loader.show();
		LockButton.lock(true);
		$('#table tbody').empty();

		$.ajax({
			url: '/user_controller/getResult',
			type: 'get',
			data: {search: search, date: date},
			dataType: 'json',
			success: function (data) {
				Loader.hide();
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
								<td><a href="edit/${row.id}"  class="btn btn-warning" id="edit">Редактировать</td>
								<td><a href="" class="btn btn-danger delete" data-id="${row.id}" data-name="${row.name}">Удалить</td>
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
			url: '/user_controller/create',
			type: 'post',
			data: {},
			dataType: 'json',
			success: function (response) {
				$('#response').html(response['html']);
			}
		})
	});

	$('body').on('submit', '#createForm', function (e) {
		e.preventDefault();

		$.ajax({
			url: '/user_controller/store',
			type: 'post',
			data: $(this).serializeArray(),
			dataType: 'json',
			success: function (response) {

				if (response.status == 0) {
					if ($(response.name == '')) {
						$('.nameError').html(response.name).addClass('invalid-feedback d-block')
					} else {
						$('.nameError').html('').removeClass('invalid-feedback d-block')
					}

					if ($(response.email == '')) {
						$('.emailError').html(response.email).addClass('invalid-feedback d-block')
					} else {
						$('.emailError').html('').removeClass('invalid-feedback d-block')
					}

					if ($(response.role == '')) {
						$('.roleError').html(response.role).addClass('invalid-feedback d-block')
					} else {
						$('.roleError').html('').removeClass('invalid-feedback d-block')
					}
				} else {

					$('#createModal').modal('hide')
					$('#responseSuccess').html(response.message)
					$('.successModal').modal('show')

					Redirect.redirect(response.redirect())
				}
			}
		});
	});

	function confirmDelete(name) {
		$('#deletedSuccessModal').modal('show');
		$('#responseDeletedSuccess').html('Вы действительно хотите удалить пользователя ' + name + '?');
	}

	$(document).on('click', '.delete', function (e) {
		e.preventDefault()

		let id = $(this).data('id');
		let name = $(this).data('name');

		confirmDelete(name);

		$('.deleteNow').click(function () {

			$.ajax({
				url: '/user_controller/destroy/'+id,
				type: 'post',
				data: {id: id},
				dataType: 'json',
				success: function (response) {

					$('#deletedSuccessModal').modal('hide');
					$('#responseSuccess').html(response.message)
					$('.successModal').modal('show');

					Redirect.redirect(response.redirect)
				}
			})
		})
	})
});
