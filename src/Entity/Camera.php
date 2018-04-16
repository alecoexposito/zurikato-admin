<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Camera
 *
 * @ORM\Table(name="camera")
 * @ORM\Entity
 */
class Camera
{
    /**
     * @return Device
     */
    public function getDevice()
    {
        return $this->device;
    }

    /**
     * @param Device $device
     * @return Camera
     */
    public function setDevice($device)
    {
        $this->device = $device;
        return $this;
    }

    /**
     * @var \App\Entity\Device
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Device")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="device_id", referencedColumnName="idDevice")
     * })
     */
    private $device;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=30)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=240, nullable=true)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=12, nullable=true)
     */
    private $ip;

    /**
     * @var string
     *
     * @ORM\Column(name="port", type="string", length=11, nullable=true)
     */
    private $port;

    /**
     * @var string
     *
     * @ORM\Column(name="serial", type="string", length=240)
     */
    private $serial;

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
     * @var string
     *
     * @ORM\Column(name="url_camera", type="string", length=300)
     */
    private $urlCamera;

    /**
     * @return string
     */
    public function getUrlCamera()
    {
        return $this->urlCamera;
    }

    /**
     * @param string $urlCamera
     * @return Camera
     */
    public function setUrlCamera($urlCamera)
    {
        $this->urlCamera = $urlCamera;
        return $this;
    }




    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return Camera
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return Camera
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @param string $ip
     * @return Camera
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
        return $this;
    }

    /**
     * @return string
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * @param string $port
     * @return Camera
     */
    public function setPort($port)
    {
        $this->port = $port;
        return $this;
    }

    /**
     * @return string
     */
    public function getSerial()
    {
        return $this->serial;
    }

    /**
     * @param string $serial
     * @return Camera
     */
    public function setSerial($serial)
    {
        $this->serial = $serial;
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
     * @return Camera
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
     * @return Camera
     */
    public function setUpdatedat($updatedat)
    {
        $this->updatedat = $updatedat;
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
     * @return Camera
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }


}
