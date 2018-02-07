<?php
declare(strict_types = 1);

namespace App\Tests\Entity;

use App\Common\ChangeProtectedAttribute;
use App\Entity\User;
use PHPUnit\Framework\TestCase;
use stdClass;
use DateTime;

/**
 * User test case.
 *
 * @author Thiago Paes <mrprompt@gmail.com>
 */
class UserTest extends TestCase
{
    use ChangeProtectedAttribute;

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
     * @covers       \App\Entity\User::getId
     */
    public function getIdReturnValue($obj)
    {
        $user = new User();

        $this->modifyAttribute($user, 'id', $obj->id);

        $this->assertEquals($user->getId(), $obj->id);
    }

    /**
     * @test
     * @dataProvider validObjects
     * @covers       \App\Entity\User::setName
     */
    public function setNameReturnEmpty($obj)
    {
        $user = new User();

        $result = $user->setName($obj->name);

        $this->assertEmpty($result);
    }

    /**
     * @test
     * @dataProvider validObjects
     * @covers       \App\Entity\User::getName
     */
    public function getNameReturnValue($obj)
    {
        $user = new User();

        $this->modifyAttribute($user, 'name', $obj->name);

        $this->assertEquals($user->getName(), $obj->name);
    }

    /**
     * @test
     * @dataProvider validObjects
     * @covers       \App\Entity\User::setEmail
     */
    public function setEmailReturnEmpty($obj)
    {
        $user = new User();

        $result = $user->setEmail($obj->email);

        $this->assertEmpty($result);
    }
    
    /**
     * @test
     * @dataProvider validObjects
     * @covers       \App\Entity\User::getEmail
     */
    public function getEmailReturnValue($obj)
    {
        $user = new User();

        $this->modifyAttribute($user, 'email', $obj->email);

        $this->assertEquals($user->getEmail(), $obj->email);
    }

    /**
     * @test
     * @dataProvider validObjects
     * @covers       \App\Entity\User::setPassword
     */
    public function setPasswordReturnEmpty($obj)
    {
        $user = new User();

        $result = $user->setPassword($obj->password);

        $this->assertEmpty($result);
    }
    
    /**
     * @test
     * @dataProvider validObjects
     * @covers       \App\Entity\User::getPassword
     */
    public function getPasswordReturnValue($obj)
    {
        $user = new User();

        $this->modifyAttribute($user, 'password', $obj->password);

        $this->assertEquals($user->getPassword(), $obj->password);
    }

    /**
     * @test
     * @dataProvider validObjects
     * @covers       \App\Entity\User::setDocumentRG
     */
    public function setDocumentRGReturnEmpty($obj)
    {
        $user = new User();

        $result = $user->setDocumentRG($obj->document_rg);

        $this->assertEmpty($result);
    }
    
    /**
     * @test
     * @dataProvider validObjects
     * @covers       \App\Entity\User::getDocumentRG
     */
    public function getDocumentRGReturnValue($obj)
    {
        $user = new User();

        $this->modifyAttribute($user, 'document_rg', $obj->document_rg);

        $this->assertEquals($user->getDocumentRG(), $obj->document_rg);
    }

    /**
     * @test
     * @dataProvider validObjects
     * @covers       \App\Entity\User::setDocumentCPF
     */
    public function setDocumentCPFReturnEmpty($obj)
    {
        $user = new User();

        $result = $user->setDocumentCPF($obj->document_cpf);

        $this->assertEmpty($result);
    }
    
    /**
     * @test
     * @dataProvider validObjects
     * @covers       \App\Entity\User::getDocumentCPF
     */
    public function getDocumentCPFReturnValue($obj)
    {
        $user = new User();

        $this->modifyAttribute($user, 'document_cpf', $obj->document_cpf);

        $this->assertEquals($user->getDocumentCPF(), $obj->document_cpf);
    }

    /**
     * @test
     * @dataProvider validObjects
     * @covers       \App\Entity\User::setPhoneNumber
     */
    public function setPhoneNumberReturnEmpty($obj)
    {
        $user = new User();

        $result = $user->setPhoneNumber($obj->phone_number);

        $this->assertEmpty($result);
    }
    
    /**
     * @test
     * @dataProvider validObjects
     * @covers       \App\Entity\User::getPhoneNumber
     */
    public function getPhoneNumberReturnValue($obj)
    {
        $user = new User();

        $this->modifyAttribute($user, 'phone_number', $obj->phone_number);

        $this->assertEquals($user->getPhoneNumber(), $obj->phone_number);
    }

    /**
     * @test
     * @dataProvider validObjects
     * @covers       \App\Entity\User::setBirthday
     */
    public function setBirthdayReturnEmpty($obj)
    {
        $user = new User();

        $result = $user->setBirthday($obj->birthday);

        $this->assertEmpty($result);
    }
    
    /**
     * @test
     * @dataProvider validObjects
     * @covers       \App\Entity\User::getBirthday
     */
    public function getBirthdayReturnValue($obj)
    {
        $user = new User();

        $this->modifyAttribute($user, 'birthday', $obj->birthday);

        $this->assertEquals($user->getBirthday(), $obj->birthday);
    }

    /**
     * @test
     * @dataProvider validObjects
     * @covers       \App\Entity\User::setCreatedAt
     */
    public function setCreatedAtReturnEmpty($obj)
    {
        $user = new User();

        $result = $user->setCreatedAt($obj->createdAt);

        $this->assertEmpty($result);
    }

    /**
     * @test
     * @dataProvider validObjects
     * @covers       \App\Entity\User::getCreatedAt
     */
    public function getCreatedAtReturnValue($obj)
    {
        $user = new User();

        $this->modifyAttribute($user, 'createdAt', $obj->createdAt);

        $this->assertEquals($user->getCreatedAt(), $obj->createdAt);
    }

    /**
     * @test
     * @dataProvider validObjects
     * @covers       \App\Entity\User::setUpdatedAt
     */
    public function setUpdatedAtReturnEmpty($obj)
    {
        $user = new User();

        $result = $user->setUpdatedAt($obj->updatedAt);

        $this->assertEmpty($result);
    }

    /**
     * @test
     * @dataProvider validObjects
     * @covers       \App\Entity\User::getUpdatedAt
     */
    public function getUpdatedAtReturnValue($obj)
    {
        $user = new User();

        $this->modifyAttribute($user, 'updatedAt', $obj->updatedAt);

        $this->assertEquals($user->getUpdatedAt(), $obj->updatedAt);
    }
}
