<form action="main/store" method="POST" id="createForm">
	<input type="hidden" name="_token" value="Q2hEk4zqxPpMVxxkpr4zAtHTKY2sYIV7IUTTPJ5K">                                <input type="hidden" name="_method" value="PUT">                                <div class="card-body">
		<div class="form-group">
			<label for="name">Имя</label>
			<input type="text" class="form-control" name="name" id="name" placeholder="Имя" value="">
			<p class="nameError"></p>

			<label for="email">Email</label>
			<input type="text" class="form-control" name="email" id="email" placeholder="Email" value="">
			<p class="emailError"></p>

			<label for="category">Роль</label>
			<select class="form-control" name="role" id="role">
				<option value="">Выберите роль</option>
				<option value="1">Админ</option>
				<option value="2">Модератор</option>
				<option value="3">Пользователь</option>
			</select>
			<p class="roleError"></p>

			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="closeModal">Закрыть</button>
				<button type="submit" class="btn btn-success">Создать</button>
			</div>
		</div>
	</div>
</form>

