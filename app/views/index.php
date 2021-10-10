<div class="container">
	<div class="row">
		<div class="col-lg-8 offset-2 mt-5">

			<!--Search form-->
			<form method="get" action="main" class="mb-4" id="form" style="border: 2px silver solid; border-radius: 15px; padding: 15px">
				<div class="form-group">
					<label for="id" class="mb-3">Введите имя</label>
					<input type="text" name="name" id="id" class="form-control mb-2" value="">

<!--					<input type="text" id="datepicker" name="date" placeholder="Выберите дату" class="form-control">-->

					<!--Error block-->
					<h6 style="display: none; margin-top: 12px" class="error"></h6>
				</div>
				<button type="submit" id="send" class="btn btn-primary mt-2">Поиск</button>
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
						<th scope="col">Role</th>
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

