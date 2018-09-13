<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Users
 *
 * @ORM\Table(name="users", indexes={@ORM\Index(name="userType", columns={"userType"})})
 * @ORM\Entity
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"user" = "User", "client" = "Client", "regularUser" = "RegularUser", "admin" = "Admin" })
 * @ORM\AttributeOverrides({
 *      @ORM\AttributeOverride(name="email",
 *          column=@ORM\Column(
 *              nullable = true,
 *          )
 *      ),
 *      @ORM\AttributeOverride(name="emailCanonical",
 *          column=@ORM\Column(
 *              nullable = true,
 *          )
 *      )
 * })
 */
class User extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idUser", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

//    /**
//     * @var string
//     *
//     * @ORM\Column(name="email", type="string", length=256, nullable=false)
//     */
//    protected $email;

    /**
     * @var string
     *
     * @ORM\Column(name="label", type="string", length=64, nullable=true)
     */
    protected $label;

    /**
     * @var string
     *
     * @ORM\Column(name="pass", type="text", length=65535, nullable=true)
     */
    protected $pass;

//    /**
//     * @var string
//     *
//     * @ORM\Column(name="salt", type="text", length=65535, nullable=false)
//     */
//    protected $salt;

    /**
     * @var integer
     *
     * @ORM\Column(name="parent", type="integer", nullable=true)
     */
    protected $parent;

    /**
     * @var integer
     *
     * @ORM\Column(name="active", type="integer", nullable=true)
     */
    protected $active;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime", nullable=true)
     */
    protected $createdat;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updatedAt", type="datetime", nullable=true)
     */
    protected $updatedat;

    /**
     * @var string
     *
     * @ORM\Column(name="auth_token", type="text", length=65535, nullable=true)
     */
    protected $authToken;

    /**
     * @var string
     *
     * @ORM\Column(name="token", type="text", length=65535, nullable=true)
     */
    protected $token;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=20, nullable=true)
     */
    protected $telephone;

    /**
     * @var \App\Entity\UserRole
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\UserRole")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="userType", referencedColumnName="idUserRole")
     * })
     */
    protected $usertype;

    /**
     * @var string
     * @Assert\Valid()
     * @Assert\Length(max=100, groups={"Default"})
     * @ORM\Column(name="name", type="string", length=100, nullable=true)
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=60, nullable=true)
     */
    protected $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="automatic_imeis", type="string", length=4000, nullable=true)
     */
    protected $automaticImeis;

    /**
     * @var string
     *
     * @ORM\Column(name="fences", type="text", nullable=true)
     */
    protected $fences;

    /**
     * @return string
     */
    public function getAutomaticImeis()
    {
        return $this->automaticImeis;
    }

    /**
     * @param string $automaticImeis
     * @return User
     */
    public function setAutomaticImeis(string $automaticImeis): User
    {
        $this->automaticImeis = $automaticImeis;
        return $this;
    }

    /**
     * @return string
     */
    public function getFences()
    {
        return $this->fences;
    }

    /**
     * @param string $fences
     * @return User
     */
    public function setFences(string $fences): User
    {
        $this->fences = $fences;
        return $this;
    }




    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return is_null($this->lastName) ? '' : $this->lastName;
    }

    /**
     * @param string $lastName
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->setParent(0)
            ->setUsername('')
        ->setActive(0)
        ->setCreatedat(new \DateTime())
        ->setUpdatedat(new \DateTime())
        ->setAuthToken('')
        ->setToken('')
        ->setTelephone('')
        ->setEnabled(true);
    }


    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
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
     * @return User
     */
    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @return string
     */
    public function getPass()
    {
        return $this->pass;
    }

    /**
     * @param string $pass
     * @return User
     */
    public function setPass($pass)
    {
        $this->pass = $pass;
        return $this;
    }

    /**
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * @param string $salt
     * @return User
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
        return $this;
    }

    /**
     * @return int
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param int $parent
     * @return User
     */
    public function setParent($parent)
    {
        $this->parent = $parent;
        return $this;
    }

    /**
     * @return int
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * @param int $active
     * @return User
     */
    public function setActive($active)
    {
        $this->active = $active;
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
     * @return User
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
     * @return User
     */
    public function setUpdatedat($updatedat)
    {
        $this->updatedat = $updatedat;
        return $this;
    }

    /**
     * @return string
     */
    public function getAuthToken()
    {
        return $this->authToken;
    }

    /**
     * @param string $authToken
     * @return User
     */
    public function setAuthToken($authToken)
    {
        $this->authToken = $authToken;
        return $this;
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param string $token
     * @return User
     */
    public function setToken($token)
    {
        $this->token = $token;
        return $this;
    }

    /**
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * @param string $telephone
     * @return User
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
        return $this;
    }

    /**
     * @return UserRole
     */
    public function getUsertype()
    {
        return $this->usertype;
    }

    /**
     * @param UserRole $usertype
     * @return User
     */
    public function setUsertype($usertype)
    {
        $this->usertype = $usertype;
        return $this;
    }

    public function setPassword($password)
    {
        parent::setPassword($password);
        $this->pass = parent::getPassword();
        return $this;
    }

}
