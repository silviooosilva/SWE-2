<?php

namespace Silviooosilva\Clarifiquei\Core;

use PDO;
use Dotenv\Dotenv;

class Connect 
{
  /** @param string $DB_HOST */
  private string $DB_HOST;

  /** @param string $DB_USER */
  private string $DB_USER;

  /** @param string $DB_PASS */
  private string $DB_PASS;

  /** @param string $DB_NAME */
  private string $DB_NAME;

  /** @param PDO $Connect */
  protected $connect;

  public function __construct()
  {
    $this->loadEnv();
    $this->DB_HOST = $_ENV['DB_HOST'] ?? '127.0.0.1';
    $this->DB_NAME = $_ENV['DB_DATABASE'] ?? 'clarifiquei';
    $this->DB_USER = $_ENV['DB_USERNAME'] ?? 'root';
    $this->DB_PASS = $_ENV['DB_PASSWORD'] ?? '';

    $dsn = "mysql:host={$this->DB_HOST};dbname={$this->DB_NAME}";
    $this->connect = new PDO($dsn, $this->DB_USER, $this->DB_PASS, [
      PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
  ]);
  }

  /**
  * @return void
  */
  private function loadEnv() 
  {
    if(file_exists(__DIR__ . "/../../.env")){
      $dotEnv = Dotenv::createImmutable(__DIR__ . "/../../");
      $dotEnv->load();
    }
  }
}