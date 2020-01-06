<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 */
class AdminUser extends User
{

    /**
     * @var string
     *
     * @ORM\Column(name="company_name", type="string", length=500, nullable=true)
     */
    protected $companyName;

    /**
     * @var string
     * @Assert\Valid()
     * @Assert\Length(max=5, groups={"Default"})
     *
     * @ORM\Column(name="phone_number", type="string", length=30, nullable=true)
     */
    protected $phoneNumber;

    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="App\Entity\Device", mappedBy="admin")
     */
    protected $devices;

    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="App\Entity\Client", mappedBy="admin")
     */
    protected $clients;

    /**
     * AdminUser constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->setEnabled(false);
        $this->devices = new ArrayCollection();
        $this->clients = new ArrayCollection();
    }

    /**
     * @return Collection
     */
    public function getDevices(): Collection {
        return $this->devices;
    }

    /**
     * @param Collection $devices
     * @return AdminUser
     */
    public function setDevices(Collection $devices): AdminUser {
        $this->devices = $devices;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getClients(): Collection {
        return $this->clients;
    }

    /**
     * @param Collection $clients
     * @return AdminUser
     */
    public function setClients(Collection $clients): AdminUser {
        $this->clients = $clients;
        return $this;
    }



}
