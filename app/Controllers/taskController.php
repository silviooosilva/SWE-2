<?php

use Silviooosilva\Clarifiquei\Models\Engineer;
use Silviooosilva\Clarifiquei\Models\Task;
use Silviooosilva\Clarifiquei\Services\TaskAllocationService;

require_once __DIR__ . '/../../vendor/autoload.php';

if($_GET['action'] === 'store'){


  $taskName = filter_var($_POST['taskName'], FILTER_DEFAULT);
  $priority = filter_var($_POST['priority'], FILTER_DEFAULT);
  $time = filter_var($_POST['time'], FILTER_DEFAULT);
  $status = filter_var($_POST['status'], FILTER_DEFAULT);

  $Task = new Task();
  $Engineer = new Engineer();
  $AllocationService = new TaskAllocationService();

  if($Task->store($taskName, $priority, $time, $status)){
    if($AllocationService->allocateTask()){
      echo json_encode(['status' => 'success', 'message' => 'Tarefa cadastrada com sucesso!']);
      return;
    } else {
      echo json_encode(['status' => 'error', 'message' => 'Erro ao alocar tarefa!']);
      return;
    }
  } else {
    echo json_encode(['status' => 'error', 'message' => 'Erro ao cadastrar tarefa!']);
    return;
  }
}

if($_GET['action'] === 'startTask'){

  $taskId = filter_var($_POST['id'], FILTER_VALIDATE_INT);

  $Task = new Task();
  $Engineer = new Engineer();
  $AllocationService = new TaskAllocationService();

  if($Task->startTask($taskId)){
    echo json_encode(['status' => 'success', 'message' => 'Tarefa iniciada com sucesso!']);
    return;
  } else {
    echo json_encode(['status' => 'error', 'message' => 'Erro ao iniciar tarefa!']);
    return;
  }
}

if($_GET['action'] === 'finishTask'){

  $taskId = filter_var($_POST['id'], FILTER_VALIDATE_INT);

  $Task = new Task();
  $Engineer = new Engineer();
  $AllocationService = new TaskAllocationService();

  if($Task->finishTask($taskId)){
    echo json_encode(['status' => 'success', 'message' => 'Tarefa concluída com sucesso!']);
    return;
  } else {
    echo json_encode(['status' => 'error', 'message' => 'Erro ao concluir tarefa!']);
    return;
  }
}

if($_GET['action'] === 'closeTask'){

  $taskId = filter_var($_POST['id'], FILTER_VALIDATE_INT);

  $Task = new Task();
  $Engineer = new Engineer();
  $AllocationService = new TaskAllocationService();

  if($Task->closeTask($taskId)){
    echo json_encode(['status' => 'success', 'message' => 'Tarefa encerrada com sucesso!']);
    return;
  } else {
    echo json_encode(['status' => 'error', 'message' => 'Erro ao encerrar tarefa!']);
    return;
  }
}