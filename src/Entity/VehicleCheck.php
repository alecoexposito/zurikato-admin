<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\Mapping as ORM;

/**
 * VehicleCheck
 *
 * @ORM\Table(name="vehicle_check")
 * @ORM\Entity
 */
class Tire
{

    const STATUS_CURRENT = 'Actual';
    const STATUS_PAUSED = 'Pausado';
    const STATUS_ENDED = 'Terminado';

    /**
     * @var string
     *
     * @ORM\Column(name="dot", type="string", nullable=true)
     */
    private $dot;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", nullable=true)
     */
    private $status;

    /**
     * @var Vehicle
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Vehicle")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="vehicle_id", referencedColumnName="id", onDelete="SET NULL")
     * })
     */
    private $vehicle;

    /**
     * @var string
     * @ORM\Column(name="position", type="string", length=4, nullable=true)
     */
    private $position;

    /**
     * @var boolean
     *
     * @ORM\Column(name="back_renovated", type="boolean", nullable=false, options={"default" = 0})
     */
    private $backRenovated;

    /**
     * @return bool
     */
    public function isBackRenovated()
    {
        return $this->backRenovated;
    }

    /**
     * @param boolean $backRenovated
     * @return Tire
     */
    public function setBackRenovated($backRenovated): Tire
    {
        $this->backRenovated = $backRenovated;
        return $this;
    }




    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime", nullable=true)
     */
    private $createdat;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updatedAt", type="datetime", nullable=true)
     */
    private $updatedat;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * Tire constructor.
     */
    public function __construct()
    {
        $this->observations = new ArrayCollection();
        $this->status = Tire::STATUS_ACTIVE;
        $this->depths = new ArrayCollection();
        $this->setBackRenovated(false);
        $this->tireDepthTemp = new TireDepth();
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
     * @return Tire
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getSerial()
    {
        return $this->serial;
    }

    /**
     * @param string $serial
     * @return Tire
     */
    public function setSerial(string $serial): Tire
    {
        $this->serial = $serial;
        return $this;
    }

    /**
     * @return string
     */
    public function getInternalCode()
    {
        return $this->internalCode;
    }

    /**
     * @param string $internalCode
     * @return Tire
     */
    public function setInternalCode(string $internalCode): Tire
    {
        $this->internalCode = $internalCode;
        return $this;
    }

    /**
     * @return float
     */
    public function getNetPrice()
    {
        return $this->netPrice;
    }

    /**
     * @param float $netPrice
     * @return Tire
     */
    public function setNetPrice(float $netPrice): Tire
    {
        $this->netPrice = $netPrice;
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
     * @return Tire
     */
    public function setCreatedat(\DateTime $createdat): Tire
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
     * @return Tire
     */
    public function setUpdatedat(\DateTime $updatedat): Tire
    {
        $this->updatedat = $updatedat;
        return $this;
    }

    /**
     * @return float
     */
    public function getWarranty()
    {
        return $this->warranty;
    }

    /**
     * @param float $warranty
     * @return Tire
     */
    public function setWarranty(float $warranty): Tire
    {
        $this->warranty = $warranty;
        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return Tire
     */
    public function setType(string $type): Tire
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param string $brand
     * @return Tire
     */
    public function setBrand(string $brand): Tire
    {
        $this->brand = $brand;
        return $this;
    }

    /**
     * @return string
     */
    public function getMeasure()
    {
        return $this->measure;
    }

    /**
     * @param string $measure
     * @return Tire
     */
    public function setMeasure(string $measure): Tire
    {
        $this->measure = $measure;
        return $this;
    }

    /**
     * @return integer
     */
    public function getRenovatedNumber()
    {
        return $this->renovatedNumber;
    }

    /**
     * @param integer $renovatedNumber
     * @return Tire
     */
    public function setRenovatedNumber($renovatedNumber): Tire
    {
        $this->renovatedNumber = $renovatedNumber;
        return $this;
    }

    /**
     * @return ControlTag
     */
    public function getControlTag()
    {
        return $this->controlTag;
    }

    /**
     * @param ControlTag $controlTag
     * @return Tire
     */
    public function setControlTag($controlTag)
    {
        $this->controlTag = $controlTag;
        return $this;
    }

    public function __toString()
    {
        if(is_null($this->internalCode))
            return "-";
        return $this->internalCode;
    }

    /**
     * @return Vehicle
     */
    public function getVehicle()
    {
        return $this->vehicle;
    }

    /**
     * @param Vehicle $vehicle
     * @return Tire
     */
    public function setVehicle($vehicle): Tire
    {
        $this->vehicle = $vehicle;
        return $this;
    }

    /**
     * @return string
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param string $position
     * @return Tire
     */
    public function setPosition($position)
    {
        $this->position = $position;
        return $this;
    }

    /**
     * @return string
     */
    public function getDot()
    {
        return $this->dot;
    }

    /**
     * @param string $dot
     * @return Tire
     */
    public function setDot($dot)
    {
        $this->dot = $dot;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getObservations()
    {
        return $this->observations;
    }

    /**
     * Add observation
     *
     * @param TireObservation $observation
     * @return Tire
     */
    public function addObservation(TireObservation $observation)
    {
        $this->observations[] = $observation;

        return $this;
    }

    /**
     * Remove observation
     *
     * @param TireObservation $observation
     */
    public function removeObservation(TireObservation $observation)
    {
        $this->observations->removeElement($observation);
    }

    public function setObservation($observation)
    {
        if(!is_null($observation)) {
            $obs = new TireObservation();
            $obs->setTire($this);
            $obs->setObservation($observation);
            $this->addObservation($obs);
        }
        return $this;
    }

    public function getObservation()
    {
        return "";
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return Tire
     */
    public function setStatus(string $status): Tire
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @var \App\Entity\Client
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Client")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="client_id", referencedColumnName="idUser")
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
     * @return Tire
     */
    public function setClient($client): Tire
    {
        $this->client = $client;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getDepths()
    {
        return $this->depths;
    }

    /**
     * Add depth
     *
     * @param TireDepth $depth
     * @return Tire
     */
    public function addDepth(TireDepth $depth)
    {
        $this->depths[] = $depth;

        return $this;
    }

    /**
     * Remove depth
     *
     * @param TireDepth $depth
     */
    public function removeDepth(TireDepth $depth)
    {
        $this->depths->removeElement($depth);
    }

    public function setInitialDepth(TireDepth $depth)
    {
        $depth->setTire($this);
        if($this->depths->count() > 0) {
            $this->depths[0] = $depth;
        } else {
            $this->addDepth($depth);
        }
        return $this;
    }

    public function getInitialDepth()
    {
        if($this->depths->count() > 0) {
            return $this->depths[0];
        }
        return new TireDepth();
    }

    public function getInitialObservation()
    {
        if($this->observations->count() > 0) {
            return $this->observations[0];
        }
        return "";
    }

    public function setInitialObservation($observation)
    {
        if($this->observations->count() > 0) {
            $this->observations[0]->setObservation($observation);
        } else {
            $this->setObservation($observation);
        }
        return $this;
    }

    public function getVehicleAndPos()
    {
        if(is_null($this->vehicle))
            return "-";
        else {
            return $this->vehicle . "(" . $this->getPosition() . ")";
        }
    }

//    public function setDepth($depth)
//    {
//        if(!is_null($depth)) {
//            $this->addDepth($depth);
//        }
//        return $this;
//    }
//
//    public function getDepth()
//    {
//        return "";
//    }
}
