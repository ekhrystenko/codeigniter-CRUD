<?php

class User_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function getUsers($search)
	{
		$query = $this->db->select(["users.*", "roles.role_name"])
			->from('users')
			->join('roles', 'users.role_id = roles.id', 'left')
			->like('name', $search)
			->get()
			->result_array();

		return $query;
	}

	public function fake()
	{
		$users = [
			[
				'name' => 'Admin',
				'email' => 'admin@gmail.com',
				'role_id' => '1',
			],
			[
				'name' => 'User',
				'email' => 'user@gmail.com',
				'role_id' => '3',
			],
			[
				'name' => 'Bob',
				'email' => 'bob@gmail.com',
				'role_id' => '2',
			],
			[
				'name' => 'Jack',
				'email' => 'jack@gmail.com',
				'role_id' => '3',
			],
			[
				'name' => 'Tom',
				'email' => 'tom@gmail.com',
				'role_id' => '3',
			],
			[
				'name' => 'Andy',
				'email' => 'andy@gmail.com',
				'role_id' => '2',
			],
		];

		$roles = [
			[
				'role_name' => 'Admin',
			],
			[
				'role_name' => 'Moderator',
			],
			[
				'role_name' => 'User',
			]
		];

		$this->db->trans_start();

		$this->db->insert_batch('roles', $roles);
		$this->db->insert_batch('users', $users);

		$this->db->trans_complete();

//		$this->db->truncate('users');
//		$this->db->truncate('roles');

	}

	public function create($user)
	{
		$this->db->insert('users', $user);
	}

	public function update($id)
	{
		$usersUpdate = [
			'name' => 'Tom',
			'email' => 'tom@gmail.com',
			'role_id' => '3',
		];

		$this->db->update('users', $usersUpdate, ['id' => $id]);
	}

	public function delete($id)
	{
		$this->db->delete('users', ['id' => $id]);
	}
}
