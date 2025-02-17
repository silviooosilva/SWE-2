<?php

namespace Silviooosilva\Clarifiquei\Models;

use Silviooosilva\Clarifiquei\Repository\UserRepository;

class User
{

  /** @var UserRepository */
  private $userRepository;

  public function __construct()
  {
    $this->userRepository = new UserRepository();
  }

  /**
  * @return bool
  */
  public static function create()
  {
    $user = new User();
    return $user->userRepository->create();
  }

  /**
  * @param string $email
  * @param string $password
  * @return array|bool
  */
  public static function attmpt(string $email, string $password)
  {
    $user = new User();
    return $user->userRepository->login($email, $password);
  }

}