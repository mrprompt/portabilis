<?php
namespace App\Repository;

use App\Entity\CourseEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class CourseRepository extends ServiceEntityRepository
{
    /**
     * Constructor
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CourseEntity::class);

        $this->em = $this->getEntityManager();
    }
    
    /**
     * Create course
     */
    public function create(CourseEntity $user)
    {
        $this->em->persist($user);
        $this->em->flush();

        return $user;
    }
}
