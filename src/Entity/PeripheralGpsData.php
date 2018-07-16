<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PeripheralGpsData
 *
 * @ORM\Table(name="peripheral_gps_data", indexes={@ORM\Index(name="idDevice", columns={"idDevice"})})
 * @ORM\Entity
 */
class PeripheralGpsData
{
    /**
     * @var string
     *
     * @ORM\Column(name="lat", type="string", length=64, nullable=false)
     */
    private $lat;

    /**
     * @var string
     *
     * @ORM\Column(name="lng", type="string", length=64, nullable=false)
     */
    private $lng;

    /**
     * @var string
     *
     * @ORM\Column(name="speed", type="string", length=64, nullable=false)
     */
    private $speed;

    /**
     * @var string
     *
     * @ORM\Column(name="orientation_plain", type="string", length=100, nullable=false)
     */
    private $orientationPlain;

    /**
     * @var string
     *
     * @ORM\Column(name="vDate", type="string", length=64, nullable=true)
     */
    private $vdate;

    /**
     * @var string
     *
     * @ORM\Column(name="uuid", type="string", length=64, nullable=true)
     */
    private $uuid;

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
     * @ORM\Column(name="idPeripheralGps", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idperipheralgps;

    /**
     * @var integer
     *
     * @ORM\Column(name="gps_status", type="integer", nullable=true)
     */
    private $gpsStatus;

    /**
     * @return int
     */
    public function getGpsStatus(): int
    {
        return $this->gpsStatus;
    }

    /**
     * @param int $gpsStatus
     * @return PeripheralGpsData
     */
    public function setGpsStatus(int $gpsStatus): PeripheralGpsData
    {
        $this->gpsStatus = $gpsStatus;
        return $this;
    }

    /**
     * @return string
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * @param string $lat
     * @return PeripheralGpsData
     */
    public function setLat($lat)
    {
        $this->lat = $lat;
        return $this;
    }

    /**
     * @return string
     */
    public function getLng()
    {
        return $this->lng;
    }

    /**
     * @param string $lng
     * @return PeripheralGpsData
     */
    public function setLng($lng)
    {
        $this->lng = $lng;
        return $this;
    }

    /**
     * @return string
     */
    public function getSpeed()
    {
        return $this->speed;
    }

    /**
     * @param string $speed
     * @return PeripheralGpsData
     */
    public function setSpeed($speed)
    {
        $this->speed = $speed;
        return $this;
    }

    /**
     * @return string
     */
    public function getVdate()
    {
        return $this->vdate;
    }

    /**
     * @param string $vdate
     * @return PeripheralGpsData
     */
    public function setVdate($vdate)
    {
        $this->vdate = $vdate;
        return $this;
    }

    /**
     * @return string
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * @param string $uuid
     * @return PeripheralGpsData
     */
    public function setUuid($uuid)
    {
        $this->uuid = $uuid;
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
     * @return PeripheralGpsData
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
     * @return PeripheralGpsData
     */
    public function setUpdatedat($updatedat)
    {
        $this->updatedat = $updatedat;
        return $this;
    }

    /**
     * @return int
     */
    public function getIdperipheralgps()
    {
        return $this->idperipheralgps;
    }

    /**
     * @param int $idperipheralgps
     * @return PeripheralGpsData
     */
    public function setIdperipheralgps($idperipheralgps)
    {
        $this->idperipheralgps = $idperipheralgps;
        return $this;
    }

    /**
     * @return Device
     */
    public function getIddevice()
    {
        return $this->iddevice;
    }

    /**
     * @param Device $iddevice
     * @return PeripheralGpsData
     */
    public function setIddevice($iddevice)
    {
        $this->iddevice = $iddevice;
        return $this;
    }

    /**
     * @var \App\Entity\Device
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Device")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idDevice", referencedColumnName="idDevice")
     * })
     */
    private $iddevice;

    /**
     * @return string
     */
    public function getOrientationPlain()
    {
        return $this->orientationPlain;
    }

    /**
     * @param string $orientationPlain
     * @return PeripheralGpsData
     */
    public function setOrientationPlain($orientationPlain)
    {
        $this->orientationPlain = $orientationPlain;
        return $this;
    }


}
