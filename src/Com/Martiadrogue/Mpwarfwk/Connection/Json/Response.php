<?php
namespace Com\Martiadrogue\Mpwarfwk\Connection\Json;

/**
 *
 */
class Response implements Responsible
{
    private $content;
    private $status;

    public function __construct($content, $status)
    {
        $this->setContent($content);
        $this->status = $status;
    }

    public function send()
    {
        mb_http_output('UTF-8');

        if ($this->status !== 200) {
            header('HTTP/1.0 404 Not Found; charset=UTF-8');
        } else {
            header('Content-Type: application/json; charset=UTF-8');
        }
        $this->sendHeaders();
        $this->sendContent();
        fastcgi_finish_request();
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getStatus()
    {
        return $this->status;
    }

    private function setContent($data)
    {
        if (!$this->isContent($data)) {
            throw new \UnexpectedValueException(sprintf('The Response content must be a string or object implementing __toString(), "%s" given.', gettype($content)));
        }

        $this->content = $data;
    }

    private function isContent($data)
    {
        $isString = is_string($data);
        $isObjectWithToString = is_callable(array($data, '__toString'));

        return $isString || $isObjectWithToString;
    }
}
