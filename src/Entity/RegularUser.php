<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class RegularUser extends User
{

    /**
     * @var \App\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="parentUser", referencedColumnName="idUser")
     * })
     */
    protected $parentUser;

    /**
     * @ORM\ManyToMany(targetEntity="Device")
     * @ORM\JoinTable(name="user_devices",
     *      joinColumns={@ORM\JoinColumn(name="idUser", referencedColumnName="idUser")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="idDevice", referencedColumnName="idDevice")}
     * )
     */
    protected $devices;

    /**
     * @return User
     */
    public function getParentUser()
    {
        return $this->parentUser;
    }

    /**
     * @param User $parentUser
     * @return User
     */
    public function setParentUser($parentUser)
    {
        $this->parentUser = $parentUser;
        $this->setParent($parentUser->getId());
        return $this;
    }

    /**
     * RegularUser constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->setEnabled(false);
        $this->devices = new ArrayCollection();
    }

    /**
     * Add device
     *
     * @param Device $devices
     * @return RegularUser
     */
    public function addDevice($device)
    {
        $this->devices[] = $device;

        return $this;
    }

    /**
     * Remove device
     *
     * @param Device $device
     */
    public function removeDevice($device)
    {
        $this->devices->removeElement($device);
    }

    /**
     * Get devices
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDevices()
    {
        return $this->devices;
    }


}
