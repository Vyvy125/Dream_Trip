<?php
require_once "model/master.php";
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../model/UserModel.php';

class Auth {

    public function login() {
        if (session_status() === PHP_SESSION_NONE) {
        session_start();
        }
        // KHÔNG unset($_SESSION['login_error']) ở đây vì login.php tự đọc và unset rồi
        require_once __DIR__ . '/../view/home/login.php';
    }

    public function register() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $error = $_SESSION['register_error'] ?? '';
        $success = $_SESSION['register_success'] ?? '';
        $old = $_SESSION['old_register'] ?? [];

        unset($_SESSION['register_error'], $_SESSION['register_success'], $_SESSION['old_register']);

        require_once __DIR__ . '/../view/home/register.php';
    }


    public function handleLogin() {
        if (session_status() === PHP_SESSION_NONE) {
        session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['btn_login'])) {
        header("Location: index.php?controller=Auth&action=login");
        exit;
        }

        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        if ($username === '' || $password === '') {
        $_SESSION['login_error'] = 'Vui lòng nhập đầy đủ tên đăng nhập và mật khẩu!';
        header("Location: index.php?controller=Auth&action=login");
        exit;
        }

        $userModel = new UserModel();
        $user = $userModel->findByLoginInput($username);

        if (!$user || !password_verify($password, $user['password'])) {
        $_SESSION['login_error'] = 'Tài khoản không tồn tại hoặc mật khẩu không đúng!';
        header("Location: index.php?controller=Auth&action=login");
        exit;
        }

        session_regenerate_id(true);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['fullname'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_phone'] = $user['phone'];

        header("Location: index.php?controller=Home&action=index");
        exit;
    }

    public function handleRegister() {
        if (session_status() === PHP_SESSION_NONE) {
        session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['btn_register'])) {
        header("Location: index.php?controller=Auth&action=register");
        exit;
        }

        $fullname = trim($_POST['fullname'] ?? '');
        $email    = trim($_POST['email'] ?? '');
        $phone    = trim($_POST['phone'] ?? '');
        $birthday = trim($_POST['birthday'] ?? '');
        $province = trim($_POST['province'] ?? '');
        $district = trim($_POST['district'] ?? '');
        $password = $_POST['password'] ?? '';

        $oldInput = [
        'fullname' => $fullname,
        'email'    => $email,
        'phone'    => $phone,
        'birthday' => $birthday,
        'province' => $province,
        'district' => $district,
        ];

        $error = '';
        if (
        $fullname === '' || $email === '' || $phone === '' ||
        $birthday === '' || $province === '' || $district === '' || $password === ''
        ) {
        $error = 'Vui lòng nhập đầy đủ tất cả các thông tin bắt buộc.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Định dạng email không hợp lệ.';
        } elseif (!preg_match('/^[0-9+\-\s]{1,20}$/', $phone)) {
        $error = 'Số điện thoại không hợp lệ.';
        } elseif (strlen($password) < 6) {
        $error = 'Mật khẩu phải có ít nhất 6 ký tự.';
        } else {
        $userModel = new UserModel();
        if ($userModel->findByEmail($email) !== null) {
            $error = 'Email này đã được đăng ký, vui lòng dùng email khác.';
        }
        }

        if ($error !== '') {
        $_SESSION['register_error'] = $error;
        $_SESSION['old_register'] = $oldInput;
        header("Location: index.php?controller=Auth&action=register");
        exit;
        }

        $userModel = new UserModel();
        $created = $userModel->createUser([
        'fullname' => $fullname,
        'phone'    => $phone,
        'province' => $province,
        'district' => $district,
        'birthday' => $birthday,
        'password' => $password,
        'email'    => $email,
        ]);

        if ($created) {
        $_SESSION['flash_success'] = 'Đăng ký tài khoản thành công! Mời bạn đăng nhập.';
        header("Location: index.php?controller=Auth&action=login");
        exit;
        }

        $_SESSION['register_error'] = 'Có lỗi xảy ra khi tạo tài khoản, vui lòng thử lại.';
        $_SESSION['old_register'] = $oldInput;
        header("Location: index.php?controller=Auth&action=register");
        exit;
    }
    


    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
        session_start();
        }

        unset($_SESSION['user_id'], $_SESSION['user_name'], $_SESSION['user_email'], $_SESSION['user_phone']);
        session_destroy();

        header("Location: index.php?controller=Home&action=index");
        exit;
    }
}
?>