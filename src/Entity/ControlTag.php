<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ControlTag
 *
 * @ORM\Table(name="control_tag")
 * @ORM\Entity(repositoryClass="App\Repository\TagsRepository")
 */
class ControlTag
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * Devuelve el Neumático al que está asociado este tag
     * @var Tire
     *
     * @ORM\OneToOne(targetEntity="Tire", mappedBy="controlTag")
     */
    private $tire;

    /**
     * @var string
     *
     * @ORM\Column(name="rfid", type="string", length=40, nullable=true)
     */
    private $rfid;

    /**
     * @var string
     *
     * @ORM\Column(name="internal_code", type="string", length=40, nullable=true)
     */
    private $internalCode;

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
     * ControlTag constructor.
     */
    public function __construct()
    {
        $this->createdat = new \DateTime();
        $this->updatedat = new \DateTime();
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
     * @return ControlTag
     */
    public function setId($id)
    {
        $this->id = $id;
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
     * @return ControlTag
     */
    public function setCreatedat(\DateTime $createdat): ControlTag
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
     * @return ControlTag
     */
    public function setUpdatedat(\DateTime $updatedat): ControlTag
    {
        $this->updatedat = $updatedat;
        return $this;
    }

    /**
     * @return string
     */
    public function getRfid()
    {
        return $this->rfid;
    }

    /**
     * @param string $rfid
     * @return ControlTag
     */
    public function setRfid(string $rfid)
    {
        $this->rfid = $rfid;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTire()
    {
        return $this->tire;
    }

    /**
     * @param mixed $tire
     * @return ControlTag
     */
    public function setTire($tire)
    {
        $this->tire = $tire;
        return $this;
    }

    public function __toString()
    {
        return $this->internalCode . "/" . $this->getRfid();
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
     * @return ControlTag
     */
    public function setInternalCode($internalCode): ControlTag
    {
        $this->internalCode = $internalCode;
        return $this;
    }

    public function getVehicleAndPos()
    {
        if(is_null($this->tire))
            return "-";
        else {
            return $this->tire->getVehicleAndPos();
        }
    }

    /**
     * @var Client
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
     * @return Vehicle
     */
    public function setClient($client)
    {
        $this->client = $client;
        return $this;
    }


}
