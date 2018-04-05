<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="devices_group")
 * @ORM\Entity
 */
class DevicesGroup
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="label", type="string", length=30, nullable=false)
     */
    protected $label;

    /**
     *
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="App\Entity\Device", mappedBy="devicesGroup", cascade="all")
     *
     */
    protected $devices;

    /**
     * @var \App\Entity\Client
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Client")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="idUser")
     * })
     */
    private $client;

    /**
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param Client $client
     * @return DevicesGroup
     */
    public function setClient($client)
    {
        $this->client = $client;
        return $this;
    }

    public function __construct()
    {
        $this->devices = new ArrayCollection();
    }

    /**
     * Add device
     *
     * @param Device $device
     * @return DevicesGroup
     */
    public function addDevice($device)
    {
        $this->devices[] = $device;
        $device->setDevicesGroup($this);
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
        $device->setDevicesGroup(null);
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


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return DevicesGroup
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param string $label
     * @return DevicesGroup
     */
    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }

    public function __toString()
    {
        return $this->label;
    }


}
