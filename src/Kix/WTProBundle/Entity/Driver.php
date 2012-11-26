<?php

namespace Kix\WTProBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Driver
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Driver
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="firstName", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="lastName", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Regex("/^\+\d+$/")
     */
    private $phone;

    /**
     * @var integer
     *
     * @ORM\Column(name="age", type="smallint")
     * @Assert\NotBlank()
     * @Assert\Min(18)
     */
    private $age;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isActive", type="boolean")
     */
    private $isActive;

    /**
     * @var array
     * @ORM\ManyToMany(targetEntity="VehicleModel")
     */
    private $canDriveModels;

    /**
     * Init collections
     */
    public function __construct()
    {
        $this->canDriveModels = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     * @return Driver
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    
        return $this;
    }

    /**
     * Get firstName
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     * @return Driver
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    
        return $this;
    }

    /**
     * Get lastName
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return Driver
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    
        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set age
     *
     * @param integer $age
     * @return Driver
     */
    public function setAge($age)
    {
        $this->age = $age;
    
        return $this;
    }

    /**
     * Get age
     *
     * @return integer 
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return Driver
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
    
        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    public function getCanDriveModels()
    {
        return $this->canDriveModels;
    }

    public function setCanDriveModels(array $models)
    {
        foreach($models as $model) {
            $this->addModel($model);
        }
    }

    public function toggleActive()
    {
        $this->isActive = !$this->isActive;
    }

    public function toArray()
    {
        return array(
            'id'        => $this->id,
            'firstName' => $this->firstName,
            'lastName'  => $this->lastName,
            'phone'     => $this->phone,
            'age'       => $this->age,
            'isActive'  => $this->isActive,
            'canDriveModels' => (array) $this->canDriveModels
        );
    }

}
