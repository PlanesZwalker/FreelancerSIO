<?php

namespace freelancerppe\DAO;

use Doctrine\DBAL\Connection;


abstract class DAO
{
    private $db;

    public function __construct(Connection $_db)
    {
        $this->db = $_db;
    }

    protected function getDb()
    {
        return $this->db;
    }

    protected abstract function buildDomainObject($row);

}