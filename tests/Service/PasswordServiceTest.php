<?php
namespace App\Tests\Service;

use App\Service\PasswordService;
use PHPUnit\Framework\TestCase;

class PasswordServiceTest extends TestCase
{
    /**
     * @const int
     */
    const DEFAULT_COST = 12;
    
    private $service;

    /**
     * Bootstrap
     */
    public function setUp()
    {
        parent::setUp();

        $this->service = new PasswordService();
    }

    /**
     * @test
     */
    public function generateWithPasswordWithoutCostMustBeReturnNotEmpty()
    {
        $result = $this->service->generate('foo', self::DEFAULT_COST);

        $this->assertNotEmpty($result);
    }

    /**
     * @test
     */
    public function generateWithPasswordWithCostMustBeReturnNotEmpty()
    {
        $result = $this->service->generate('foo', self::DEFAULT_COST);

        $this->assertNotEmpty($result);
    }

    /**
     * @test
     */
    public function verifyMustBeReturnTrueWithValidPassword()
    {
        $clean      = 'foo';
        $encrypted  = '$2y$12$7ytxUXW5xwRMJyGYWRUKquUQEaCs7qhQlYOgs/S64u5jODYDE9shS';

        $verify     = $this->service->verify($clean, $encrypted);

        $this->assertTrue($verify);
    }

    /**
     * @test
     */
    public function verifyMustBeReturnFalseWithInvalidPassword()
    {
        $clean      = 'foobarbar';
        $encrypted  = '$2y$12$7ytxUXW5xwRMJyGYWRUKquUQEaCs7qhQlYOgs/S64u5jODYDE9shS';

        $verify     = $this->service->verify($clean, $encrypted);

        $this->assertFalse($verify);
    }
}
