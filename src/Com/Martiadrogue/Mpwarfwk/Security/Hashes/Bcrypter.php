<?php

namespace Com\Martiadrogue\Mpwarfwk\Security\Hashes;

class Bcrypter
{
    public function __construct()
    {
    }

    public function hash($password)
    {
        $options = [
                'cost' => 11,
                'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
            ];

        return password_hash($password, PASSWORD_BCRYPT, $options);
    }

    public function verifyPassword($password, $hash)
    {
        return password_verify($password, $hash);
    }
}
