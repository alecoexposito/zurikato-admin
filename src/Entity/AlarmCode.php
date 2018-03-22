<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AlarmCode
 *
 * @ORM\Table(name="alarm_code")
 * @ORM\Entity
 */
class AlarmCode
{
    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     * @return AlarmCode
     */
    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }
    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=45, nullable=true)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="readable", type="string", length=255, nullable=true)
     */
    private $readable;

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


}
