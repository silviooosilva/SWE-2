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

    // Processamento de tarefas de alta prioridade
    foreach($highPriority as $task){

        $bestEngineer = null;
        $minLoad = PHP_INT_MAX;
        $bestEngineerFallback = null;
        $minOverload = PHP_INT_MAX;

        foreach($engineers as $engineer){
          $assignedTasks = $this->taskRepository->findByEngineer($engineer['id']);

          // Verifica se o engenheiro já está trabalhando em uma tarefa ativa
          $active = false;
          foreach ($assignedTasks as $existingTask) {
             if(in_array($existingTask['status'], ['Pendente', 'Em andamento'])) {
                 $active = true;
                 break;
             }
          }
          if($active){
            continue; // Não considerar este engenheiro, pois já possui uma tarefa ativa.
          }
          
          $currentLoad = $this->calculateCurrentLoad($engineer, $assignedTasks);
          $taskEffectiveTime = $this->effectiveTime($task['time'], $engineer['efficiency']);

          if(($currentLoad + $taskEffectiveTime) <= $engineer['max_workload'] && $currentLoad < $minLoad) {
            $bestEngineer = $engineer;
            $minLoad = $currentLoad;
          } else {
            $overload = ($currentLoad + $taskEffectiveTime) - $engineer['max_workload'];
            if($overload < $minOverload) {
                $minOverload = $overload;
                $bestEngineerFallback = $engineer;
            }
          }
        }

        if($bestEngineer) {
          $this->taskRepository->assingTask($task['id'], $bestEngineer['id']);
        } elseif($bestEngineerFallback) {
          $this->taskRepository->assingTask($task['id'], $bestEngineerFallback['id']);
        }
    }

    // Processamento de tarefas de média prioridade
    $engineerCount = count($engineers);
    $index = 0;

    foreach($mediumPriority as $task){
       for($i = 0; $i < $engineerCount; $i++) {
          $engineer = $engineers[($index + $i) % $engineerCount];
          $assignedTasks = $this->taskRepository->findByEngineer($engineer['id']);

          // Verifica se o engenheiro já possui uma tarefa ativa
          $active = false;
          foreach ($assignedTasks as $existingTask) {
             if(in_array($existingTask['status'], ['Pendente', 'Em andamento'])) {
                 $active = true;
                 break;
             }
          }
          if($active){
            continue;
          }
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
