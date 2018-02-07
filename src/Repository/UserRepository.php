<?php
namespace App\Repository;

use App\Entity\User as UserEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class UserRepository extends ServiceEntityRepository
{
    /**
     * Entity manager
     */
    private $em;
    
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
        $this->em->persist($user);
        $this->em->flush();

        return $user;
    }
}
