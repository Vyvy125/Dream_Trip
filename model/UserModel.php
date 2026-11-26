<?php
require_once __DIR__ . '/master.php';

class UserModel extends MasterModel {
  public function findByEmail(string $email): ?array {
    $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
    $stmt->execute([':email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    return $user ?: null;
  }

  public function findByLoginInput(string $username): ?array {
    $sql = "SELECT * FROM users
            WHERE email = :input
               OR phone = :input
               OR fullname = :input
            ORDER BY id DESC
            LIMIT 1";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([':input' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    return $user ?: null;
  }

  public function createUser(array $data): bool {
    $sql = "INSERT INTO users (fullname, phone, province, district, birthday, password, email)
            VALUES (:fullname, :phone, :province, :district, :birthday, :password, :email)";
    $stmt = $this->conn->prepare($sql);

    return $stmt->execute([
      ':fullname' => $data['fullname'],
      ':phone'    => $data['phone'],
      ':province' => $data['province'],
      ':district' => $data['district'],
      ':birthday' => $data['birthday'],
      ':password' => password_hash($data['password'], PASSWORD_DEFAULT),
      ':email'    => $data['email'],
    ]);
  }
}