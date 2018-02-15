<?php
namespace App\Repository;

use App\Entity\UserEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Symfony\Bridge\Doctrine\RegistryInterface;

class UserRepository extends ServiceEntityRepository
{
    /**
     * Constructor
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, UserEntity::class);

        $this->em = $this->getEntityManager();
    }
    
    /**
     * Create user
     */
    public function create(UserEntity $user)
    {
        try {
            $this->em->persist($user);
            $this->em->flush();

            return $user;
        } catch (UniqueConstraintViolationException $ex) {
            throw new \InvalidArgumentException("An user with this email or documents is already registered");
        }
    }
    
    /**
     * update user
     */
    public function update(int $id, UserEntity $user)
    {
        $search = $this->em->getRepository(UserEntity::class)->find($id);

        if (!$search) {
            throw $this->createNotFoundException('No user found for id ' . $id);
        }

        $search->setName($user->getName());
        $search->setEmail($user->getEmail());
        $search->setPhoneNumber($user->getPhoneNumber());

        $this->em->flush();

        return $search;
    }
}
