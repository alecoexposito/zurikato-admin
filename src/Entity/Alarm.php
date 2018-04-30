<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Alarm
 *
 * @ORM\Table(name="alarm")
 * @ORM\Entity
 */
class Alarm
{
    /**
     * @return int
     */
    public function getDevice()
    {
        return $this->device;
    }

    /**
     * @param int $device
     * @return Alarm
     */
    public function setDevice($device)
    {
        $this->device = $device;
        return $this;
    }

    /**
     * @return float
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * @param float $lat
     * @return Alarm
     */
    public function setLat($lat)
    {
        $this->lat = $lat;
        return $this;
    }

    /**
     * @return float
     */
    public function getLng()
    {
        return $this->lng;
    }

    /**
     * @param float $lng
     * @return Alarm
     */
    public function setLng($lng)
    {
        $this->lng = $lng;
        return $this;
    }

    /**
     * @return float
     */
    public function getSpeed()
    {
        return $this->speed;
    }

    /**
     * @param float $speed
     * @return Alarm
     */
    public function setSpeed($speed)
    {
        $this->speed = $speed;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedat()
    {
        return $this->createdat;
    }

    /**
     * @param \DateTime $createdat
     * @return Alarm
     */
    public function setCreatedat($createdat)
    {
        $this->createdat = $createdat;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedat()
    {
        return $this->updatedat;
    }

    /**
     * @param \DateTime $updatedat
     * @return Alarm
     */
    public function setUpdatedat($updatedat)
    {
        $this->updatedat = $updatedat;
        return $this;
    }

    /**
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param int $code
     * @return Alarm
     */
    public function setCode($code)
    {
        $this->code = $code;
        return $this;
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
     * @return Alarm
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Device")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="device", referencedColumnName="idDevice")
     * })
     *
     */
    private $device;

    /**
     * @var float
     *
     * @ORM\Column(name="lat", type="float", precision=10, scale=6, nullable=true)
     */
    private $lat;

    /**
     * @var float
     *
     * @ORM\Column(name="lng", type="float", precision=10, scale=6, nullable=true)
     */
    private $lng;

    /**
     * @var float
     *
     * @ORM\Column(name="speed", type="float", precision=10, scale=2, nullable=true)
     */
    private $speed;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime", nullable=false)
     */
    private $createdat;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updatedAt", type="datetime", nullable=false)
     */
    private $updatedat;

    /**
     * @var integer
     *
     * @ORM\Column(name="code", type="bigint", nullable=true)
     */
    private $code;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;


}
