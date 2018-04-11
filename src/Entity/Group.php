<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="dgroup")
 * @ORM\Entity
 */
class Group
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
     * @ORM\ManyToMany(targetEntity="Device")
     * @ORM\JoinTable(name="device_group",
     *      joinColumns={@ORM\JoinColumn(name="group_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="device_id", referencedColumnName="idDevice")}
     * )
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
     * @return Group
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
     * @return Group
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


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Group
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
     * @return Group
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
