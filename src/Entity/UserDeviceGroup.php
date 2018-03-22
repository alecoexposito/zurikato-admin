<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserDevicesGroups
 *
 * @ORM\Table(name="user_devices_groups", indexes={@ORM\Index(name="idUser", columns={"idUser"}), @ORM\Index(name="idDevice", columns={"idDevice"})})
 * @ORM\Entity
 */
class UserDeviceGroup
{
    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param string $label
     * @return UserDeviceGroup
     */
    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @return int
     */
    public function getIduserdevicegroup()
    {
        return $this->iduserdevicegroup;
    }

    /**
     * @param int $iduserdevicegroup
     * @return UserDeviceGroup
     */
    public function setIduserdevicegroup($iduserdevicegroup)
    {
        $this->iduserdevicegroup = $iduserdevicegroup;
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
     * @return UserDeviceGroup
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
     * @return UserDeviceGroup
     */
    public function setIddevice($iddevice)
    {
        $this->iddevice = $iddevice;
        return $this;
    }
    /**
     * @var string
     *
     * @ORM\Column(name="label", type="string", length=64, nullable=false)
     */
    private $label;

    /**
     * @var integer
     *
     * @ORM\Column(name="idUserDeviceGroup", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $iduserdevicegroup;

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
