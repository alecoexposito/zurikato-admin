<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Devices
 *
 * @ORM\Table(name="devices", indexes={@ORM\Index(name="idDeviceModel", columns={"idDeviceModel"})})
 * @ORM\Entity
 */
class Device
{
    /**
     * @var string
     *
     * @ORM\Column(name="auth_device", type="string", length=64, nullable=false)
     */
    private $authDevice;

    /**
     * @var string
     *
     * @ORM\Column(name="auth_password", type="string", length=64, nullable=true)
     */
    private $authPassword;

    /**
     * @var string
     *
     * @ORM\Column(name="label", type="string", length=64, nullable=true)
     */
    private $label;

    /**
     * @var string
     *
     * @ORM\Column(name="sim", type="string", length=32, nullable=true)
     */
    private $sim;

    /**
     * @var integer
     *
     * @ORM\Column(name="autoSync", type="integer", nullable=true)
     */
    private $autosync;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime", nullable=false)
     */
    private $createdat;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updatedAt", type="datetime", nullable=false)
     */
    private $updatedat;

    /**
     * @var string
     *
     * @ORM\Column(name="license_plate", type="string", length=45, nullable=true)
     */
    private $licensePlate;

    /**
     * @var string
     *
     * @ORM\Column(name="contact", type="string", length=45, nullable=true)
     */
    private $contact;

    /**
     * @var string
     *
     * @ORM\Column(name="remark", type="text", nullable=true)
     */
    private $remark;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="activation_date", type="datetime", nullable=true)
     */
    private $activationDate;

    /**
     * @return string
     */
    public function getAuthDevice()
    {
        return $this->authDevice;
    }

    /**
     * @param string $authDevice
     * @return Device
     */
    public function setAuthDevice($authDevice)
    {
        $this->authDevice = $authDevice;
        return $this;
    }

    /**
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->authPassword;
    }

    /**
     * @param string $authPassword
     * @return Device
     */
    public function setAuthPassword($authPassword)
    {
        $this->authPassword = $authPassword;
        return $this;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param string $label
     * @return Device
     */
    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @return string
     */
    public function getSim()
    {
        return $this->sim;
    }

    /**
     * @param string $sim
     * @return Device
     */
    public function setSim($sim)
    {
        $this->sim = $sim;
        return $this;
    }

    /**
     * @return int
     */
    public function getAutosync()
    {
        return $this->autosync;
    }

    /**
     * @param int $autosync
     * @return Device
     */
    public function setAutosync($autosync)
    {
        $this->autosync = $autosync;
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
     * @return Device
     */
    public function setCreatedat($createdat)
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
     * @return Device
     */
    public function setUpdatedat($updatedat)
    {
        $this->updatedat = $updatedat;
        return $this;
    }

    /**
     * @return string
     */
    public function getLicensePlate()
    {
        return $this->licensePlate;
    }

    /**
     * @param string $licensePlate
     * @return Device
     */
    public function setLicensePlate($licensePlate)
    {
        $this->licensePlate = $licensePlate;
        return $this;
    }

    /**
     * @return string
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * @param string $contact
     * @return Device
     */
    public function setContact($contact)
    {
        $this->contact = $contact;
        return $this;
    }

    /**
     * @return string
     */
    public function getRemark()
    {
        return $this->remark;
    }

    /**
     * @param string $remark
     * @return Device
     */
    public function setRemark($remark)
    {
        $this->remark = $remark;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getActivationDate()
    {
        return $this->activationDate;
    }

    /**
     * @param \DateTime $activationDate
     * @return Device
     */
    public function setActivationDate($activationDate)
    {
        $this->activationDate = $activationDate;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getExpirationDate()
    {
        return $this->expirationDate;
    }

    /**
     * @param \DateTime $expirationDate
     * @return Device
     */
    public function setExpirationDate($expirationDate)
    {
        $this->expirationDate = $expirationDate;
        return $this;
    }

    /**
     * @return int
     */
    public function getIddevice()
    {
        return $this->iddevice;
    }

    /**
     * @param int $iddevice
     * @return Device
     */
    public function setIddevice($iddevice)
    {
        $this->iddevice = $iddevice;
        return $this;
    }

    /**
     * @return DeviceModel
     */
    public function getIddevicemodel()
    {
        return $this->iddevicemodel;
    }

    /**
     * @param DeviceModel $iddevicemodel
     * @return Device
     */
    public function setIddevicemodel($iddevicemodel)
    {
        $this->iddevicemodel = $iddevicemodel;
        return $this;
    }

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="expiration_date", type="datetime", nullable=true)
     */
    private $expirationDate;

    /**
     * @var integer
     *
     * @ORM\Column(name="idDevice", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $iddevice;

    /**
     * @var \App\Entity\DeviceModel
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\DeviceModel")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idDeviceModel", referencedColumnName="idDeviceModel")
     * })
     */
    private $iddevicemodel;

    /**
     * @var \App\Entity\Client
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Client")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="idUser")
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
     * @return Device
     */
    public function setClient($client)
    {
        $this->client = $client;
        return $this;
    }

    function __toString()
    {
        return $this->getLabel() . "(" . $this->getAuthDevice() . ")";
    }


}
