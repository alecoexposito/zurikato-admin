<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Admin extends User
{

    /**
     * Admin constructor.
     * @param string $companyName
     */
    public function __construct()
    {
        parent::__construct();
    }
}
