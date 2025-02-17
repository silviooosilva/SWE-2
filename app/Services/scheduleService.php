<?php

namespace Silviooosilva\Clarifiquei\Services;

use Silviooosilva\Clarifiquei\Repository\TaskRepository;

class ScheduleService 
{
  /** @var TaskRepository */
  private $taskRepository;

  public function __construct()
  {
    $this->taskRepository = new TaskRepository();
  }

  public function getScheduleForEngineer(int $engineerId)
  {
    $tasks = $this->taskRepository->findByEngineer($engineerId);
    $dailyLimit = 8;
    $schedule = [];
    $currentDay = 1;
    $remainingTime = $dailyLimit;

    foreach($tasks as $task){
      if($task['time'] <= $remainingTime){
        $schedule[$currentDay][] = $task;
        $remainingTime -= $task['time'];
      } else {
        $currentDay++;
        $schedule[$currentDay][] = $task;
        $remainingTime = $dailyLimit - $task['time'];
      }
    }
    return $schedule;
  }
}