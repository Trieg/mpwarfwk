<?php
namespace Com\Martiadrogue\Mpwarfwk\Connection\Http;

use Com\Martiadrogue\Mpwarfwk\Connection\Responsible;

/**
 *
 */
class Response implements Responsible
{
    private $content;
    private $status;

    public function __construct($content, $status)
    {
        $this->content = $content;
        $this->status = $status;
    }

    public function send()
    {
        $this->sendHeaders();
        $this->sendContent();

        if (function_exists('fastcgi_finish_request')) {
            fastcgi_finish_request();
        } elseif ('cli' !== PHP_SAPI) {
            static::closeOutputBuffers(0, true);
        }
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getStatus()
    {
        return $this->status;
    }

    private function sendHeaders()
    {
        mb_http_output('UTF-8');
        if ($this->status !== 200) {
            header('HTTP/1.0 404 Not Found; charset=UTF-8');
        } else {
            header('Content-Type: text/html; charset=UTF-8');
        }
    }

    private function sendContent()
    {
        echo $this->content;
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
            } else {
                ob_end_clean();
            }
        }
    }
}
