<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class StudentsModel extends Model {

    // Get all students
    public function getAll()
    {
        return $this->db->table('students')->get_all();
    }

    // Get students with pagination and search
    public function getAllWithPagination($search = null, $limit = null, $offset = null)
    {
        $query = $this->db->table('students');

        if ($search) {
            $query->group_start()
                  ->like('lastname', $search)
                  ->or_like('firstname', $search)
                  ->or_like('email', $search)
                  ->group_end();
        }

        if ($limit !== null && $offset !== null) {
            $query->limit($limit, $offset);
        }

        return $query->get_all();
    }

    // Get total count of students with search filter
    public function countAll($search = null)
    {
        $query = $this->db->table('students');

        if ($search) {
            $query->group_start()
                  ->like('lastname', $search)
                  ->or_like('firstname', $search)
                  ->or_like('email', $search)
                  ->group_end();
        }

        return $query->count_all_results();
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
