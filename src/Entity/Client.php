<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Client extends User
{

    /**
     * @var string
     *
     * @ORM\Column(name="company_name", type="string", length=30, nullable=true)
     */
    protected $companyName;

    /**
     * Client constructor.
     * @param string $companyName
     */
    public function __construct()
    {
        parent::__construct();
        $this->setUsername('algo');
    }

    /**
     * @return string
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * @param string $companyName
     * @return User
     */
    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;
        return $this;
    }

    public function __toString()
    {
        return $this->getName() . " " . $this->getLastName();
    }


}
