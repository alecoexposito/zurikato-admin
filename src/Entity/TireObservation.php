<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\Mapping as ORM;

/**
 * TireObservation
 *
 * @ORM\Table(name="tire_observation")
 * @ORM\Entity
 */
class TireObservation
{

    /**
     * @var string
     *
     * @ORM\Column(name="observation", type="string", nullable=true)
     */
    private $observation;

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
     *
     * @var Tire
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Tire", inversedBy="observations")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tire_id", referencedColumnName="id")
     * })
     *
     */
    private $tire;

    /**
     * TireObservation constructor.
     * @param \DateTime $createdat
     * @param \DateTime $updatedat
     */
    public function __construct()
    {
        $this->createdat = new \DateTime();
        $this->updatedat = new \DateTime();
    }

    /**
     * @return string
     */
    public function getObservation()
    {
        return $this->observation;
    }

    /**
     * @param string $observation
     * @return TireObservation
     */
    public function setObservation(string $observation): TireObservation
    {
        $this->observation = $observation;
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
     * @return TireObservation
     */
    public function setCreatedat(\DateTime $createdat): TireObservation
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
     * @return TireObservation
     */
    public function setUpdatedat(\DateTime $updatedat): TireObservation
    {
        $this->updatedat = $updatedat;
        return $this;
    }

    /**
     * @return Tire
     */
    public function getTire()
    {
        return $this->tire;
    }

    /**
     * @param Tire $tire
     * @return TireObservation
     */
    public function setTire($tire): TireObservation
    {
        $this->tire = $tire;
        return $this;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return TireObservation
     */
    public function setId(int $id): TireObservation
    {
        $this->id = $id;
        return $this;
    }

    public function __toString()
    {
        return $this->observation;
    }


}
