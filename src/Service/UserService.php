<?php
namespace App\Service;

use App\Entity\User as UserEntity;
use App\Repository\UserRepository;

class UserService 
{
    /**
     * Repository
     */
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Create user
     */
    public function create(UserEntity $user)
    {
        return $this->repository->create($user);
    }
}