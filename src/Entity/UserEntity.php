<?php
declare(strict_types = 1);

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * User Entity
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\HasLifecycleCallbacks
 * @UniqueEntity(
 *      fields={"email", "document_cpf", "document_rg"},
 *      message="An user with this documents is already registered"
 * )
 */
class UserEntity
{
    use BaseEntity;
    
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
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     * @Assert\Email(message="Email is invalid")
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     * @Assert\NotBlank(message="Password should not be blank")
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="document_rg", type="string", length=11, unique=true)
     * @Assert\NotBlank(message="RG should not be blank")
     */
    private $document_rg;

    /**
     * @var string
     *
     * @ORM\Column(name="document_cpf", type="string", length=11, unique=true)
     * @Assert\NotBlank(message="CPF should not be blank")
     */
    private $document_cpf;

    /**
     * @var string
     *
     * @ORM\Column(name="phone_number", type="string", length=20)
     * @Assert\NotBlank(message="Phone number should not be blank")
     */
    private $phone_number;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthday", type="datetime")
     * @Assert\NotBlank(message="Birthday is invalid")
     * @Assert\Type("\DateTime")
     */
    private $birthday;

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
     * constructor
     */
    public function __construct()
    {
        $this->createdAt = new DateTime;
        $this->updatedAt = new DateTime;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set email
     *
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set document_rg
     *
     * @param string $document_rg
     */
    public function setDocumentRG($document_rg)
    {
        $this->document_rg = preg_replace('/[^[:digit:]]/', '', $document_rg);
    }

    /**
     * Get document_rg
     *
     * @return string
     */
    public function getDocumentRG()
    {
        return $this->document_rg;
    }

    /**
     * Set document_cpf
     *
     * @param string $document_cpf
     */
    public function setDocumentCPF($document_cpf)
    {
        $this->document_cpf = preg_replace('/[^[:digit:]]/', '', $document_cpf);
    }

    /**
     * Get document_cpf
     *
     * @return string
     */
    public function getDocumentCPF()
    {
        return $this->document_cpf;
    }

    /**
     * Set phone_number
     *
     * @param string $phone_number
     */
    public function setPhoneNumber($phone_number)
    {
        $this->phone_number = preg_replace('/[^[:digit:]]/', '', $phone_number);
    }

    /**
     * Get phone_number
     *
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->phone_number;
    }

    /**
     * Set birthday
     *
     * @param \DateTime $birthday
     */
    public function setBirthday(DateTime $birthday)
    {
        $this->birthday = $birthday;
    }

    /**
     * Get birthday
     *
     * @return \DateTime
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Get the value of internal_id
     *
     * @return  int
     */ 
    public function getInternalId(): int
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
