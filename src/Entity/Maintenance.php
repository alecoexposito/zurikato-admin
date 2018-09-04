<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\Mapping as ORM;

/**
 * Maintenance
 *
 * @ORM\Table(name="maintenance")
 * @ORM\Entity
 */
class Maintenance
{

    const TYPE_PREVENTIVE = 'Preventivo';
    const TYPE_CORRECTIVE = 'Correctivo';
    const TYPE_CONSERVATION = 'Conservación';
    const TYPE_ACCIDENT = 'Accidente';

    const PRIORITY_LOW = 'Baja';
    const PRIORITY_MEDIUM = 'Media';
    const PRIORITY_HIGH = 'Alta';

    const STATUS_PENDING = 'Pendiente';
    const STATUS_CLOSED = 'Cerrado';

    /**
     * @var string
     *
     * @ORM\Column(name="maintenance_type", type="string", length=20, nullable=true)
     */
    private $maintenanceType;

    /**
     * @var string
     *
     * @ORM\Column(name="priority", type="string", length=20, nullable=true)
     */
    private $priority;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=20, nullable=true)
     */
    private $status;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\DescriptionCost", mappedBy="maintenance", cascade={"persist", "merge", "remove"}, orphanRemoval=true)
     */
    private $descriptionCosts;

    /**
     * @var string
     *
     * @ORM\Column(name="service_name", type="string", nullable=true)
     */
    private $serviceName;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", nullable=true)
     */
    private $description;

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
     * @var \DateTime
     *
     * @ORM\Column(name="scheduled_for", type="datetime", nullable=true)
     */
    private $scheduledFor;

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
        $this->scheduledFor = new \DateTime();
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
     * @return Maintenance
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
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
     * @return Maintenance
     */
    public function setVehicle($vehicle): Maintenance
    {
        $this->vehicle = $vehicle;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getDescriptionCosts()
    {
        return $this->descriptionCosts;
    }

    /**
     * Add descriptionCost
     *
     * @param DescriptionCost $descriptionCost
     * @return DescriptionCost
     */
    public function addDescriptionCost($descriptionCost)
    {
        $this->descriptionCosts[] = $descriptionCost;

        return $this;
    }

    /**
     * Remove descriptionCost
     *
     * @param DescriptionCost $descriptionCost
     */
    public function removeDescriptionCost($descriptionCost)
    {
        $this->descriptionCosts->removeElement($descriptionCost);
    }

    /**
     * @return string
     */
    public function getMaintenanceType()
    {
        return $this->maintenanceType;
    }

    /**
     * @param string $maintenanceType
     * @return Maintenance
     */
    public function setMaintenanceType($maintenanceType): Maintenance
    {
        $this->maintenanceType = $maintenanceType;
        return $this;
    }

    /**
     * @return string
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * @param string $priority
     * @return Maintenance
     */
    public function setPriority($priority): Maintenance
    {
        $this->priority = $priority;
        return $this;
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
     * @return Maintenance
     */
    public function setStatus($status): Maintenance
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return string
     */
    public function getServiceName()
    {
        return $this->serviceName;
    }

    /**
     * @param string $serviceName
     * @return Maintenance
     */
    public function setServiceName($serviceName): Maintenance
    {
        $this->serviceName = $serviceName;
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
     * @return Maintenance
     */
    public function setDescription($description): Maintenance
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getScheduledFor()
    {
        return $this->scheduledFor;
    }

    /**
     * @param \DateTime $scheduledFor
     * @return Maintenance
     */
    public function setScheduledFor($scheduledFor): Maintenance
    {
        $this->scheduledFor = $scheduledFor;
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
     * @return Maintenance
     */
    public function setCreatedat($createdat): Maintenance
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
     * @return Maintenance
     */
    public function setUpdatedat($updatedat): Maintenance
    {
        $this->updatedat = $updatedat;
        return $this;
    }

}
