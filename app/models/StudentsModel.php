<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class StudentsModel extends Model {

    // Get all students with search + pagination
    public function getStudents($limit, $offset, $search = '')
    {
        $builder = $this->db->table('students');

        if (!empty($search)) {
            $builder->like('lastname', $search)
                    ->or_like('firstname', $search)
                    ->or_like('email', $search);
        }

        return $builder->order_by('id', 'DESC')->limit($limit, $offset)->get_all();
    }

    // Count students (for pagination)
    public function countStudents($search = '')
    {
        $builder = $this->db->table('students');

        if (!empty($search)) {
            $builder->like('lastname', $search)
                    ->or_like('firstname', $search)
                    ->or_like('email', $search);
        }

        return $builder->count();
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

    // Get student by ID
    public function getById($id)
    {
        return $this->db->table('students')->where('id', $id)->get();
    }
}
