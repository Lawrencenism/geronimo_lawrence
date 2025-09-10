<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class StudentsController extends Controller {
    public function __construct()
    {
        parent::__construct();
        $this->call->database();
        $this->call->model('StudentsModel'); // $this->StudentsModel
    }

    // List students
    public function index(): void
    {
        $students = $this->StudentsModel->getAll();
        $this->call->view('GUI', ['students' => $students]);
    }

    // Save student
    public function create(): void
    {
        $data = [
            'lastname'  => $this->io->post('lastname'),
            'firstname' => $this->io->post('firstname'),
            'email'     => $this->io->post('email')
        ];

        if ($this->StudentsModel->insert($data)) {
            header("Location: /students/index");
            exit;
        } else {
            echo "Failed to insert student.";
        }
    }

    // Edit form
    public function edit($id): void
    {
        $student = $this->StudentsModel->getById($id);
        $this->call->view('student_edit', ['student' => $student]);
    }

    // Update student
    public function update($id): void
    {
        $data = [
            'lastname'  => $this->io->post('lastname'),
            'firstname' => $this->io->post('firstname'),
            'email'     => $this->io->post('email')
        ];

        if ($this->StudentsModel->update($id, $data)) {
            header("Location: /students/index");
            exit;
        } else {
            echo "Failed to update student.";
        }
    }

    // Delete student
    public function delete($id): void
    {
        if ($this->StudentsModel->delete($id)) {
            header("Location: /students/index");
            exit;
        } else {
            echo "Failed to delete student.";
        }
    }
}
