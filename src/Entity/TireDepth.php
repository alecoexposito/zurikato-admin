<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\Mapping as ORM;


/**
 * TireDepth
 *
 * @ORM\Table(name="tire_depth")
 * @ORM\Entity
 */
class TireDepth
{

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
     * @var Tire
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Tire")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tire_id", referencedColumnName="id")
     * })
     */
    private $tire;

    /**
     * TireDepth constructor.
     */
    public function __construct()
    {
        $this->createdat = new \DateTime();
        $this->updatedat = new \DateTime();
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
     * @return TireDepth
     */
    public function setCreatedat($createdat): TireDepth
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
     * @return TireDepth
     */
    public function setUpdatedat($updatedat): TireDepth
    {
        $this->updatedat = $updatedat;
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
     * @return TireDepth
     */
    public function setId($id): TireDepth
    {
        $this->id = $id;
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
     * @return TireDepth
     */
    public function setTire($tire): TireDepth
    {
        $this->tire = $tire;
        return $this;
    }

    /**
     * @var float
     *
     * @ORM\Column(name="depth_a", type="float")
     */
    private $depthA;

    /**
     * @var float
     *
     * @ORM\Column(name="depth_b", type="float")
     */
    private $depthB;

    /**
     * @var float
     *
     * @ORM\Column(name="depth_c", type="float")
     */
    private $depthC;

    /**
     * @var string
     *
     * @ORM\Column(name="observation", type="string", nullable=true)
     */
    private $observation;

    /**
     * @return string
     */
    public function getObservation()
    {
        return $this->observation;
    }

    /**
     * @param string $observation
     * @return TireDepth
     */
    public function setObservation($observation): TireDepth
    {
        $this->observation = $observation;
        return $this;
    }



    /**
     * @return float
     */
    public function getDepthA()
    {
        return $this->depthA;
    }

    /**
     * @param float $depthA
     * @return TireDepth
     */
    public function setDepthA($depthA): TireDepth
    {
        $this->depthA = $depthA;
        return $this;
    }

    /**
     * @return float
     */
    public function getDepthB()
    {
        return $this->depthB;
    }

    /**
     * @param float $depthB
     * @return TireDepth
     */
    public function setDepthB($depthB): TireDepth
    {
        $this->depthB = $depthB;
        return $this;
    }

    /**
     * @return float
     */
    public function getDepthC()
    {
        return $this->depthC;
    }

    /**
     * @param float $depthC
     * @return TireDepth
     */
    public function setDepthC($depthC): TireDepth
    {
        $this->depthC = $depthC;
        return $this;
    }


}
