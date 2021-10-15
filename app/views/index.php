<div class="container">
	<div class="row">
		<div class="col-lg-10 offset-1 mt-5">

		<!-- Modal create -->
		<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header bg-success">
						<h5 class="modal-title" id="exampleModalLabel">Создать пользователя</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div id="response">

						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Modal update -->
		<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header bg-warning">
						<h5 class="modal-title" id="exampleModalLabel">Редактировать пользователя</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div id="response">

						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Modal success-->
		<div class="modal fade successModal" abindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Сообщение</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div id="responseSuccess">

						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Modal deleted success-->
		<div class="modal fade" id="deletedSuccessModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header bg-danger">
						<h5 class="modal-title" id="exampleModalLabel">Подтвердите удаление</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div id="responseDeletedSuccess">

						</div>
					</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-danger deleteNow">Удалить</button>
						</div>

				</div>
			</div>
		</div>

			<!--Search form-->
			<form method="get" action="user_controller" class="mb-4" id="searchForm" style="border: 2px silver solid; border-radius: 15px; padding: 15px">
				<div class="form-group">
					<label for="id" class="mb-3">Введите имя</label>
					<input type="text" name="search" class="form-control mb-2" value="">

					<!--Error block-->
					<h6 style="display: none; margin-top: 12px" class="error"></h6>
				</div>
				<button type="submit" class="btn btn-primary mt-2">Поиск</button>
				<a href="javascript:void(0)" id="showModal" class="btn btn-success mt-2">Создать</a>
			</form>


			<!--Loading block-->
			<div class="text-center mt-3" id="loading" style="display: none">
				<div role="status">
					<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
				</div>
				Загрузка...
			</div>

			<!--Result table-->
			<table class="table table-striped" id="table" style="display: none">
				<thead>
					<tr>
						<th scope="col">ID</th>
						<th scope="col">Имя</th>
						<th scope="col">Email</th>
						<th scope="col">Роль</th>
						<th scope="col">Редактировать</th>
						<th scope="col">Удалить</th>
					</tr>
				</thead>
					<tbody>

					</tbody>
			</table>

			<!--Pagination block-->
			<ul class="pagination d-flex justify-content-center" id="pagination" style="display: none;">

			</ul>
		</div>
	</div>
</div>

