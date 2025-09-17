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

    // Get paginated students with search
    public function getStudents($search = '', $limit = 10, $offset = 0)
    {
        $query = $this->db->table('students');
        if (!empty($search)) {
            $query->where("lastname LIKE '%$search%' OR firstname LIKE '%$search%' OR email LIKE '%$search%'");
        }
        return $query->limit($limit, $offset)->get_all();
    }

    // Get total count of students with search
    public function getTotal($search = '')
    {
        $query = $this->db->table('students');
        if (!empty($search)) {
            $query->where("lastname LIKE '%$search%' OR firstname LIKE '%$search%' OR email LIKE '%$search%'");
        }
        return $query->count_all_results();
    }
}
