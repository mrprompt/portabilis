<?php
namespace App\Service;

use InvalidArgumentException;
use Exception;
use App\Entity\User as UserEntity;
use App\Repository\UserRepository;
use App\Service\PasswordService;
use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\NestedValidationException;

class UserService 
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
    public function create(UserEntity $user)
    {
        $user->setPassword($this->password->generate($user->getPassword(), 12));
        $user->setDocumentCPF(preg_replace('/[^[:digit:]]/', '', $user->getDocumentCPF()));
        $user->setDocumentRG(preg_replace('/[^[:digit:]]/', '', $user->getDocumentRG()));
        $user->setPhoneNumber(preg_replace('/[^[:digit:]]/', '', $user->getPhoneNumber()));
            
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