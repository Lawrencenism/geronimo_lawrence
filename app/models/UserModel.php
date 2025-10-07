<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UserModel extends Model {

    // Register a new user
    public function register($data)
    {
        // Hash the password
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $data['role'] = 'user';

        $result = $this->db->table('users')->insert($data);
        if ($result) {
            return $this->db->lastInsertId();
        }
        return false;
    }

    // Check login credentials
    public function login($email, $password)
    {
        $user = $this->db->table('users')->where('email', $email)->get();

        if ($user && ((strpos($user['password'], '$2y$') === 0 && password_verify($password, $user['password'])) || md5($password) === $user['password'])) {
            return $user;
        }

        return false;
    }

    // Check if email exists
    public function emailExists($email)
    {
        $count = $this->db->table('users')->where('email', $email)->count();
        return $count > 0;
    }

    // Get user by email
    public function getUserByEmail($email)
    {
        return $this->db->table('users')->where('email', $email)->get();
    }

    // Get user by id
    public function getUserById($id)
    {
        return $this->db->table('users')->where('id', $id)->get();
    }

    // Update user
    public function update($id, $data)
    {
        return $this->db->table('users')->where('id', $id)->update($data);
    }

    // Delete user
    public function delete($id)
    {
        return $this->db->table('users')->where('id', $id)->delete();
    }

    // Get users with pagination and search
    public function getUsers($limit, $offset, $search = '')
    {
        $this->db->table('users');
        $this->db->where('role', '!=', 'admin');
        if (!empty($search)) {
            $this->db->like('email', $search);
        }
        return $this->db->limit($limit, $offset)->get_all();
    }

    // Count users with search
    public function countUsers($search = '')
    {
        $this->db->table('users');
        $this->db->where('role', '!=', 'admin');
        if (!empty($search)) {
            $this->db->like('email', $search);
        }
        return $this->db->count();
    }
}
