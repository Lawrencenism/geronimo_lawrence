<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class StudentsModel extends Model {

    // Get all students
    public function getAll()
    {
        return $this->db->table('students')->get_all();
    }

    // Get student by ID
    public function getById($id)
    {
        return $this->db->table('students')->where('id', $id)->get();
    }

    // Insert student
    public function insert($data)
    {
        return $this->db->table('students')->insert($data);
    }

    // Update student
    public function update($id, $data)
    {
        return $this->db->table('students')->where('id', $id)->update($data);
    }

    // Delete student
    public function delete($id)
    {
        return $this->db->table('students')->where('id', $id)->delete();
    }
}
