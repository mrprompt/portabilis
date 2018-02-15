<?php
namespace App\Service;

use InvalidArgumentException;
use Exception;
use App\Entity\User as UserEntity;
use App\Repository\UserRepository;
use App\Service\PasswordService;
use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\NestedValidationException;

/**
 * User Service Class
 * 
 * @author Thiago Paes <mrprompt@gmail.com>
 */
class UserService 
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
     * @return UserEntity 
     */
    public function create(UserEntity $user): UserEntity
    {
        $user->setPassword($this->password->generate($user->getPassword(), 12));

        try {
            v::cpf()->validate($user->getDocumentCPF());
            
            return $this->repository->create($user);
        } catch (NestedValidationException $ex) {
            throw new InvalidArgumentException($ex->getMessage());
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}