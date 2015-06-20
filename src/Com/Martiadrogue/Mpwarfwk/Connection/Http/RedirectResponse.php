<?php

namespace Com\Martiadrogue\Mpwarfwk\Connection\Http;

use Com\Martiadrogue\Mpwarfwk\Connection\Responsible;

class RedirectResponse implements Responsible
{
    private $url;
    private $status; // 301, 302
    private $headers;

    public function __construct($url, $status)
    {
        $this->url = $url;
        $this->status = $status;
        $this->headers = [
                    301 => 'HTTP/1.1 301 Moved Permanently',
                    302 => 'HTTP/1.1 302 Found',
                    404 => 'HTTP/1.0 404 Not Found; charset=UTF-8',
                ];
    }

    public function send()
    {
        $this->sendHeaders();

        if (function_exists('fastcgi_finish_request')) {
            fastcgi_finish_request();
        } elseif ('cli' !== PHP_SAPI) {
            static::closeOutputBuffers(0, true);
        }
    }

    public function getDestination()
    {
        return $this->url;
    }

    public function getStatus()
    {
        return $this->status;
    }

    private function sendHeaders()
    {
        mb_http_output('UTF-8');
        header($this->headers[$this->status]);
        if ($this->status === 404) {
            return;
        }
        header('Location: '.$this->url);
    }

    /**
     * Cleans or flushes output buffers up to target level.
     *
     * Resulting level can be greater than target level if a non-removable buffer has been encountered.
     *
     * @param int  $targetLevel The target output buffering level
     * @param bool $flush       Whether to flush or clean the buffers
     */
    public static function closeOutputBuffers($targetLevel, $flush)
    {
        $status = ob_get_status(true);
        $level = count($status);

        while ($level-- > $targetLevel
            && (!empty($status[$level]['del'])
                || (isset($status[$level]['flags'])
                    && ($status[$level]['flags'] & PHP_OUTPUT_HANDLER_REMOVABLE)
                    && ($status[$level]['flags'] & ($flush ? PHP_OUTPUT_HANDLER_FLUSHABLE : PHP_OUTPUT_HANDLER_CLEANABLE))
                )
            )
        ) {
            if ($flush) {
                ob_end_flush();

                return;
            }

            ob_end_clean();
        }
    }
}
