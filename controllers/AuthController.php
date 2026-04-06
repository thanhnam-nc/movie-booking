<?php
require_once 'models/User.php';

// Controller xử lý các chức năng xác thực (đăng ký, đăng nhập, cập nhật profile, đổi mật khẩu, đăng xuất)
class AuthController {
    private function input($key, $default = '') {
        return trim($_POST[$key] ?? $default);
    }

    private function validateRegisterData($data) {
        $errors = [];

        if (empty($data['full_name'])) {
            $errors[] = 'Vui lòng nhập họ tên';
        }
        if (empty($data['email'])) {
            $errors[] = 'Vui lòng nhập email';
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Email không hợp lệ';
        }
        if (empty($data['password'])) {
            $errors[] = 'Vui lòng nhập mật khẩu';
        }
        if ($data['password'] !== $data['confirm_password']) {
            $errors[] = 'Mật khẩu không khớp';
        }

        return $errors;
    }


    public function register() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            include 'views/auth/register.php';
            return;
        }

        $payload = [
            'full_name' => $this->input('full_name'),
            'email' => $this->input('email'),
            'password' => $this->input('password'),
            'confirm_password' => $this->input('confirm_password'),
        ];

        $errors = $this->validateRegisterData($payload);


        $userModel = new User();
        if ($userModel->emailExists($payload['email'])) {
            $errors[] = 'Email đã được đăng ký';
        }

        $errors = array_merge($errors, $userModel->validatePassword($payload['password']));

        if (!empty($errors)) {
            include 'views/auth/register.php';
            return;
        }

        $user = new User();
        $user->full_name = $payload['full_name'];
        $user->email = $payload['email'];

        $user->password = $payload['password'];
        $user->role = 'customer';
        $user->status = 'active';



        if ($user->register()) {
            header('Location: web.php?action=login&message=Đăng ký thành công');
            exit;
        }

        $errors[] = 'Đăng ký thất bại';
        include 'views/auth/register.php';
    }

    // Đăng nhập
    public function login() {
        if (isset($_SESSION['user_id'])) {
            header("Location: index.php");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = new User();
            $user->email = $_POST['email'] ?? '';
            $user->password = $_POST['password'] ?? '';

            if ($user->login()) {
                // Lưu thông tin user vào session
                $_SESSION['user_id'] = $user->user_id;
                $_SESSION['full_name'] = $user->full_name;
                $_SESSION['email'] = $user->email;
                $_SESSION['phone'] = $user->phone;
                $_SESSION['role'] = $user->role;
                header("Location: index.php");
                exit;
            } else {
                $errors = ["Email hoặc mật khẩu không chính xác"];
                include 'views/auth/login.php';
            }
        } else {
            // Hiển thị form đăng nhập
            include 'views/auth/login.php';
        }
    }

    // Cập nhật thông tin cá nhân
    public function updateProfile() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: web.php?action=login");
            exit;
        }

        $userModel = new User();
        $user = $userModel->getUserById($_SESSION['user_id']);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $userModel->user_id = $_SESSION['user_id'];
            $userModel->full_name = $_POST['full_name'] ?? $user['full_name'];
            $userModel->email = $_POST['email'] ?? $user['email'];
            $userModel->phone = $_POST['phone'] ?? $user['phone'];
            $userModel->birthday = $_POST['birthday'] ?? $user['birthday'];
            $userModel->address = $_POST['address'] ?? $user['address'];

            if ($userModel->update()) {
                // Cập nhật session
                $_SESSION['full_name'] = $userModel->full_name;
                $_SESSION['email'] = $userModel->email;
                $_SESSION['phone'] = $userModel->phone;
                header("Location: web.php?action=profile&message=Cập nhật thành công");
            } else {
                $errors = ["Cập nhật thất bại"];
                include 'views/auth/profile.php';
            }
        } else {
            // Hiển thị form cập nhật
            include 'views/auth/profile.php';
        }
    }

    // Quên mật khẩu / xử lý gửi mã xác nhận
    public function forgotPassword() {
        $errors = [];
        $success = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');

            if (empty($email)) {
                $errors[] = 'Vui lòng nhập email';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'Email không hợp lệ';
            } else {
                $userModel = new User();
                if ($userModel->emailExists($email)) {
                    // Ở đây giả lập gửi mã xác nhận vì chưa có mail server
                    $success = 'Mã xác nhận đã được gửi tới email của bạn. Vui lòng kiểm tra hộp thư.';
                } else {
                    $errors[] = 'Email chưa được đăng ký';
                }
            }
        }

        include 'views/auth/forgot-password.php';
    }

    // Đăng xuất
    public function logout() {
        session_destroy();
        header("Location: index.php");
    }
}
