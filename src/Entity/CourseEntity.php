<?php
declare(strict_types = 1);

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Course
 *
 * @ORM\Table(name="courses")
 * @ORM\Entity(repositoryClass="App\Repository\CourseRepository")
 * @ORM\HasLifecycleCallbacks
 */
class CourseEntity
{
    use BaseEntity;

    const PERIOD = ['matutino', 'vespertino', 'noturno'];
    
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="internal_id", type="integer", nullable=true)
     */
    private $internal_id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @Assert\NotBlank(message="Name should not be blank")
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="monthly_payment", type="float", options={"default"= 0})
     */
    private $monthly_payment;

    /**
     * @var string
     *
     * @ORM\Column(name="registration_fee", type="float", options={"default"= 0})
     */
    private $registration_fee;

    /**
     * @var string
     *
     * @ORM\Column(name="period", type="string", length=11)
     * @Assert\Choice(
     *     choices = { "matutino", "vespertino", "noturno" },
     *     message = "Choose a valid period."
     * )
     */
    private $period;

    /**
     * @var string
     *
     * @ORM\Column(name="duration", type="integer", options={"default" = 1})
     * @Assert\NotBlank(message="Duration should not be blank")
     */
    private $duration;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     * @Assert\Type("\DateTime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     * @Assert\Type("\DateTime")
     */
    private $updatedAt;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->createdAt = new DateTime;
        $this->updatedAt = new DateTime;
    }

    /**
     * Get the value of id
     *
     * @return int
     */ 
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName():string
    {
        return $this->name;
    }

    /**
     * Get the value of monthly_payment
     *
     * @return float
     */ 
    public function getMonthlyPayment(): float
    {
        return $this->monthly_payment;
    }

    /**
     * Set the value of monthly_payment
     *
     * @param  float $monthly_payment
     */ 
    public function setMonthlyPayment(float $monthly_payment)
    {
        $this->monthly_payment = $monthly_payment;
    }

    /**
     * Get the value of registration_fee
     *
     * @return float
     */ 
    public function getRegistrationFee(): float
    {
        return $this->registration_fee;
    }

    /**
     * Set the value of registration_fee
     *
     * @param float $registration_fee
     */ 
    public function setRegistrationFee(float $registration_fee)
    {
        $this->registration_fee = $registration_fee;
    }

    /**
     * Get the value of period
     *
     * @return string
     */ 
    public function getPeriod(): string
    {
        return $this->period;
    }

    /**
     * Set the value of period
     *
     * @param string $period
     */ 
    public function setPeriod(string $period)
    {
        if (!in_array($period, self::PERIOD)) {
            throw new \TypeError('Invalid period');
        }
        
        $this->period = $period;
    }

    /**
     * Get the value of duration
     *
     * @return int
     */ 
    public function getDuration(): int
    {
        return $this->duration;
    }

    /**
     * Set the value of duration
     *
     * @param int $duration
     */ 
    public function setDuration(int $duration)
    {
        $this->duration = $duration;
    }

    /**
     * Get the value of internal_id
     *
     * @return  int
     */ 
    public function getInternalId()
    {
        return $this->internal_id;
    }

    /**
     * Set the value of internal_id
     *
     * @param  int  $internal_id
     */ 
    public function setInternalId(int $internal_id)
    {
        $this->internal_id = $internal_id;
    }
}
