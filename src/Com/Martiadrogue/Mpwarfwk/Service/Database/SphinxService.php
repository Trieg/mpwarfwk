<?php

namespace Com\Martiadrogue\Mpwarfwk\Service\Database;

/**
 *
 */
class SphinxService
{
    private $sphinx;

    public function __construct()
    {
        include '/var/lib/sphinx/api/sphinxapi.php';
        $this->sphinx = new \SphinxClient();
        $this->sphinx->SetServer('127.0.0.1', 9312);
        $this->sphinx->SetMatchMode(SPH_MATCH_EXTENDED);
        $this->sphinx->SetSortMode(SPH_SORT_RELEVANCE);
        $this->sphinx->SetLimits(0, 5);
    }

    public function addQuery($queryString, $index)
    {
        $this->sphinx->AddQuery($queryString, $index);

        return $this->sphinx->RunQueries();
    }
}
