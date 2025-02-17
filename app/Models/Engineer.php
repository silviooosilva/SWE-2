<?php

namespace Silviooosilva\Clarifiquei\Models;

use Silviooosilva\Clarifiquei\Repository\EngineerRepository;

class Engineer
{

  /** @var EngineerRepository */
  private $engineerRepository;

  public function __construct()
  {
    $this->engineerRepository = new EngineerRepository();
  }

  /**
  * @return array
   */
  public function index()
  {
    return $this->engineerRepository->all() ?? [];
  }

  /**
  * @param string $name
  * @param float $maxWorkLoad
  * @param float $efficiency
  * @return int|bool
   */
  public function store(string $name, float $maxWorkLoad, float $efficiency)
  {
    return $this->engineerRepository->create($name, $maxWorkLoad, $efficiency);
  }

  /**
  * @param int $id
  * @return array
  */
  public function show(int $id)
  {
    return $this->engineerRepository->find($id);
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
    return $this->engineerRepository->update($id, $name, $maxWorkLoad, $efficiency);
  }

  /**
  * @param int $id
  * @return int|bool
  */
  public function delete(int $id)
  {
    return $this->engineerRepository->delete($id);
  }

}
