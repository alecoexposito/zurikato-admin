<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\Mapping as ORM;

/**
 * DescriptionCost
 *
 * @ORM\Table(name="description_cost")
 * @ORM\Entity
 */
class DescriptionCost
{

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", nullable=true)
     */
    private $description;

    /**
     * @var float
     *
     * @ORM\Column(name="cost", type="float", nullable=true)
     */
    private $cost;

    /**
     * @var Maintenance
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Maintenance")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="maintenance_id", referencedColumnName="id")
     * })
     */
    private $maintenance;

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
     * DescriptionCost constructor.
     */
    public function __construct()
    {
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
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return DescriptionCost
     */
    public function setDescription($description): DescriptionCost
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return float
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * @param float $cost
     * @return DescriptionCost
     */
    public function setCost(float $cost): DescriptionCost
    {
        $this->cost = $cost;
        return $this;
    }

    /**
     * @return DescriptionCost
     */
    public function getMaintenance()
    {
        return $this->maintenance;
    }

    /**
     * @param Maintenance $maintenance
     * @return DescriptionCost
     */
    public function setMaintenance($maintenance): DescriptionCost
    {
        $this->maintenance = $maintenance;
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
     * @return DescriptionCost
     */
    public function setCreatedat(\DateTime $createdat): DescriptionCost
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
     * @return DescriptionCost
     */
    public function setUpdatedat(\DateTime $updatedat): DescriptionCost
    {
        $this->updatedat = $updatedat;
        return $this;
    }

}
