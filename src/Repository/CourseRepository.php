<?php
namespace App\Repository;

use App\Entity\CourseEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\ORM\Query;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;

class CourseRepository extends ServiceEntityRepository
{
    const NUM_ITEMS = 30;
    
    /**
     * Constructor
     * 
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CourseEntity::class);

        $this->em = $this->getEntityManager();
    }

    private function createPaginator(Query $query, int $page): Pagerfanta
    {
        $paginator = new Pagerfanta(new DoctrineORMAdapter($query));
        $paginator->setMaxPerPage(self::NUM_ITEMS);
        $paginator->setCurrentPage($page);
        
        return $paginator;
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

    public function listAll(int $page = 1): Pagerfanta
    {
        $query = $this->getEntityManager()
            ->createQuery('
                SELECT c
                FROM App\Entity\CourseEntity c
                ORDER BY c.name ASC
            ');

        return $this->createPaginator($query, $page);
    }
}
