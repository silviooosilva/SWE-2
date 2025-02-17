<?php

namespace Silviooosilva\Clarifiquei\Repository;

use PDO;
use Silviooosilva\Clarifiquei\Core\Connect;

class TaskRepository extends Connect
{

  /**
   * @param string $name
   * @param string $priority
   * @param float $time
   * @param string $status
   * @param int|null $engineer_id
   * @return int|bool
   */
  public function create(string $name, string $priority, float $time,  string $status, int $engineer_id = null)
  {
    $sql = "INSERT INTO tasks (name, priority, time, status, engineer_id) VALUES (:name, :priority, :time, :status, :engineer_id)";
    $stmt = $this->connect->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':priority', $priority);
    $stmt->bindParam(':time', $time);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':engineer_id', $engineer_id);
    return $stmt->execute() ? $this->connect->lastInsertId() : false;
  }

  /**
   * @return array
   */
  public function all()
  {
    $sql = "SELECT * FROM tasks";
    $stmt = $this->connect->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll() ?? [];
  }

  /**
   * @param int $id
   * @return array
   */
  public function find(int $id)
  {
    $sql = "SELECT * FROM tasks WHERE id = :id";
    $stmt = $this->connect->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    return $stmt->fetch() ?? [];
  }

  /**
   * @param int $engineer_id
   * @return array
   */
  public function findByEngineer(int $engineer_id)
  {
    $sql = "SELECT * FROM tasks WHERE engineer_id = :engineer_id";
    $stmt = $this->connect->prepare($sql);
    $stmt->bindParam(':engineer_id', $engineer_id);
    $stmt->execute();
    return $stmt->fetchAll() ?? [];
  }

  /**
   * @return array
   */
  public function getAllocations()
  {

$stmt = $this->connect->query("SELECT engineers.name as engineer_name, tasks.name as task_name, tasks.status, tasks.id FROM tasks JOIN engineers ON tasks.engineer_id = engineers.id");
    $allocations = [];
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $allocations[] = $row;
    }
    return $allocations ?? [];

  
  }

  /**
   * @return array
   */
  public function findUnassigned() 
  {
    $stmt = $this->connect->query("SELECT * FROM tasks WHERE engineer_id IS NULL AND status = 'pendente'");
    $tasks = [];
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $tasks[] = $row;
    }
    return $tasks ?? [];
  }

  /**
   * @param int $id
   * @param string $name
   * @param string $priority
   * @param float $time
   * @param string $status
   * @param int|null $engineer_id
   * @return int|bool
   */

  public function update(int $id, string $name, string $priority, float $time, string $status, int $engineer_id = null)
  {
    $sql = "UPDATE tasks SET name = :name, priority = :priority, time = :time, status = :status, engineer_id = :engineer_id WHERE id = :id";
    $stmt = $this->connect->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':priority', $priority);
    $stmt->bindParam(':time', $time);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':engineer_id', $engineer_id);
    return $stmt->execute() ? $stmt->rowCount() : false;
  }

  /**
   * @param int $taskId
   * @param int $engineerId
   * @return int|bool
   */
  public function assingTask(int $taskId, int $engineerId)
  {
    $sql = "UPDATE tasks SET engineer_id = :engineer_id WHERE id = :id";
    $stmt = $this->connect->prepare($sql);
    $stmt->bindParam(':id', $taskId);
    $stmt->bindParam(':engineer_id', $engineerId);
    return $stmt->execute() ? $stmt->rowCount() : false;
  }


  /**
   * @param int $taskId
   * @param string $status
   * @return int|bool
   */
  public function controlTaskStatus(int $taskId, string $status)
  {
    $sql = "UPDATE tasks SET status = :status WHERE id = :id";
    $stmt = $this->connect->prepare($sql);
    $stmt->bindParam(':id', $taskId);
    $stmt->bindParam(':status', $status);
    return $stmt->execute() ? $stmt->rowCount() : false;
  }

  /**
   * @param int $id
   * @return int|bool
   */
  public function delete(int $id)
  {
    $sql = "DELETE FROM tasks WHERE id = :id";
    $stmt = $this->connect->prepare($sql);
    $stmt->bindParam(':id', $id);
    return $stmt->execute() ? $stmt->rowCount() : false;
  }

}
