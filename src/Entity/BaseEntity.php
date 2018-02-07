<?php
declare(strict_types = 1);

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @author Thiago Paes <mrprompt@gmail.com>
 * @ORM\HasLifecycleCallbacks
 * @ORM\MappedSuperclass(repositoryClass="Doctrine\ORM\EntityRepository")
 */
trait BaseEntity
{
    /**
     * @ORM\PrePersist
     */
    public function onPrePersist()
    {
        $this->createdAt = new DateTime();
        $this->updatedAt = new DateTime();
    }

    /**
     * @ORM\PreUpdate
     */
    public function onPreUpdate()
    {
        $this->updatedAt = new DateTime();
    }
}
