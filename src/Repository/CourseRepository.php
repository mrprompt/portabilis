<?php
namespace App\Repository;

use App\Entity\CourseEntity;
use App\Repository\BaseRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Pagerfanta\Pagerfanta;
use Symfony\Bridge\Doctrine\RegistryInterface;

class CourseRepository extends ServiceEntityRepository
{
    use BaseRepository;
    
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

    /**
     * Create course
     * 
     * @param CourseEntity $course
     * 
     * @return CourseEntity
     */
    public function create(CourseEntity $course): CourseEntity
    {
        $this->em->persist($course);
        $this->em->flush();

        return $course;
    }

    /**
     * List all courses
     * 
     * @param int $page
     * 
     * @return PagerFanta
     */
    public function listAll(int $page = 1): Pagerfanta
    {
        $query = $this
            ->em
            ->createQuery('
                SELECT c
                FROM App\Entity\CourseEntity c
                ORDER BY c.name ASC
            ');

        return $this->createPaginator($query, $page);
    }
}
