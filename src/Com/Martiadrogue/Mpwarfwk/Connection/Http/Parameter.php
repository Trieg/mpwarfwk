<?php
namespace Com\Martiadrogue\Mpwarfwk\Connection\Http;
/**
 *
 */
class Parameter
{
    private $items;

    function __construct(Array $items)
    {
        $this->items = $items;
    }

    public function getItem($key)
    {
        if (array_key_exists($key, $this->items)) {
            return $this->items[$key];
        }
        return null;
    }
}
