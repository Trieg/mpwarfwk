<?php

namespace Com\Martiadrogue\Mpwarfwk\Connection\Http\Filters;

use Com\Martiadrogue\Mpwarfwk\Connection\Http\Session;

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
        if ($token === $this->session->getData('csrf-token')) {
            $this->session->unsetData('csrf-token');

            return true;
        }

        return false;
    }
}
