<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserDevices
 *
 * @ORM\Table(name="user_devices", indexes={@ORM\Index(name="idUser", columns={"idUser"}), @ORM\Index(name="idDevice", columns={"idDevice"})})
 * @ORM\Entity
 */
class UserDevice
{
    /**
     * UserDevice constructor.
     */
    public function __construct()
    {
        $this->createdat = new \DateTime();
        $this->updatedat = new \DateTime();
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
     * @return UserDevice
     */
    public function setLabel($label)
    {
        $this->label = $label;
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
     * @return UserDevice
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
     * @return UserDevice
     */
    public function setUpdatedat($updatedat)
    {
        $this->updatedat = $updatedat;
        return $this;
    }

    /**
     * @return int
     */
    public function getIduserdevice()
    {
        return $this->iduserdevice;
    }

    /**
     * @param int $iduserdevice
     * @return UserDevice
     */
    public function setIduserdevice($iduserdevice)
    {
        $this->iduserdevice = $iduserdevice;
        return $this;
    }

    /**
     * @return User
     */
    public function getIduser()
    {
        return $this->iduser;
    }

    /**
     * @param User $iduser
     * @return UserDevice
     */
    public function setIduser($iduser)
    {
        $this->iduser = $iduser;
        return $this;
    }

    /**
     * @return Device
     */
    public function getIddevice()
    {
        return $this->iddevice;
    }

    /**
     * @param Device $iddevice
     * @return UserDevice
     */
    public function setIddevice($iddevice)
    {
        $this->iddevice = $iddevice;
        return $this;
    }
    /**
     * @var string
     *
     * @ORM\Column(name="label", type="string", length=64, nullable=true)
     */
    private $label;

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
     * @ORM\Column(name="idUserDevice", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $iduserdevice;

    /**
     * @var \App\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idUser", referencedColumnName="idUser")
     * })
     */
    private $iduser;

    /**
     * @var \App\Entity\Device
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Device")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idDevice", referencedColumnName="idDevice")
     * })
     */
    private $iddevice;


}
