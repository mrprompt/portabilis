<?php
declare(strict_types = 1);

namespace App\Service;

use InvalidArgumentException;
use Exception;
use App\Entity\CourseEntity;
use App\Repository\CourseRepository;

/**
 * Course Service Class
 * 
 * @author Thiago Paes <mrprompt@gmail.com>
 */
class CourseService 
{
    /**
     * Repository
     * 
     * @var CourseRepository
     */
    private $repository;

    /**
     * Constructor
     * 
     * @param CourseRepository $repository
     */
    public function __construct(CourseRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Create course
     * 
     * @param CourseEntity $course
     * 
     * @return CourseEntity 
     * 
     * @throws InvalidArgumentException
     */
    public function create(CourseEntity $course): CourseEntity
    {
        try {
            return $this->repository->create($course);
        } catch (Exception $ex) {
            throw new InvalidArgumentException($ex->getMessage());
        }
    }

    /**
     * List all courses
     * 
     * @return array
     */
    public function findAll(int $page = 1): object
    {
        return $this->repository->listAll($page);
    }
}