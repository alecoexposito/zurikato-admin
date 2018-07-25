<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Client extends User
{

    /**
     * @var string
     *
     * @ORM\Column(name="company_name", type="string", length=500, nullable=true)
     */
    protected $companyName;

    /**
     * @var string
     *
     * @ORM\Column(name="phone_number", type="string", length=30, nullable=true)
     */
    protected $phoneNumber;

    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="App\Entity\Tire", mappedBy="client")
     */
    protected $tires;

    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="App\Entity\Vehicle", mappedBy="client")
     */
    protected $vehicles;

    /**
     * Client constructor.
     * @param string $companyName
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * @param string $phoneNumber
     */
    public function setPhoneNumber(string $phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
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

    /**
     * @return Collection
     */
    public function getTires()
    {
        return $this->tires;
    }

    /**
     * @param Collection $tires
     * @return Client
     */
    public function setTires($tires)
    {
        $this->tires = $tires;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getVehicles()
    {
        return $this->vehicles;
    }

    /**
     * @param Collection $vehicles
     * @return Client
     */
    public function setVehicles($vehicles)
    {
        $this->vehicles = $vehicles;
        return $this;
    }


}
