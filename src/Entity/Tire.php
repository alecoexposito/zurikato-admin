<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\Mapping as ORM;

/**
 * Tire
 *
 * @ORM\Table(name="tire")
 * @ORM\Entity
 */
class Tire
{

    const TYPE_NEW = 'Nuevo';
    const TYPE_USED = 'Usado';
    const TYPE_RENEWED = 'Renovado';

    const MEASURE_LETTER_R = 'R';
    const MEASURE_LETTER_B = 'B';
    const MEASURE_LETTER_D = 'D';

    const STATUS_ACTIVE = 'Activo';
    const STATUS_IN_DEPOSIT = 'En deposito';
    const STATUS_TO_RENOVATE = 'Enviado a renovar';
    const STATUS_REMOVED = 'Dado de baja';

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TireObservation", mappedBy="tire", cascade={"persist", "merge", "remove"}, orphanRemoval=true)
     */
    private $observations;

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
     * Tag para el control del neumático, puede estar vacia
     * @var ControlTag
     *
     * @ORM\OneToOne(targetEntity="ControlTag", inversedBy="tire")
     * @ORM\JoinColumn(name="control_tag_id", referencedColumnName="id")
     */
    private $controlTag;

    /**
     * @var string
     *
     * @ORM\Column(name="serial", type="string", nullable=true)
     */
    private $serial;

    /**
     * @var string
     *
     * @ORM\Column(name="internal_code", type="string", nullable=true)
     */
    private $internalCode;

    /**
     * @var string
     *
     * @ORM\Column(name="brand", type="string", nullable=true)
     */
    private $brand;

    /**
     * Cantidad de kilometros que le quedan por recorrer, según el vendedor
     * @var float
     *
     * @ORM\Column(name="warranty", type="float", nullable=true)
     */
    private $warranty;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", nullable=true)
     */
    private $type;

    /**
     * @var float
     *
     * @ORM\Column(name="net_price", type="float", nullable=true)
     */
    private $netPrice;

    /**
     * Medida del neumático
     * @var string
     *
     * @ORM\Column(name="measure", type="string", nullable=true)
     */
    private $measure;

    /**
     * Número de renovado del neumático
     * @var integer
     *
     * @ORM\Column(name="renovated_number", type="integer", nullable=true)
     */
    private $renovatedNumber;

    /**
     * @var Vehicle
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Vehicle")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="vehicle_id", referencedColumnName="id")
     * })
     */
    private $vehicle;

    /**
     * @var integer
     * @ORM\Column(name="position", type="integer", nullable=true)
     */
    private $position;

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
    public function getCreatedat(): \DateTime
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
    public function getUpdatedat(): \DateTime
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
        return $this->getSerial();
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
    public function setVehicle(Vehicle $vehicle): Tire
    {
        $this->vehicle = $vehicle;
        return $this;
    }

    /**
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param int $position
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

}
