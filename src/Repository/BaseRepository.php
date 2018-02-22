<?php
namespace App\Repository;

use Doctrine\ORM\Query;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;

trait BaseRepository
{
    /**
     * Pagination
     * 
     * @param Query $query
     * @param int $page
     * 
     * @return PagerFanta
     */
    protected function createPaginator(Query $query, int $page = 1): Pagerfanta
    {
        $paginator = new Pagerfanta(new DoctrineORMAdapter($query));
        $paginator->setMaxPerPage(self::NUM_ITEMS);
        $paginator->setCurrentPage($page);
        
        return $paginator;
    }
}