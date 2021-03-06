<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Entity\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * Vehicle
 *
 * @ORM\Table(name="vehicle")
 * @ORM\Entity(repositoryClass="App\Repository\VehicleRepository")
 * @Vich\Uploadable
 */
class Vehicle
{

    /**
     * @var Device
     *
     * @ORM\OneToOne(targetEntity="Device", inversedBy="vehicle")
     * @ORM\JoinColumn(name="device_id", referencedColumnName="idDevice")
     */
    private $device;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="plate_number", type="string", nullable=true)
     */
    private $plateNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="brand", type="string", nullable=true)
     */
    private $brand;

    /**
     * @var string
     *
     * @ORM\Column(name="model", type="string", nullable=true)
     */
    private $model;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", nullable=true)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="year", type="string", nullable=true)
     */
    private $year;

    /**
     * @var string
     *
     * @ORM\Column(name="route", type="string", nullable=true)
     */
    private $route;

    /**
     * @var string
     *
     * @ORM\Column(name="odometer", type="string", nullable=true)
     */
    private $odometer;

    /**
     * @var string
     *
     * @ORM\Column(name="vin", type="string", nullable=true)
     */
    private $vin;


    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="App\Entity\Tire", mappedBy="vehicle", cascade="all")
     */
    protected $tires;

    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="App\Entity\Employee", mappedBy="vehicle", cascade="all")
     */
    protected $employees;

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
     * Vehicle constructor.
     */
    public function __construct()
    {
        $this->tires = new ArrayCollection();
        $this->employees = new ArrayCollection();
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
     * @return Vehicle
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return Device
     */
    public function getDevice()
    {
        return $this->device;
    }

    /**
     * @param Device $device
     * @return Vehicle
     */
    public function setDevice($device)
    {
        $this->device = $device;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Vehicle
     */
    public function setName(string $name): Vehicle
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getPlateNumber()
    {
        return $this->plateNumber;
    }

    /**
     * @param string $plateNumber
     * @return Vehicle
     */
    public function setPlateNumber(string $plateNumber): Vehicle
    {
        $this->plateNumber = $plateNumber;
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
     * @return Vehicle
     */
    public function setBrand(string $brand): Vehicle
    {
        $this->brand = $brand;
        return $this;
    }

    /**
     * @return string
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param string $model
     * @return Vehicle
     */
    public function setModel(string $model): Vehicle
    {
        $this->model = $model;
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
     * @return Vehicle
     */
    public function setType(string $type): Vehicle
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param string $year
     * @return Vehicle
     */
    public function setYear(string $year): Vehicle
    {
        $this->year = $year;
        return $this;
    }

    /**
     * @return string
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * @param string $route
     * @return Vehicle
     */
    public function setRoute(string $route): Vehicle
    {
        $this->route = $route;
        return $this;
    }

    /**
     * @return string
     */
    public function getOdometer()
    {
        return $this->odometer;
    }

    /**
     * @param string $odometer
     * @return Vehicle
     */
    public function setOdometer(string $odometer): Vehicle
    {
        $this->odometer = $odometer;
        return $this;
    }

    /**
     * @return string
     */
    public function getVin()
    {
        return $this->vin;
    }

    /**
     * @param string $vin
     * @return Vehicle
     */
    public function setVin(string $vin): Vehicle
    {
        $this->vin = $vin;
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
     * @return Vehicle
     */
    public function setCreatedat(\DateTime $createdat): Vehicle
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
     * @return Vehicle
     */
    public function setUpdatedat(\DateTime $updatedat)
    {
        $this->updatedat = $updatedat;
        return $this;
    }

    public function __toString()
    {
        return is_null($this->getName()) ? $this->getPlateNumber() : $this->getName();
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

    /**
     * @return ArrayCollection
     */
    public function getTires()
    {
        return $this->tires;
    }

    /**
     * Add tire
     *
     * @param Tire $tire
     * @return Tire
     */
    public function addTire(Tire $tire)
    {
        $this->tires[] = $tire;

        return $this;
    }

    /**
     * Remove tire
     *
     * @param Tire $tire
     */
    public function removeTire(Tire $tire)
    {
        $this->tires->removeElement($tire);
    }

    /**
     * @return ArrayCollection
     */
    public function getEmployees()
    {
        return $this->employees;
    }

    /**
     * Add employee
     *
     * @param Employee $employee
     * @return Employee
     */
    public function addEmployee(Employee $employee)
    {
        $this->employees[] = $employee;

        return $this;
    }

    /**
     * Remove employee
     *
     * @param Employee $employee
     */
    public function removeEmployee(Employee $employee)
    {
        dump($employee);
        $this->employees->removeElement($employee);
        $employee->setVehicle(null);
    }

    /**
     * @ORM\Column(name="photo", type="string", length=255, nullable=true)
     * @var string
     */
    private $photo;

    /**
     * @Vich\UploadableField(mapping="vehicle_photo", fileNameProperty="photo")
     * @var File
     */
    private $photoFile;

    /**
     * @return mixed
     */
    public function getPhoto()
    {
        if (!is_null($this->photo))
            return $this->photo;
        else
            return null;
    }

    /**
     * @param mixed $photo
     * @return Device
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
        return $this;
    }

    /**
     * @return File
     */
    public function getPhotoFile()
    {
        return $this->photoFile;
    }

    /**
     * @param File $photoFile
     * @return Device
     */
    public function setPhotoFile($photo)
    {
        $this->photoFile = $photo;
        if ($photo) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedat = new \DateTime('now');
        }
        return $this;
    }

    public function getPositions()
    {
        /**
         * @var Tire $tire
         */
        $positions = array();
        foreach ($this->tires as $index => $tire) {
            $positions[] = $tire->getPosition();
        }
        return $positions;
    }

    public function getTagsIds()
    {
        $result = array();
        foreach ($this->getTires() as $index => $tire) {
            if(is_object($tire->getControlTag()))
                $result[] = $tire->getControlTag()->getId();
        }
        return $result;
    }

    public function getTagsRfids()
    {
        $result = array();
        foreach ($this->getTires() as $index => $tire) {
            if(is_object($tire->getControlTag()))
                $result[] = $tire->getControlTag()->getRfid();
        }
        return $result;
    }

}
