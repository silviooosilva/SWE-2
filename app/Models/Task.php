<?php

namespace Silviooosilva\Clarifiquei\Models;

use Silviooosilva\Clarifiquei\Repository\TaskRepository;

class Task
{

  /** @var TaskRepository */
  private $taskRepository;

  public function __construct()
  {
    $this->taskRepository = new TaskRepository();
  }

  /**
  * @return array
   */
  public function index()
  {
    return $this->taskRepository->all() ?? [];
  }

  /**
  * @param string $name
  * @param string $priority
  * @param float $time
  * @param string $status
  * @param int|null $engineer_id
  * @return int|bool
   */
  public function store(string $name, string $priority, float $time, string $status, int $engineer_id = null)
  {
    return $this->taskRepository->create($name, $priority, $time, $status, $engineer_id);
  }

  /**
  * @param int $id
  * @return array
  */
  public function show(int $id)
  {
    return $this->taskRepository->find($id);
  }

  /**
  * @return array
  */
  public function getAllocations()
  {
    return $this->taskRepository->getAllocations();
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
    return $this->taskRepository->update($id, $name, $priority, $time, $status, $engineer_id);
  }

  /**
  * @param int $id
  * @return int|bool
  */
  public function startTask(int $id, string $status = 'Em andamento')
  {
    return $this->taskRepository->controlTaskStatus($id, $status);
  }

  /**
  * @param int $id
  * @return int|bool
  */
  public function finishTask(int $id, string $status = 'Concluída')
  {
    return $this->taskRepository->controlTaskStatus($id, $status);
  }

  /**
  * @param int $id
  * @return int|bool
  */
  public function closeTask(int $id, string $status = 'Encerrada')
  {
    return $this->taskRepository->controlTaskStatus($id, $status);
  }

  /**
  * @param int $id
  * @return int|bool
  */
  public function delete(int $id)
  {
    return $this->taskRepository->delete($id);
  }

}