<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Entity\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * Employee
 *
 * @ORM\Table(name="employee")
 * @ORM\Entity
 * @Vich\Uploadable
 */
class Employee
{

    /**
     * @var string
     *
     * @ORM\Column(name="employee_number", type="string", nullable=true)
     */
    private $employeeNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="alias", type="string", nullable=true)
     */
    private $alias;
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", nullable=true)
     */
    private $name;
    /**
     * @var string
     *
     * @ORM\Column(name="father_lastname", type="string", nullable=true)
     */
    private $fatherLastName;
    /**
     * @var string
     *
     * @ORM\Column(name="mother_lastname", type="string", nullable=true)
     */
    private $motherLastname;
    /**
     * @var string
     *
     * @ORM\Column(name="sex", type="string", length=1, nullable=true)
     */
    private $sex;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthdate", type="datetime", nullable=true)
     */
    private $birthdate;
    /**
     * @var string
     *
     * @ORM\Column(name="civil_state", type="string", nullable=true)
     */
    private $civilState;
    /**
     * @var string
     *
     * @ORM\Column(name="curp", type="string", nullable=true)
     */
    private $curp;
    /**
     * @var string
     *
     * @ORM\Column(name="social_number", type="string", nullable=true)
     */
    private $socialNumber;
    /**
     * @var string
     *
     * @ORM\Column(name="movile_number", type="string", nullable=true)
     */
    private $movileNumber;
    /**
     * @var string
     *
     * @ORM\Column(name="home_number", type="string", nullable=true)
     */
    private $home_number;
    /**
     * @var string
     *
     * @ORM\Column(name="license_number", type="string", nullable=true)
     */
    private $licenseNumber;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="license_expiration_date", type="datetime", nullable=true)
     */
    private $licenseExpirationDate;

    /**
     * @ORM\Column(name="photo", type="string", length=255, nullable=true)
     * @var string
     */
    private $photo;

    /**
     * @Vich\UploadableField(mapping="employee_photo", fileNameProperty="photo")
     * @var File
     */
    private $photoFile;
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
     * @var Client
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Client")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="client_id", referencedColumnName="idUser")
     * })
     */
    private $client;
    /**
     * @var Vehicle
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Vehicle", inversedBy="employees")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="vehicle_id", referencedColumnName="id", onDelete="SET NULL")
     * })
     */
    private $vehicle;

    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="App\Entity\EmployeeVehicleLog", mappedBy="employee")
     */
    protected $employeeVehicleLogs;

    /**
     * @return Collection
     */
    public function getEmployeeVehicleLogs(): Collection
    {
        return $this->employeeVehicleLogs;
    }



    /**
     * Tire constructor.
     */
    public function __construct()
    {
    }

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
     * @return string
     */
    public function getEmployeeNumber()
    {
        return $this->employeeNumber;
    }

    /**
     * @param string $employeeNumber
     * @return Employee
     */
    public function setEmployeeNumber(string $employeeNumber): Employee
    {
        $this->employeeNumber = $employeeNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * @param string $alias
     * @return Employee
     */
    public function setAlias(string $alias): Employee
    {
        $this->alias = $alias;
        return $this;
    }

    /**
     * @return string
     */
    public function getFatherLastName()
    {
        return $this->fatherLastName;
    }

    /**
     * @param string $fatherLastName
     * @return Employee
     */
    public function setFatherLastName(string $fatherLastName): Employee
    {
        $this->fatherLastName = $fatherLastName;
        return $this;
    }

    /**
     * @return string
     */
    public function getMotherLastname()
    {
        return $this->motherLastname;
    }

    /**
     * @param string $motherLastname
     * @return Employee
     */
    public function setMotherLastname(string $motherLastname): Employee
    {
        $this->motherLastname = $motherLastname;
        return $this;
    }

    /**
     * @return string
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * @param string $sex
     * @return Employee
     */
    public function setSex(string $sex): Employee
    {
        $this->sex = $sex;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    /**
     * @param \DateTime $birthdate
     * @return Employee
     */
    public function setBirthdate($birthdate): Employee
    {
        $this->birthdate = $birthdate;
        return $this;
    }

    /**
     * @return string
     */
    public function getCivilState()
    {
        return $this->civilState;
    }

    /**
     * @param string $civilState
     * @return Employee
     */
    public function setCivilState(string $civilState): Employee
    {
        $this->civilState = $civilState;
        return $this;
    }

    /**
     * @return string
     */
    public function getCurp()
    {
        return $this->curp;
    }

    /**
     * @param string $curp
     * @return Employee
     */
    public function setCurp(string $curp): Employee
    {
        $this->curp = $curp;
        return $this;
    }

    /**
     * @return string
     */
    public function getSocialNumber()
    {
        return $this->socialNumber;
    }

    /**
     * @param string $socialNumber
     * @return Employee
     */
    public function setSocialNumber(string $socialNumber): Employee
    {
        $this->socialNumber = $socialNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getMovileNumber()
    {
        return $this->movileNumber;
    }

    /**
     * @param string $movileNumber
     * @return Employee
     */
    public function setMovileNumber(string $movileNumber): Employee
    {
        $this->movileNumber = $movileNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getHomeNumber()
    {
        return $this->home_number;
    }

    /**
     * @param string $home_number
     * @return Employee
     */
    public function setHomeNumber(string $home_number): Employee
    {
        $this->home_number = $home_number;
        return $this;
    }

    /**
     * @return string
     */
    public function getLicenseNumber()
    {
        return $this->licenseNumber;
    }

    /**
     * @param string $licenseNumber
     * @return Employee
     */
    public function setLicenseNumber(string $licenseNumber): Employee
    {
        $this->licenseNumber = $licenseNumber;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getLicenseExpirationDate()
    {
        return $this->licenseExpirationDate;
    }

    /**
     * @param \DateTime $licenseExpirationDate
     * @return Employee
     */
    public function setLicenseExpirationDate($licenseExpirationDate): Employee
    {
        $this->licenseExpirationDate = $licenseExpirationDate;
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
     * @return Employee
     */
    public function setName(string $name): Employee
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param Client $client
     * @return Employee
     */
    public function setClient($client): Employee
    {
        $this->client = $client;
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
     * @return Employee
     */
    public function setVehicle($vehicle): Employee
    {
        $this->vehicle = $vehicle;
        return $this;
    }

    public function getSexString()
    {
        if($this->sex == 'M')
            return 'Masculino';
        if($this->sex == 'F')
            return 'Femenino';
        if($this->sex == 'O')
            return 'Otro';
    }

    public function __toString()
    {
        return $this->alias;
    }


}
