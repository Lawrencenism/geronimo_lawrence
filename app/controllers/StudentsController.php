<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class StudentsController extends Controller {
    public function __construct()
    {
        parent::__construct();
        require_once __DIR__ . '/../../scheme/libraries/Session.php';
        $this->call->database();
        $this->call->model('StudentsModel');
        $this->session = new Session();

        // Check if user is logged in
        if (!$this->session->has_userdata('user_id')) {
            header("Location: /auth/login");
            exit;
        }
    }

    // List students with search + pagination
    public function index(): void
    {
        // ✅ Prevent undefined index warning
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        $page   = isset($_GET['page']) ? (int) $_GET['page'] : 1;

        $limit = 5; // students per page
        $offset = ($page - 1) * $limit;

        $students = $this->StudentsModel->getStudents($limit, $offset, $search);
        $totalRecords = $this->StudentsModel->countStudents($search);
        $totalPages = ceil($totalRecords / $limit);

        // Build pagination HTML
        $pagination = '';
        if ($totalPages > 1) {
            $pagination .= '<div class="pagination">';
            for ($i = 1; $i <= $totalPages; $i++) {
                $active = ($i == $page) ? 'active' : '';
                $pagination .= '<a class="'.$active.'" href="/students/index?page='.$i.'&search='.urlencode($search).'">'.$i.'</a>';
            }
            $pagination .= '</div>';
        }

        $this->call->view('GUI', [
            'students'     => $students,
            'search'       => $search,
            'totalRecords' => $totalRecords,
            'currentPage'  => $page,
            'totalPages'   => $totalPages,
            'pagination'   => $pagination,
            'user_email'   => $this->session->userdata('user_email')
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
