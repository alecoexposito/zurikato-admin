<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DeviceModel
 *
 * @ORM\Table(name="device_models", indexes={@ORM\Index(name="idDeviceModel", columns={"idDeviceModel"})})
 * @ORM\Entity
 */
class DeviceModel
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
     * @return DeviceModel
     */
    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @return bool
     */
    public function isPeripheralGps()
    {
        return $this->peripheralGps;
    }

    /**
     * @param bool $peripheralGps
     * @return DeviceModel
     */
    public function setPeripheralGps($peripheralGps)
    {
        $this->peripheralGps = $peripheralGps;
        return $this;
    }

    /**
     * @return bool
     */
    public function isPeripheralTicketsseller()
    {
        return $this->peripheralTicketsseller;
    }

    /**
     * @param bool $peripheralTicketsseller
     * @return DeviceModel
     */
    public function setPeripheralTicketsseller($peripheralTicketsseller)
    {
        $this->peripheralTicketsseller = $peripheralTicketsseller;
        return $this;
    }

    /**
     * @return bool
     */
    public function isPeripheralCam1()
    {
        return $this->peripheralCam1;
    }

    /**
     * @param bool $peripheralCam1
     * @return DeviceModel
     */
    public function setPeripheralCam1($peripheralCam1)
    {
        $this->peripheralCam1 = $peripheralCam1;
        return $this;
    }

    /**
     * @return bool
     */
    public function isPeripheralCam2()
    {
        return $this->peripheralCam2;
    }

    /**
     * @param bool $peripheralCam2
     * @return DeviceModel
     */
    public function setPeripheralCam2($peripheralCam2)
    {
        $this->peripheralCam2 = $peripheralCam2;
        return $this;
    }

    /**
     * @return bool
     */
    public function isPeripheralCam3()
    {
        return $this->peripheralCam3;
    }

    /**
     * @param bool $peripheralCam3
     * @return DeviceModel
     */
    public function setPeripheralCam3($peripheralCam3)
    {
        $this->peripheralCam3 = $peripheralCam3;
        return $this;
    }

    /**
     * @return bool
     */
    public function isPeripheralCam4()
    {
        return $this->peripheralCam4;
    }

    /**
     * @param bool $peripheralCam4
     * @return DeviceModel
     */
    public function setPeripheralCam4($peripheralCam4)
    {
        $this->peripheralCam4 = $peripheralCam4;
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
     * @return DeviceModel
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
     * @return DeviceModel
     */
    public function setUpdatedat($updatedat)
    {
        $this->updatedat = $updatedat;
        return $this;
    }

    /**
     * @return int
     */
    public function getIddevicemodel()
    {
        return $this->iddevicemodel;
    }

    /**
     * @param int $iddevicemodel
     * @return DeviceModel
     */
    public function setIddevicemodel($iddevicemodel)
    {
        $this->iddevicemodel = $iddevicemodel;
        return $this;
    }
    /**
     * @var string
     *
     * @ORM\Column(name="label", type="string", length=64, nullable=false)
     */
    private $label;

    /**
     * @var boolean
     *
     * @ORM\Column(name="peripheral_gps", type="boolean", nullable=false)
     */
    private $peripheralGps;

    /**
     * @var boolean
     *
     * @ORM\Column(name="peripheral_ticketsseller", type="boolean", nullable=false)
     */
    private $peripheralTicketsseller;

    /**
     * @var boolean
     *
     * @ORM\Column(name="peripheral_cam1", type="boolean", nullable=false)
     */
    private $peripheralCam1;

    /**
     * @var boolean
     *
     * @ORM\Column(name="peripheral_cam2", type="boolean", nullable=false)
     */
    private $peripheralCam2;

    /**
     * @var boolean
     *
     * @ORM\Column(name="peripheral_cam3", type="boolean", nullable=false)
     */
    private $peripheralCam3;

    /**
     * @var boolean
     *
     * @ORM\Column(name="peripheral_cam4", type="boolean", nullable=false)
     */
    private $peripheralCam4;

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
     * @var integer
     *
     * @ORM\Column(name="idDeviceModel", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $iddevicemodel;

    function __toString()
    {
        return $this->getLabel();
    }


}
