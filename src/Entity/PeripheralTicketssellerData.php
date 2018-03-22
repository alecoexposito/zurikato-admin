<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PeripheralTicketssellerData
 *
 * @ORM\Table(name="peripheral_ticketsseller_data", indexes={@ORM\Index(name="idDevice", columns={"idDevice"})})
 * @ORM\Entity
 */
class PeripheralTicketssellerData
{
    /**
     * @return int
     */
    public function getTotaltickets()
    {
        return $this->totaltickets;
    }

    /**
     * @param int $totaltickets
     * @return PeripheralTicketssellerData
     */
    public function setTotaltickets($totaltickets)
    {
        $this->totaltickets = $totaltickets;
        return $this;
    }

    /**
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param string $price
     * @return PeripheralTicketssellerData
     */
    public function setPrice($price)
    {
        $this->price = $price;
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
     * @return PeripheralTicketssellerData
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
     * @return PeripheralTicketssellerData
     */
    public function setLng($lng)
    {
        $this->lng = $lng;
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
     * @return PeripheralTicketssellerData
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
     * @return PeripheralTicketssellerData
     */
    public function setUuid($uuid)
    {
        $this->uuid = $uuid;
        return $this;
    }

    /**
     * @return int
     */
    public function getIdperipheraldata()
    {
        return $this->idperipheraldata;
    }

    /**
     * @param int $idperipheraldata
     * @return PeripheralTicketssellerData
     */
    public function setIdperipheraldata($idperipheraldata)
    {
        $this->idperipheraldata = $idperipheraldata;
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
     * @return PeripheralTicketssellerData
     */
    public function setIddevice($iddevice)
    {
        $this->iddevice = $iddevice;
        return $this;
    }
    /**
     * @var integer
     *
     * @ORM\Column(name="totalTickets", type="integer", nullable=false)
     */
    private $totaltickets;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $price;

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
     * @ORM\Column(name="vDate", type="string", length=64, nullable=false)
     */
    private $vdate;

    /**
     * @var string
     *
     * @ORM\Column(name="uuid", type="string", length=64, nullable=false)
     */
    private $uuid;

    /**
     * @var integer
     *
     * @ORM\Column(name="idPeripheralData", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idperipheraldata;

    /**
     * @var \App\Entity\Device
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Device")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idDevice", referencedColumnName="idDevice")
     * })
     */
    private $iddevice;


}
