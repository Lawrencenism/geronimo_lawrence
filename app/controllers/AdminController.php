<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AdminController extends Controller {
    public function __construct()
    {
        parent::__construct();
        require_once __DIR__ . '/../../scheme/libraries/Session.php';
        $this->call->database();
        $this->call->model('UserModel');
        $this->session = new Session();

        // Check if user is logged in and is admin
        if (!$this->session->has_userdata('user_id') || $this->session->userdata('user_role') !== 'admin') {
            header("Location: /auth/login");
            exit;
        }
    }

    // List users with search + pagination
    public function index(): void
    {
        // Prevent undefined index warning
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;

        $limit = 5; // users per page
        $offset = ($page - 1) * $limit;

        $users = $this->UserModel->getUsers($limit, $offset, $search);
        $totalRecords = $this->UserModel->countUsers($search);
        $totalPages = ceil($totalRecords / $limit);

        // Build pagination HTML
        $pagination = '';
        if ($totalPages > 1) {
            $pagination .= '<div class="pagination">';
            for ($i = 1; $i <= $totalPages; $i++) {
                $active = ($i == $page) ? 'active' : '';
                $pagination .= '<a class="' . $active . '" href="/admin/index?page=' . $i . '&search=' . urlencode($search) . '">' . $i . '</a>';
            }
            $pagination .= '</div>';
        }

        $this->call->view('admin_dashboard', [
            'users' => $users,
            'search' => $search,
            'totalRecords' => $totalRecords,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'pagination' => $pagination,
            'user_email' => $this->session->userdata('user_email')
        ]);
    }

    // Edit form
    public function edit($id): void
    {
        $user = $this->UserModel->getUserById($id);
        $this->call->view('admin_edit_user', ['user' => $user]);
    }

    // Update user
    public function update($id): void
    {
        $data = [
            'email' => $this->io->post('email'),
            'role' => $this->io->post('role')
        ];

        $password = $this->io->post('password');
        if (!empty($password)) {
            $data['password'] = md5($password);
        }

        if ($this->UserModel->update($id, $data)) {
            header("Location: /admin/index");
            exit;
        } else {
            echo "Failed to update user.";
        }
    }

    // Delete user
    public function delete($id): void
    {
        if ($this->UserModel->delete($id)) {
            header("Location: /admin/index");
            exit;
        } else {
            echo "Failed to delete user.";
        }
    }
}
