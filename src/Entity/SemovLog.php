<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Camera
 *
 * @ORM\Table(name="semov_log")
 * @ORM\Entity
 */
class SemovLog
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="data_json", type="text", nullable=true)
     */
    private $dataJson;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;


    /**
     * @return int
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * @param int $id
     * @return SemovLog
     */
    public function setId(int $id): SemovLog {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getDataJson(): string {
        return $this->dataJson;
    }

    /**
     * @param string $dataJson
     * @return SemovLog
     */
    public function setDataJson(string $dataJson): SemovLog {
        $this->dataJson = $dataJson;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     * @return SemovLog
     */
    public function setCreatedAt(\DateTime $createdAt): SemovLog {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     * @return SemovLog
     */
    public function setUpdatedAt(\DateTime $updatedAt): SemovLog {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    public function getMexicoCreatedAt() {
        return $this->convert_from_another_time($this->createdAt, 0, -5);
    }

    /**
     * @param \DateTime $source
     * @return mixed
     */
    public function convert_from_another_time($source){


        $dt = new \DateTime($source->format('Y-m-d H:i:s'), new \DateTimeZone('UTC'));
        $dt->setTimezone(new \DateTimeZone('America/Mexico_City'));

        return $dt->format('Y-m-d H:i:s T');

    }



}
