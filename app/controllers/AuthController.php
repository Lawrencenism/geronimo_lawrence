<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthController extends Controller {
    public function __construct()
    {
        parent::__construct();
        require_once __DIR__ . '/../../scheme/libraries/Session.php';
        $this->call->database();
        $this->call->model('UserModel');
        $this->session = new Session();
    }

    // Sign up
    public function signup(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $this->io->post('email');
            $password = $this->io->post('password');
            $confirm_password = $this->io->post('confirm_password');

            $errors = [];

            if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'Valid email is required.';
            }

            if (empty($password) || strlen($password) < 6) {
                $errors[] = 'Password must be at least 6 characters.';
            }

            if ($password !== $confirm_password) {
                $errors[] = 'Passwords do not match.';
            }

            if ($this->UserModel->emailExists($email)) {
                $errors[] = 'Email already exists.';
            }

            if (empty($errors)) {
                $data = [
                    'email' => $email,
                    'password' => $password
                ];

                $user_id = $this->UserModel->register($data);
                if ($user_id) {
                    $this->session->set_userdata('user_id', $user_id);
                    $this->session->set_userdata('user_email', $email);
                    header("Location: /auth/login");
                    exit;
                } else {
                    $errors[] = 'Registration failed.';
                }
            }

            $this->call->view('signup', ['errors' => $errors]);
        } else {
            $this->call->view('signup');
        }
    }

    // Log in
    public function login(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $this->io->post('email');
            $password = $this->io->post('password');

            $user = $this->UserModel->login($email, $password);
            if (is_array($user) && $user) {
                $this->session->set_userdata('user_id', $user['id']);
                $this->session->set_userdata('user_email', $user['email']);
                $role = isset($user['role']) ? $user['role'] : 'user';
                $this->session->set_userdata('user_role', $role);
                if ($role === 'admin') {
                    header("Location: /admin");
                } else {
                    header("Location: /students/index");
                }
                exit;
            } else {
                $this->call->view('login', ['error' => 'Invalid email or password.']);
            }
        } else {
            $this->call->view('login');
        }
    }

    // Log out
    public function logout(): void
    {
        $this->session->sess_destroy();
        header("Location: /auth/login");
        exit;
    }
}
