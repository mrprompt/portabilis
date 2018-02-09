<?php
declare(strict_types = 1);

namespace App\Tests\Entity;

use App\Common\ChangeProtectedAttribute;
use App\Entity\Course;
use PHPUnit\Framework\TestCase;
use stdClass;
use DateTime;

/**
 * Course test case.
 *
 * @author Thiago Paes <mrprompt@gmail.com>
 */
class CourseTest extends TestCase
{
    use ChangeProtectedAttribute;

    private $course;

    /**
     * Setup
     */
    public function setUp()
    {
        parent::setUp();
        
        $this->course = new Course;
    }

    /**
     * Shutdown
     */
    public function tearDown()
    {
        $this->course = null;
        
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
        $obj->monthly_payment = 15.00;
        $obj->registration_fee = 15.00;
        $obj->period = 'matutino';
        $obj->duration = 0;
        $obj->createdAt = new DateTime;
        $obj->updatedAt = new DateTime;

        $obj2 = clone $obj;
        $obj2->id = 2;
        $obj2->period = 'vespertino';
        $obj2->duration = 1;

        $obj3 = clone $obj;
        $obj3->id = 3;
        $obj3->period = 'noturno';
        $obj3->duration = rand();

        return [
            [
                $obj
            ],
            [
                $obj2
            ],
            [
                $obj3
            ],
        ];
    }

    /**
     * @return multitype:multitype:number
     */
    public function invalidObjects()
    {
        $obj = new stdClass();
        $obj->id = null;
        $obj->name  = null;
        $obj->monthly_payment = '';
        $obj->period = '';
        $obj->registration_fee = '';
        $obj->duration = '';
        $obj->createdAt = '2018-01-01';
        $obj->updatedAt = '2018-01-01';

        $obj2 = clone $obj;
        $obj2->period = 'fooo';

        return [
            [
                $obj
            ],
            [
                $obj2
            ]
        ];
    }

    /**
     * @test
     * @dataProvider validObjects
     * @covers       \App\Entity\Course::__construct
     * @covers       \App\Entity\Course::getId
     */
    public function getIdReturnValue($obj)
    {
        $this->modifyAttribute($this->course, 'id', $obj->id);

        $this->assertEquals($this->course->getId(), $obj->id);
    }

    /**
     * @test
     * @dataProvider validObjects
     * @covers       \App\Entity\Course::__construct
     * @covers       \App\Entity\Course::setName
     */
    public function setNameReturnEmpty($obj)
    {
        $result = $this->course->setName($obj->name);

        $this->assertEmpty($result);
    }

    /**
     * @test
     * @dataProvider invalidObjects
     * @covers       \App\Entity\Course::__construct
     * @covers       \App\Entity\Course::setName
     * @expectedException \TypeError
     */
    public function setNameWithoutStringThrowsException($obj)
    {
        $this->course->setName($obj->name);
    }

    /**
     * @test
     * @dataProvider validObjects
     * @covers       \App\Entity\Course::__construct
     * @covers       \App\Entity\Course::getName
     */
    public function getNameReturnValue($obj)
    {
        $this->modifyAttribute($this->course, 'name', $obj->name);

        $this->assertEquals($this->course->getName(), $obj->name);
    }

    /**
     * @test
     * @dataProvider validObjects
     * @covers       \App\Entity\Course::__construct
     * @covers       \App\Entity\Course::setMonthlyPayment
     */
    public function setMonthlyPaymentReturnEmpty($obj)
    {
        $result = $this->course->setMonthlyPayment($obj->monthly_payment);

        $this->assertEmpty($result);
    }

    /**
     * @test
     * @dataProvider invalidObjects
     * @covers       \App\Entity\Course::__construct
     * @covers       \App\Entity\Course::setMonthlyPayment
     * @expectedException \TypeError
     */
    public function setMonthlyPaymentThrowsExceptionWithInvalidValue($obj)
    {
        $this->course->setMonthlyPayment($obj->monthly_payment);
    }

    /**
     * @test
     * @dataProvider validObjects
     * @covers       \App\Entity\Course::__construct
     * @covers       \App\Entity\Course::getMonthlyPayment
     */
    public function getMonthlyPaymentReturnValue($obj)
    {
        $this->modifyAttribute($this->course, 'monthly_payment', $obj->monthly_payment);

        $this->assertEquals($this->course->getMonthlyPayment(), $obj->monthly_payment);
    }

    /**
     * @test
     * @dataProvider validObjects
     * @covers       \App\Entity\Course::__construct
     * @covers       \App\Entity\Course::setRegistrationFee
     */
    public function setRegistrationFeeReturnEmpty($obj)
    {
        $result = $this->course->setRegistrationFee($obj->registration_fee);

        $this->assertEmpty($result);
    }

    /**
     * @test
     * @dataProvider invalidObjects
     * @covers       \App\Entity\Course::__construct
     * @covers       \App\Entity\Course::setRegistrationFee
     * @expectedException \TypeError
     */
    public function setRegistrationFeeThrowsExceptionWithInvalidValue($obj)
    {
        $this->course->setRegistrationFee($obj->registration_fee);
    }

    /**
     * @test
     * @dataProvider validObjects
     * @covers       \App\Entity\Course::__construct
     * @covers       \App\Entity\Course::getRegistrationFee
     */
    public function getRegistrationFeeReturnValue($obj)
    {
        $this->modifyAttribute($this->course, 'registration_fee', $obj->registration_fee);

        $this->assertEquals($this->course->getRegistrationFee(), $obj->registration_fee);
    }

    /**
     * @test
     * @dataProvider validObjects
     * @covers       \App\Entity\Course::__construct
     * @covers       \App\Entity\Course::setPeriod
     */
    public function setPeriodReturnEmpty($obj)
    {
        $result = $this->course->setPeriod($obj->period);

        $this->assertEmpty($result);
    }

    /**
     * @test
     * @dataProvider invalidObjects
     * @covers       \App\Entity\Course::__construct
     * @covers       \App\Entity\Course::setPeriod
     * @expectedException \TypeError
     */
    public function setPeriodWithoutStringThrowsException($obj)
    {
        $this->course->setPeriod($obj->period);
    }

    /**
     * @test
     * @dataProvider validObjects
     * @covers       \App\Entity\Course::__construct
     * @covers       \App\Entity\Course::getPeriod
     */
    public function getPeriodReturnValue($obj)
    {
        $this->modifyAttribute($this->course, 'period', $obj->period);

        $this->assertEquals($this->course->getPeriod(), $obj->period);
    }

    /**
     * @test
     * @dataProvider validObjects
     * @covers       \App\Entity\Course::__construct
     * @covers       \App\Entity\Course::setDuration
     */
    public function setDurationReturnEmpty($obj)
    {
        $result = $this->course->setDuration($obj->duration);

        $this->assertEmpty($result);
    }

    /**
     * @test
     * @dataProvider invalidObjects
     * @covers       \App\Entity\Course::__construct
     * @covers       \App\Entity\Course::setDuration
     * @expectedException \TypeError
     */
    public function setDurationThrowsExceptionWithInvalidValue($obj)
    {
        $this->course->setDuration($obj->duration);
    }

    /**
     * @test
     * @dataProvider validObjects
     * @covers       \App\Entity\Course::__construct
     * @covers       \App\Entity\Course::getDuration
     */
    public function getDurationReturnValue($obj)
    {
        $this->modifyAttribute($this->course, 'duration', $obj->duration);

        $this->assertEquals($this->course->getDuration(), $obj->duration);
    }

    /**
     * @test
     * @dataProvider validObjects
     * @covers       \App\Entity\Course::__construct
     * @covers       \App\Entity\Course::setCreatedAt
     */
    public function setCreatedAtReturnEmpty($obj)
    {
        $result = $this->course->setCreatedAt($obj->createdAt);

        $this->assertEmpty($result);
    }

    /**
     * @test
     * @dataProvider validObjects
     * @covers       \App\Entity\Course::__construct
     * @covers       \App\Entity\Course::getCreatedAt
     */
    public function getCreatedAtReturnValue($obj)
    {
        $this->modifyAttribute($this->course, 'createdAt', $obj->createdAt);

        $this->assertEquals($this->course->getCreatedAt(), $obj->createdAt);
    }

    /**
     * @test
     * @dataProvider validObjects
     * @covers       \App\Entity\Course::__construct
     * @covers       \App\Entity\Course::setUpdatedAt
     */
    public function setUpdatedAtReturnEmpty($obj)
    {
        $result = $this->course->setUpdatedAt($obj->updatedAt);

        $this->assertEmpty($result);
    }

    /**
     * @test
     * @dataProvider validObjects
     * @covers       \App\Entity\Course::__construct
     * @covers       \App\Entity\Course::getUpdatedAt
     */
    public function getUpdatedAtReturnValue($obj)
    {
        $this->modifyAttribute($this->course, 'updatedAt', $obj->updatedAt);

        $this->assertEquals($this->course->getUpdatedAt(), $obj->updatedAt);
    }
}
