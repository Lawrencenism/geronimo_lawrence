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
        $this->call->library('Pagination');
        $search = $this->io->get('search') ?? '';
        $page = (int)($this->io->get('page') ?? 1);
        $rows_per_page = 10;
        $total = $this->StudentsModel->getTotal($search);
        $delimiter = empty($search) ? '?page=' : '&page=';
        $this->pagination->set_options(['page_delimiter' => $delimiter]);
        $base_url = 'students/index';
        if (!empty($search)) {
            $base_url .= '?search=' . urlencode($search);
        }
        $this->pagination->initialize($total, $rows_per_page, $page, $base_url);
        $offset = ($page - 1) * $rows_per_page;
        $students = $this->StudentsModel->getStudents($search, $rows_per_page, $offset);
        $pagination_html = $this->pagination->paginate();
        $this->call->view('GUI', ['students' => $students, 'pagination' => $pagination_html, 'search' => $search]);
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
