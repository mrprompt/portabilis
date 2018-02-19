<?php
namespace App\Repository;

use App\Entity\UserEntity;
use App\Repository\BaseRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\Query;
use Pagerfanta\Pagerfanta;
use Symfony\Bridge\Doctrine\RegistryInterface;

class UserRepository extends ServiceEntityRepository
{
    use BaseRepository;
    
    const NUM_ITEMS = 30;
    
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

    /**
     * List all users
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
                SELECT u
                FROM App\Entity\UserEntity u
                ORDER BY u.name ASC
            ');

        return $this->createPaginator($query, $page);
    }
}
