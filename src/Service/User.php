<?php
namespace App\Service;

use App\Repository\UserRepository as Repository;

class User 
{
    /**
     * Repository
     */
    private $repository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    public function create(UserEntity $user)
    {
        return $this->repository->create($user);
    }
}