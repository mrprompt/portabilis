<?php
namespace App\Service;

class Password
{
    /**
     * @var array
     */
    private $config;

    /**
     * Password constructor.
     *
     * @param int $cost
     */
    public function __construct(int $cost = 12)
    {
        $this->config = ['cost' => $cost];
    }

    /**
     * @param string $password
     * @param int $cost
     * @return string
     */
    public function generate(string $password, int $cost): string
    {
        return password_hash($password, PASSWORD_BCRYPT, ["cost" => $cost]);
    }

    /**
     * @param string $password
     * @param string $hash
     * @return bool
     */
    public function verify(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }
}
