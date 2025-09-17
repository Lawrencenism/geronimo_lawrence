<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class StudentsController extends Controller {
    public function __construct()
    {
        parent::__construct();
        $this->call->database();
        $this->call->model('StudentsModel'); // $this->StudentsModel
        $this->call->library('Pagination');
    }

    // List students
    public function index(): void
    {
        $search = $this->io->get('search') ?? '';
        $page = (int) ($this->io->get('page') ?? 1);
        $per_page = 10; // Rows per page

        $total_rows = $this->StudentsModel->countAll($search);
        $pagination_data = $this->pagination->initialize($total_rows, $per_page, $page, 'students/index', 5);

        $students = $this->StudentsModel->getAllWithPagination($search, $per_page, ($page - 1) * $per_page);

        $pagination_html = $this->pagination->paginate();

        $this->call->view('GUI', [
            'students' => $students,
            'pagination' => $pagination_html,
            'search' => $search
        ]);
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
