<?php

use Silviooosilva\Clarifiquei\Models\Engineer;

require_once __DIR__ . '/../../vendor/autoload.php';


$Engineer = new Engineer();

if($_GET['action'] === 'store'){

  $engineerName = filter_var($_POST['engineerName'], FILTER_DEFAULT);
  $workload = filter_var($_POST['workload'], FILTER_DEFAULT);
  $efficiency = filter_var($_POST['efficiency'], FILTER_DEFAULT);

  if($Engineer->store($engineerName, $workload, $efficiency)) {
    echo json_encode(['status' => 'success', 'message' => 'Engenheiro cadastrado com sucesso!']);
    return;
  } else {
    echo json_encode(['status' => 'error', 'message' => 'Erro ao cadastrar engenheiro!']);
    return;
  }


}

