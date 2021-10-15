<form action="user_controller/update/<?= $row['id'] ?>" method="POST" id="updateForm">
	<input type="hidden" name="_token" value="Q2hEk4zqxPpMVxxkpr4zAtHTKY2sYIV7IUTTPJ5K">
	<input type="hidden" name="_method" value="PUT">                                <div class="card-body">
	<input type="hidden" name="id" value="<?= $row['id'] ?>">                                <div class="card-body">
		<div class="form-group">
			<label for="name">Имя</label>
			<input type="text" class="form-control" name="name" id="name" placeholder="Имя" value="<?= $row['name'] ?>">
			<p class="nameError"></p>

			<label for="email">Email</label>
			<input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?= $row['email'] ?>">
			<p class="emailError"></p>

			<label for="category">Роль</label>
			<select class="form-control" name="role" id="role">
				<option value="1" <?php ($row['role_id'] == 1) ? 'selected' : '' ?>>Админ</option>
				<option value="2" <?php ($row['role_id'] == 2) ? 'selected': '' ?>>Модератор</option>
				<option value="3" <?php ($row['role_id'] == 3) ? 'selected' : '' ?>>Пользователь</option>
			</select>
			<p class="roleError"></p>

			<button type="submit" class="btn btn-warning">Редактировать</button>
		</div>
	</div>
</form>

