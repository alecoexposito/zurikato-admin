<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\Mapping as ORM;

/**
 * EmployeeVehicleLog
 *
 * @ORM\Table(name="employee_vehicle_log")
 * @ORM\Entity()
 */
class EmployeeVehicleLog
{

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
     * @var Employee
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Employee")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="employee_id", referencedColumnName="id", onDelete="SET NULL")
     * })
     */
    private $employee;

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
     * EmployeeVehicleLog constructor.
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
     * @return EmployeeVehicleLog
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
     * @return EmployeeVehicleLog
     */
    public function setCreatedat(\DateTime $createdat): EmployeeVehicleLog
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
     * @return EmployeeVehicleLog
     */
    public function setUpdatedat(\DateTime $updatedat): EmployeeVehicleLog
    {
        $this->updatedat = $updatedat;
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
     * @return EmployeeVehicleLog
     */
    public function setVehicle($vehicle): EmployeeVehicleLog
    {
        $this->vehicle = $vehicle;
        return $this;
    }

    /**
     * @return Employee
     */
    public function getEmployee()
    {
        return $this->employee;
    }

    /**
     * @param Employee $employee
     * @return EmployeeVehicleLog
     */
    public function setEmployee(Employee $employee): EmployeeVehicleLog
    {
        $this->employee = $employee;
        return $this;
    }

}
