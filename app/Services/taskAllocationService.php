<?php

namespace Silviooosilva\Clarifiquei\Services;

use Silviooosilva\Clarifiquei\Repository\TaskRepository;
use Silviooosilva\Clarifiquei\Repository\EngineerRepository;

class TaskAllocationService
{

  /** @var TaskRepository */
  private $taskRepository;

  /** @var EngineerRepository */
  private $engineerRepository; 

  public function __construct()
  {
    $this->taskRepository = new TaskRepository();
    $this->engineerRepository = new EngineerRepository();
  }

  private function effectiveTime(float $taskTime, float $engineerEfficiency): float
  {
    return $taskTime * ((100 - $engineerEfficiency) / 100);
  }

  private function calculateCurrentLoad($engineer, $engineerTasks)
  {
    $currentLoad = 0;
    foreach ($engineerTasks as $task) {
      $currentLoad += $this->effectiveTime($task['time'], $engineer['efficiency']);
    }
    return $currentLoad;
  }

  public function allocateTask()
  {
    $engineers = $this->engineerRepository->all();
    $tasks = $this->taskRepository->findUnassigned();

    $highPriority = [];
    $mediumPriority = [];

    foreach($tasks as $task){
        if($task['priority'] === 'alta'){
            $highPriority[] = $task;
        } else {
            $mediumPriority[] = $task;
        }
    }

    foreach($highPriority as $task){

        $bestEngineer = null;
        $minLoad = PHP_INT_MAX;

        foreach($engineers as $engineer){

          $assignedTasks = $this->taskRepository->findByEngineer($engineer['id']);
          $currentLoad = $this->calculateCurrentLoad($engineer, $assignedTasks);
          $taskEffectiveTime = $this->effectiveTime($task['time'], $engineer['efficiency']);

          if(($currentLoad + $taskEffectiveTime) <= $engineer['max_workload'] && $currentLoad < $minLoad) 
          {
            $bestEngineer = $engineer;
            $minLoad = $currentLoad;
          }
        }

        if($bestEngineer) {
          $this->taskRepository->assingTask($task['id'], $bestEngineer['id']);
        }
    }

    $engineerCount = count($engineers);
    $index = 0;

    foreach($mediumPriority as $task){
       for($i = 0; $i < $engineerCount; $i++) {
          $engineer = $engineers[($index + $i) % $engineerCount];
          $assignedTasks = $this->taskRepository->findByEngineer($engineer['id']);
          $currentLoad = $this->calculateCurrentLoad($engineer, $assignedTasks);
          $taskEffectiveTime = $this->effectiveTime($task['time'], $engineer['efficiency']);

          if(($currentLoad + $taskEffectiveTime) <= $engineer['max_workload']) {
            $this->taskRepository->assingTask($task['id'], $engineer['id']);
            $index = ($index + $i + 1) % $engineerCount;
            break;
          }
      }
    }

    return true;  

  }

}