<?php

namespace Com\Martiadrogue\Mpwarfwk\Security\Hashes;

class CsrfToken
{
    public function __construct()
    {
    }

    public function generate()
    {
        $hash = openssl_random_pseudo_bytes(32);

        return base64_encode($hash);
    }
}
