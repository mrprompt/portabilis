<?php
declare(strict_types = 1);

namespace App\Service;

use App\Service\PasswordService;
use App\Entity\User as UserEntity;
use App\Repository\UserRepository;

class AuthorizationService
{
    /**
     * Repository
     */
    private $repository;

    /**
     * Password Service
     */
    private $password;

    public function __construct(UserRepository $repository, PasswordService $password)
    {
        $this->repository = $repository;
        $this->password = $password;
    }

    /**
     * Create user
     */
    public function authorize(UserEntity $user)
    {
        $search = $this->repository->findOneByEmail($user->getEmail());

        if (!$search) {
            throw new \InvalidArgumentException('User not authorized');
        }

        if ($this->password->verify($user->getPassword(), $search->getPassword())) {
            return $search;
        }

        throw new \InvalidArgumentException('User not authorized');
    }
}