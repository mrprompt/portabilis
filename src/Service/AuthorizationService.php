<?php
declare(strict_types = 1);

namespace App\Service;

use App\Entity\UserEntity;
use App\Repository\UserRepository;
use App\Service\PasswordService;

class AuthorizationService
{
    /**
     * Repository
     * 
     * @var UserRepository
     */
    private $repository;

    /**
     * Password Service
     * 
     * @var PasswordService
     */
    private $password;

    /**
     * Constructor
     * 
     * @param UserRepository $repository
     * @param PasswordService $password
     */
    public function __construct(UserRepository $repository, PasswordService $password)
    {
        $this->repository = $repository;
        $this->password = $password;
    }

    /**
     * Create user
     * 
     * @param UserEntity $user
     * 
     * @throws InvalidArgumentException
     * 
     * @return UserEntity
     */
    public function authorize(UserEntity $user): UserEntity
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