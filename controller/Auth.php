<?php
// controller/Auth.php
require_once "model/master.php"; // Gọi model kết nối database nếu cần

class Auth {
    // Hiển thị form đăng nhập
    public function login() {
        // Gọi view hiển thị form login
        include "view/home/login.php"; 
    }

    public function register() {
        include "view/home/register.php";
    }

    // Xử lý dữ liệu khi người dùng bấm nút Submit
    public function handleLogin() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
            }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn_login'])) {
            // Lấy giá trị từ ô input hiện tại (name="username")
            $loginInput = trim($_POST['username'] ?? '');
            $password   = $_POST['password'] ?? '';

            if ($loginInput === '' || $password === '') {
                $_SESSION['login_error'] = "Vui lòng nhập đầy đủ tài khoản và mật khẩu!";
                header("Location: index.php?controller=Auth&action=login");
                exit();
            }

            global $conn;

            // Tìm theo email hoặc phone (nhớ đổi 'users' thành đúng tên bảng của bạn)
            $sql = "SELECT id, fullname, phone, email, password
                FROM users
                WHERE fullname = :login OR email = :login OR phone = :login
                LIMIT 1";
            $stmt = $conn->prepare($sql);
            $stmt->execute(['login' => $loginInput]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Chỉ cho đăng nhập khi tồn tại tài khoản VÀ mật khẩu khớp
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user'] = [
                    'id'       => $user['id'],
                    'fullname' => $user['fullname'],
                    'email'    => $user['email'],
                    'phone'    => $user['phone']
                ];

                header("Location: index.php?controller=Home&action=index");
                exit();
            } else {
                // Tạm debug trong handlelogin() trước khi redirect
                $_SESSION['login_error'] = "Tài khoản không tồn tại hoặc mật khẩu không đúng!";
                header("Location: index.php?controller=Auth&action=login");
                exit();
            }
        }
    }

    public function handleRegister() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn_register'])) {
            $fullname = trim($_POST['fullname'] ?? '');
            $email    = trim($_POST['email'] ?? '');
            $phone    = trim($_POST['phone'] ?? '');
            $province = trim($_POST['province'] ?? '');
            $district = trim($_POST['district'] ?? '');
            $birthday = trim($_POST['birthday'] ?? '');
            $password = $_POST['password'] ?? '';

            // Kiểm tra không để trống các cột bắt buộc (Null = Không)[cite: 15]
            if (
                $fullname === '' || $email === '' || $phone === '' ||
                $province === '' || $district === '' || $birthday === '' || $password === ''
            ) {
                $_SESSION['register_error'] = "Vui lòng nhập đầy đủ tất cả thông tin!";
                header("Location: index.php?controller=Auth&action=register");
                exit();
            }

            global $conn;

            // Kiểm tra email hoặc số điện thoại đã tồn tại chưa
            $checkSql = "SELECT id FROM users WHERE email = :email OR phone = :phone LIMIT 1";
            $checkStmt = $conn->prepare($checkSql);
            $checkStmt->execute([
                'email' => $email,
                'phone' => $phone
            ]);

            if ($checkStmt->fetch(PDO::FETCH_ASSOC)) {
                $_SESSION['register_error'] = "Email hoặc số điện thoại đã được sử dụng!";
                header("Location: index.php?controller=Auth&action=register");
                exit();
            }

            // Mã hóa mật khẩu trước khi lưu vào cột password (varchar(255))[cite: 15]
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $insertSql = "INSERT INTO users (fullname, phone, province, district, birthday, password, email)
                        VALUES (:fullname, :phone, :province, :district, :birthday, :password, :email)";
            $insertStmt = $conn->prepare($insertSql);
            $success = $insertStmt->execute([
                'fullname' => $fullname,
                'phone'    => $phone,
                'province' => $province,
                'district' => $district,
                'birthday' => $birthday,
                'password' => $hashedPassword,
                'email'    => $email
            ]);

            if ($success) {
                $_SESSION['login_success'] = "Đăng kí thành công! Vui lòng đăng nhập.";
                header("Location: index.php?controller=Auth&action=login");
                exit();
            } else {
                $_SESSION['register_error'] = "Đăng kí thất bại, vui lòng thử lại!";
                header("Location: index.php?controller=Auth&action=register");
                exit();
            }
        }
}

    // Đăng xuất
    public function logout() {
        session_start();
        unset($_SESSION['user']); // Xóa session
        header("Location: index.php?controller=Auth&action=login");
        exit();
    }
}
?>