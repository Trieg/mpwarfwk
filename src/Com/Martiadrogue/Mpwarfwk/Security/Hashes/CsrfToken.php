<?php

namespace Com\Martiadrogue\Mpwarfwk\Security\Hashes;

use Com\Martiadrogue\Mpwarfwk\Connection\Http\Session;
use Com\Martiadrogue\Mpwarfwk\Exception\TokenMismatchException;

class CsrfToken
{
    private $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function generate()
    {
        $hash = openssl_random_pseudo_bytes(32);
        $hashEncoded = base64_encode($hash);
        $this->session->setValue('csrf-token', $hashEncoded);

        return $hashEncoded;
    }

    public function check($token)
    {
        if ($token !== $this->session->getData('csrf-token')) {
            throw new TokenMismatchException();
        }

        $this->session->unsetData('csrf-token');
    }
}
