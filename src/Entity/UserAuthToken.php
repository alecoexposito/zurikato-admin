<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserAuthToken
 *
 * @ORM\Table(name="user_auth_token", indexes={@ORM\Index(name="idUser", columns={"idUser"})})
 * @ORM\Entity
 */
class UserAuthToken
{
    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param string $token
     * @return UserAuthToken
     */
    public function setToken($token)
    {
        $this->token = $token;
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
     * @return UserAuthToken
     */
    public function setVdate($vdate)
    {
        $this->vdate = $vdate;
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
     * @return UserAuthToken
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
     * @return UserAuthToken
     */
    public function setUpdatedat($updatedat)
    {
        $this->updatedat = $updatedat;
        return $this;
    }

    /**
     * @return int
     */
    public function getIdauthtoken()
    {
        return $this->idauthtoken;
    }

    /**
     * @param int $idauthtoken
     * @return UserAuthToken
     */
    public function setIdauthtoken($idauthtoken)
    {
        $this->idauthtoken = $idauthtoken;
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
     * @return UserAuthToken
     */
    public function setIduser($iduser)
    {
        $this->iduser = $iduser;
        return $this;
    }
    /**
     * @var string
     *
     * @ORM\Column(name="token", type="text", length=65535, nullable=false)
     */
    private $token;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="vDate", type="datetime", nullable=false)
     */
    private $vdate;

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
     * @ORM\Column(name="idAuthToken", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idauthtoken;

    /**
     * @var \App\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idUser", referencedColumnName="idUser")
     * })
     */
    private $iduser;


}
