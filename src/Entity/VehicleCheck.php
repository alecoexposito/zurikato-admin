<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\Mapping as ORM;

/**
 * VehicleCheck
 *
 * @ORM\Table(name="vehicle_check")
 * @ORM\Entity(repositoryClass="App\Repository\VehicleCheckRepository")
 */
class VehicleCheck
{

    const STATUS_CURRENT = 'CURRENT';
    const STATUS_PAUSED = 'PAUSED';
    const STATUS_FINISHED = 'FINISHED';



    /**
     * @var string
     *
     * @ORM\Column(name="arrived_tags", type="string", length=4000, nullable=false)
     */
    private $arrivedTags;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", nullable=true)
     */
    private $status;

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
     * VehicleCheck constructor.
     */
    public function __construct()
    {
        $arrivedTagsArray = array();
        $this->arrivedTags = json_encode($arrivedTagsArray);
        $this->setCreatedat(new \DateTime());
        $this->setUpdatedat(new \DateTime());
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
     * @return VehicleCheck
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
     * @return VehicleCheck
     */
    public function setCreatedat(\DateTime $createdat): VehicleCheck
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
     * @return VehicleCheck
     */
    public function setUpdatedat(\DateTime $updatedat): VehicleCheck
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
     * @return VehicleCheck
     */
    public function setVehicle($vehicle): VehicleCheck
    {
        $this->vehicle = $vehicle;
        return $this;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        $statusTranslated = $this->status;
        if($this->status == 'FINISHED')
            $statusTranslated = 'Terminado';
        elseif ($this->status == 'CURRENT')
            $statusTranslated = 'En proceso';
        elseif ($this->status == 'PAUSED')
            $statusTranslated = 'Pausado';
        return $statusTranslated;
    }

    /**
     * @param string $status
     * @return VehicleCheck
     */
    public function setStatus(string $status): VehicleCheck
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return string
     */
    public function getArrivedTags()
    {
        return $this->arrivedTags;
    }

    /**
     * @param string $arrivedTags
     * @return VehicleCheck
     */
    public function setArrivedTags(string $arrivedTags): VehicleCheck
    {
        $this->arrivedTags = $arrivedTags;
        return $this;
    }

    /**
     * @param array $tags
     */
    public function addArrivedTags($tags)
    {
        $arrivedTagsArray = json_decode($this->arrivedTags);
        $matchedTags = array_intersect($tags, $this->vehicle->getTagsRfids());
        $result = false;
        if(count($matchedTags) > 0)
            $this->updatedat = new \DateTime();
        foreach ($matchedTags as $index => $matchedTag) {
            if(!in_array($matchedTag, $arrivedTagsArray)) {
                $arrivedTagsArray[] = $matchedTag;
                $result = true;
            }

        }
        $this->arrivedTags = json_encode($arrivedTagsArray);
        return $result;
    }

    public function getName()
    {
        return $this->vehicle->getName();
    }

    public function getPlateNumber()
    {
        return $this->vehicle->getPlateNumber();
    }

    public function getResult()
    {
        $arrivedtagsArray = json_decode($this->arrivedTags);
        $vehicleTags = $this->vehicle->getTagsRfids();
        if(count($arrivedtagsArray) == count($vehicleTags))
            return 'OK';
        return 'Faltan Tags';
//        if(count($arrivedtagsArray) < count($vehicleTags))
//            return 'Faltan Tags';

    }

}
