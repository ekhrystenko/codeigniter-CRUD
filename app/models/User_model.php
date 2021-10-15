<?php

/**
 * Class User_model
 */
class User_model extends CI_Model
{
	/**
	 * User_model constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	/**
	 * @return string
	 */
	public function tableName():string
	{
		return "users";
	}

	/**
	 * @param $search
	 * @return mixed
	 */
	public function getUsers($search)
	{
		$rows = $this->db->select(["users.*", "roles.role_name"])
			->from($this->tableName())
			->join('roles', 'users.role_id = roles.id', 'left')
			->like('name', $search)
			->get()
			->result_array();

		return $rows;
	}

	/**
	 * @param $id
	 * @return mixed
	 */
	public function getUser($id)
	{
		$row = $this->db->select()
			->from($this->tableName())
			->where('id', $id)
			->get()
			->row_array();

		return $row;
	}

	/**
	 * @param $user
	 */
	public function create($user)
	{
		$this->db->insert('users', $user);
	}

	/**
	 * @param $id
	 */
	public function update($id, $user)
	{
		$this->db->update('users', $user, ['id' => $id]);
	}

	/**
	 * @param $id
	 */
	public function delete($id)
	{
		$this->db->delete('users', ['id' => $id]);
	}

	/**
	 * Method faker create
	 */
	public function createFactory()
	{
		$users = [
			['name' => 'Admin', 'email' => 'admin@gmail.com', 'role_id' => '1', 'created_at' => date('Y-m-d H:i:s')],
			['name' => 'User', 'email' => 'user@gmail.com', 'role_id' => '3', 'created_at' => date('Y-m-d H:i:s')],
			['name' => 'Bob', 'email' => 'bob@gmail.com', 'role_id' => '2', 'created_at' => date('Y-m-d H:i:s')],
			['name' => 'Jack', 'email' => 'jack@gmail.com', 'role_id' => '3', 'created_at' => date('Y-m-d H:i:s')],
			['name' => 'Tom', 'email' => 'tom@gmail.com', 'role_id' => '3', 'created_at' => date('Y-m-d H:i:s')],
			['name' => 'Andy', 'email' => 'andy@gmail.com', 'role_id' => '2', 'created_at' => date('Y-m-d H:i:s')]
		];

		$roles = [
			['role_name' => 'Admin',],
			['role_name' => 'Moderator',],
			['role_name' => 'User']
		];

		$this->db->trans_start();

		$this->db->insert_batch('roles', $roles);
		$this->db->insert_batch('users', $users);

		$this->db->trans_complete();

	}

	/**
	 * Method faker destroy
	 */
	public function destroyFactory()
	{
		$this->db->truncate($this->tableName());
		$this->db->truncate('roles');
	}
}
