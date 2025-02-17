<?php

namespace Silviooosilva\Clarifiquei\Repository;

use PDO;
use Silviooosilva\Clarifiquei\Core\Connect;

class UserRepository extends Connect
{

  /**
  * @return bool
  */
  public function create()
  {
    $name = 'Admin';
    $email = 'admin@email.com';
    $password = 'admin123';

    $checkSql = "SELECT id FROM users WHERE email = :email";
    $checkStmt = $this->connect->prepare($checkSql);
    $checkStmt->bindParam(':email', $email);
    $checkStmt->execute();
    if($checkStmt->fetch(PDO::FETCH_ASSOC)){
      return false;
    }

    $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
    $stmt = $this->connect->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt->bindParam(':password', $hashedPassword);
    return $stmt->execute() ? $this->connect->lastInsertId() : false;
  }

  /**
  * @param string $email
  * @param string $password
  * @return array|bool
  */
  public function login(string $email, string $password)
  {
    $sql = "SELECT * FROM users WHERE email = :email";
    $stmt = $this->connect->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if($user && password_verify($password, $user['password'])){
      return $user;
    }
    return false;
  }

}