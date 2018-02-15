<?php
declare(strict_types = 1);

namespace App\Service;

/**
 * Password Service
 * 
 * @author Thiago Paes <mrprompt@gmail.com>
 */
class PasswordService
{
    /**
     * Generate a password
     * 
     * @param string $password
     * @param int $cost
     * 
     * @return string
     */
    public function generate(string $password, int $cost): string
    {
        return password_hash($password, PASSWORD_BCRYPT, ["cost" => $cost]);
    }

    /**
     * Verify password hash
     * 
     * @param string $password
     * @param string $hash
     * 
     * @return bool
     */
    public function verify(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }
}
