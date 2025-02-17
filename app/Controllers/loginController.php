<?php

use Silviooosilva\Clarifiquei\Models\User;
use Silviooosilva\Phession\Phession;

require_once __DIR__ . '/../../vendor/autoload.php';

Phession::start();
if($_GET['action'] === 'login'){

  $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
  $password = filter_var($_POST['password'], FILTER_DEFAULT);

  $user = User::attmpt($email, $password);


  if($user){
    Phession::set('user', $user);

    echo json_encode(['status' => 'success', 'message' => 'Usuário autenticado com sucesso!']);
    return;
  } else {
    echo json_encode(['status' => 'error', 'message' => 'Erro ao autenticar usuário!']);
    return;
  }

}