<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ApiOptions
 *
 * @ORM\Table(name="api_options")
 * @ORM\Entity
 */
class ApiOptions
{

    /**
     * @return \DateTime
     */
    public function getCreatedat()
    {
        return $this->createdat;
    }

    /**
     * @param \DateTime $createdat
     * @return ApiOptions
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
     * @return ApiOptions
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
     * @return ApiOptions
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

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
     * @ORM\Column(name="id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="api_pass", type="string", nullable=true)
     */
    private $api_pass;

    /**
     * @return string
     */
    public function getApiPass(): string {
        return $this->api_pass;
    }

    /**
     * @param string $api_pass
     * @return ApiOptions
     */
    public function setApiPass(string $api_pass) {
        $this->api_pass = $api_pass;
        return $this;
    }



}
