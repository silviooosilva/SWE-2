<?php

namespace Silviooosilva\Clarifiquei\Repository;

use Silviooosilva\Clarifiquei\Core\Connect;

class EngineerRepository extends Connect

{

  /**
    * @param string $name
    * @param float $maxWorkLoad
    * @param float $efficiency
    * @return int|bool
   */
  public function create(string $name, float $maxWorkLoad, float $efficiency)
  {
    $sql = "INSERT INTO engineers (name, max_workload, efficiency) VALUES (:name, :max_workload, :efficiency)";
    $stmt = $this->connect->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':max_workload', $maxWorkLoad);
    $stmt->bindParam(':efficiency', $efficiency);
    return $stmt->execute() ? $stmt->rowCount() : false;
  }

  /**
    * @return array
   */
  public function all()
  {
    $sql = "SELECT * FROM engineers";
    $stmt = $this->connect->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
  }

  /**
    * @param int $id
    * @return array
   */
  public function find(int $id)
  {
    $sql = "SELECT * FROM engineers WHERE id = :id";
    $stmt = $this->connect->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    return $stmt->fetch();
  }

  /**
    * @param int $id
    * @param string $name
    * @param float $maxWorkLoad
    * @param float $efficiency
    * @return int|bool
   */

  public function update(int $id, string $name, float $maxWorkLoad, float $efficiency)
  {
    $sql = "UPDATE engineers SET name = :name, max_workload = :max_workload, efficiency = :efficiency WHERE id = :id";
    $stmt = $this->connect->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':max_workload', $maxWorkLoad);
    $stmt->bindParam(':efficiency', $efficiency);
    return $stmt->execute() ? $stmt->rowCount() : false;
  }

  /**
    * @param int $id
    * @return int|bool
   */

  public function delete(int $id)
  {
    $sql = "DELETE FROM engineers WHERE id = :id";
    $stmt = $this->connect->prepare($sql);
    $stmt->bindParam(':id', $id);
    return $stmt->execute() ? $stmt->rowCount() : false;
  }

}
