<?php
declare(strict_types = 1);

namespace App\Service;

use InvalidArgumentException;
use Exception;
use App\Entity\CourseEntity;
use App\Repository\CourseRepository;
use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\NestedValidationException;

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
     * @throws Exception
     */
    public function create(CourseEntity $course): CourseEntity
    {
        try {
            return $this->repository->create($course);
        } catch (NestedValidationException $ex) {
            throw new InvalidArgumentException($ex->getMessage());
        } catch (Exception $ex) {
            throw new InvalidArgumentException($ex->getMessage());
        }
    }
}