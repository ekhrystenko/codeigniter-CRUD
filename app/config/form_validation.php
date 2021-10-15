<?php

$config = [
	'user_controller/store' => [
		[
			'field' => 'name',
			'label' => 'Имя',
			'rules' => 'required|min_length[3]',
			'errors' => [
				'required' => 'Поле %s должно быть заполненым!',
				'min_length' => 'Поле {field} должно быть не меньше {param} символов!'
			]
		],
		[
			'field' => 'email',
			'label' => 'Email',
			'rules' => 'required|valid_email|is_unique[users.email]',
			'errors' => [
				'required' => 'Поле %s должно быть заполненым!',
				'valid_email' => 'Поле %s содержит не коректнный email!',
				'is_unique' => 'Такой %s уже существует!'
			]
		],
		[
			'field' => 'role',
			'label' => 'Роль',
			'rules' => 'required',
			'errors' => [
				'required' => '%s должна быть заполненой!',
			]
		]
	],
	'user_controller/update' => [
		[
			'field' => 'name',
			'label' => 'Имя',
			'rules' => 'required|min_length[3]',
			'errors' => [
				'required' => 'Поле %s должно быть заполненым!',
				'min_length' => 'Поле {field} должно быть не меньше {param} символов!'
			]
		],
		[
			'field' => 'email',
			'label' => 'Email',
			'rules' => 'required|valid_email',
			'errors' => [
				'required' => 'Поле %s должно быть заполненым!',
				'valid_email' => 'Поле %s содержит не коректнный email!',
			]
		],
		[
			'field' => 'role',
			'label' => 'Роль',
			'rules' => 'required',
			'errors' => [
				'required' => '%s должна быть заполненой!',
			]
		]
	]
];
