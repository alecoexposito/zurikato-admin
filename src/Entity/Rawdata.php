<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rawdata
 *
 * @ORM\Table(name="rawdata")
 * @ORM\Entity
 */
class Rawdata
{
    /**
     * @return string
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param string $data
     * @return Rawdata
     */
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @return string
     */
    public function getDataParsed()
    {
        return $this->dataParsed;
    }

    /**
     * @param string $dataParsed
     * @return Rawdata
     */
    public function setDataParsed($dataParsed)
    {
        $this->dataParsed = $dataParsed;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getVdate()
    {
        return $this->vdate;
    }

    /**
     * @param \DateTime $vdate
     * @return Rawdata
     */
    public function setVdate($vdate)
    {
        $this->vdate = $vdate;
        return $this;
    }

    /**
     * @return int
     */
    public function getIdraw()
    {
        return $this->idraw;
    }

    /**
     * @param int $idraw
     * @return Rawdata
     */
    public function setIdraw($idraw)
    {
        $this->idraw = $idraw;
        return $this;
    }
    /**
     * @var string
     *
     * @ORM\Column(name="data", type="text", length=65535, nullable=false)
     */
    private $data;

    /**
     * @var string
     *
     * @ORM\Column(name="data_parsed", type="text", length=65535, nullable=false)
     */
    private $dataParsed;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="vDate", type="datetime", nullable=false)
     */
    private $vdate;

    /**
     * @var integer
     *
     * @ORM\Column(name="idraw", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idraw;


}
