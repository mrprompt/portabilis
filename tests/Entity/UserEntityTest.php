<?php
declare(strict_types = 1);

namespace App\Tests\Entity;

use App\Common\ChangeProtectedAttribute;
use App\Entity\UserEntity;
use PHPUnit\Framework\TestCase;
use stdClass;
use DateTime;

/**
 * User test case.
 *
 * @author Thiago Paes <mrprompt@gmail.com>
 */
class UserEntityTest extends TestCase
{
    use ChangeProtectedAttribute;

    /**
     * The user entity
     * 
     * @var UserEntity
     */
    private $user;

    /**
     * Setup
     */
    public function setUp()
    {
        parent::setUp();
        
        $this->user = new UserEntity;
    }

    /**
     * Shutdown
     */
    public function tearDown()
    {
        $this->user = null;
        
        parent::tearDown();
    }

    /**
     * @return multitype:multitype:number
     */
    public function validObjects()
    {
        $obj = new stdClass();
        $obj->id = 1;
        $obj->name  = 'Teste';
        $obj->email = 'teste@teste.net';
        $obj->password = 'fooo';
        $obj->createdAt = new DateTime;
        $obj->updatedAt = new DateTime;
        $obj->birthday = new DateTime;
        $obj->document_rg = '1111111';
        $obj->document_cpf = '11111111111';
        $obj->phone_number = '999999999999';

        return [
            [
                $obj
            ]
        ];
    }

    /**
     * @test
     * @dataProvider validObjects
     * @covers       \App\Entity\UserEntity::getId
     */
    public function getIdReturnValue($obj)
    {
        $this->modifyAttribute($this->user, 'id', $obj->id);

        $this->assertEquals($this->user->getId(), $obj->id);
    }

    /**
     * @test
     * @dataProvider validObjects
     * @covers       \App\Entity\UserEntity::setName
     */
    public function setNameReturnEmpty($obj)
    {
        $result = $this->user->setName($obj->name);

        $this->assertEmpty($result);
    }

    /**
     * @test
     * @dataProvider validObjects
     * @covers       \App\Entity\UserEntity::getName
     */
    public function getNameReturnValue($obj)
    {
        $this->modifyAttribute($this->user, 'name', $obj->name);

        $this->assertEquals($this->user->getName(), $obj->name);
    }

    /**
     * @test
     * @dataProvider validObjects
     * @covers       \App\Entity\UserEntity::setEmail
     */
    public function setEmailReturnEmpty($obj)
    {
        $result = $this->user->setEmail($obj->email);

        $this->assertEmpty($result);
    }
    
    /**
     * @test
     * @dataProvider validObjects
     * @covers       \App\Entity\UserEntity::getEmail
     */
    public function getEmailReturnValue($obj)
    {
        $this->modifyAttribute($this->user, 'email', $obj->email);

        $this->assertEquals($this->user->getEmail(), $obj->email);
    }

    /**
     * @test
     * @dataProvider validObjects
     * @covers       \App\Entity\UserEntity::setPassword
     */
    public function setPasswordReturnEmpty($obj)
    {
        $result = $this->user->setPassword($obj->password);

        $this->assertEmpty($result);
    }
    
    /**
     * @test
     * @dataProvider validObjects
     * @covers       \App\Entity\UserEntity::getPassword
     */
    public function getPasswordReturnValue($obj)
    {
        $this->modifyAttribute($this->user, 'password', $obj->password);

        $this->assertEquals($this->user->getPassword(), $obj->password);
    }

    /**
     * @test
     * @dataProvider validObjects
     * @covers       \App\Entity\UserEntity::setDocumentRG
     */
    public function setDocumentRGReturnEmpty($obj)
    {
        $result = $this->user->setDocumentRG($obj->document_rg);

        $this->assertEmpty($result);
    }
    
    /**
     * @test
     * @dataProvider validObjects
     * @covers       \App\Entity\UserEntity::getDocumentRG
     */
    public function getDocumentRGReturnValue($obj)
    {
        $this->modifyAttribute($this->user, 'document_rg', $obj->document_rg);

        $this->assertEquals($this->user->getDocumentRG(), $obj->document_rg);
    }

    /**
     * @test
     * @dataProvider validObjects
     * @covers       \App\Entity\UserEntity::setDocumentCPF
     */
    public function setDocumentCPFReturnEmpty($obj)
    {
        $result = $this->user->setDocumentCPF($obj->document_cpf);

        $this->assertEmpty($result);
    }
    
    /**
     * @test
     * @dataProvider validObjects
     * @covers       \App\Entity\UserEntity::getDocumentCPF
     */
    public function getDocumentCPFReturnValue($obj)
    {
        $this->modifyAttribute($this->user, 'document_cpf', $obj->document_cpf);

        $this->assertEquals($this->user->getDocumentCPF(), $obj->document_cpf);
    }

    /**
     * @test
     * @dataProvider validObjects
     * @covers       \App\Entity\UserEntity::setPhoneNumber
     */
    public function setPhoneNumberReturnEmpty($obj)
    {
        $result = $this->user->setPhoneNumber($obj->phone_number);

        $this->assertEmpty($result);
    }
    
    /**
     * @test
     * @dataProvider validObjects
     * @covers       \App\Entity\UserEntity::getPhoneNumber
     */
    public function getPhoneNumberReturnValue($obj)
    {
        $this->modifyAttribute($this->user, 'phone_number', $obj->phone_number);

        $this->assertEquals($this->user->getPhoneNumber(), $obj->phone_number);
    }

    /**
     * @test
     * @dataProvider validObjects
     * @covers       \App\Entity\UserEntity::setBirthday
     */
    public function setBirthdayReturnEmpty($obj)
    {
        $result = $this->user->setBirthday($obj->birthday);

        $this->assertEmpty($result);
    }
    
    /**
     * @test
     * @dataProvider validObjects
     * @covers       \App\Entity\UserEntity::getBirthday
     */
    public function getBirthdayReturnValue($obj)
    {
        $this->modifyAttribute($this->user, 'birthday', $obj->birthday);

        $this->assertEquals($this->user->getBirthday(), $obj->birthday);
    }

    /**
     * @test
     * @dataProvider validObjects
     * @covers       \App\Entity\UserEntity::setCreatedAt
     */
    public function setCreatedAtReturnEmpty($obj)
    {
        $result = $this->user->setCreatedAt($obj->createdAt);

        $this->assertEmpty($result);
    }

    /**
     * @test
     * @dataProvider validObjects
     * @covers       \App\Entity\UserEntity::getCreatedAt
     */
    public function getCreatedAtReturnValue($obj)
    {
        $this->modifyAttribute($this->user, 'createdAt', $obj->createdAt);

        $this->assertEquals($this->user->getCreatedAt(), $obj->createdAt);
    }

    /**
     * @test
     * @dataProvider validObjects
     * @covers       \App\Entity\UserEntity::setUpdatedAt
     */
    public function setUpdatedAtReturnEmpty($obj)
    {
        $result = $this->user->setUpdatedAt($obj->updatedAt);

        $this->assertEmpty($result);
    }

    /**
     * @test
     * @dataProvider validObjects
     * @covers       \App\Entity\UserEntity::getUpdatedAt
     */
    public function getUpdatedAtReturnValue($obj)
    {
        $this->modifyAttribute($this->user, 'updatedAt', $obj->updatedAt);

        $this->assertEquals($this->user->getUpdatedAt(), $obj->updatedAt);
    }
}
