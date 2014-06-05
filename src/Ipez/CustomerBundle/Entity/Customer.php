<?php

namespace Ipez\CustomerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Customer
 */
class Customer
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $mail;

    /**
     * @var string
     */
    private $number;

    /**
     * @var string
     */
    private $numberGsm;

    /**
     * @var string
     */
    private $address;

    /**
     * @var string
     */
    private $town;

    /**
     * @var integer
     */
    private $cp;

    /**
     * @var \DateTime
     */
    private $dateBirth;

    /**
     * @var boolean
     */
    private $isActive;


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
     * Set name
     *
     * @param string $name
     * @return Customer
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     * @return Customer
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
     * Set mail
     *
     * @param string $mail
     * @return Customer
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string 
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set number
     *
     * @param string $number
     * @return Customer
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return string 
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set numberGsm
     *
     * @param string $numberGsm
     * @return Customer
     */
    public function setNumberGsm($numberGsm)
    {
        $this->numberGsm = $numberGsm;

        return $this;
    }

    /**
     * Get numberGsm
     *
     * @return string 
     */
    public function getNumberGsm()
    {
        return $this->numberGsm;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return Customer
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set town
     *
     * @param string $town
     * @return Customer
     */
    public function setTown($town)
    {
        $this->town = $town;

        return $this;
    }

    /**
     * Get town
     *
     * @return string 
     */
    public function getTown()
    {
        return $this->town;
    }

    /**
     * Set cp
     *
     * @param integer $cp
     * @return Customer
     */
    public function setCp($cp)
    {
        $this->cp = $cp;

        return $this;
    }

    /**
     * Get cp
     *
     * @return integer 
     */
    public function getCp()
    {
        return $this->cp;
    }

    /**
     * Set dateBirth
     *
     * @param \DateTime $dateBirth
     * @return Customer
     */
    public function setDateBirth($dateBirth)
    {
        $this->dateBirth = $dateBirth;

        return $this;
    }

    /**
     * Get dateBirth
     *
     * @return \DateTime 
     */
    public function getDateBirth()
    {
        return $this->dateBirth;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return Customer
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
    /**
     * @var boolean
     */
    private $isNewsletter;


    /**
     * Set isNewsletter
     *
     * @param boolean $isNewsletter
     * @return Customer
     */
    public function setIsNewsletter($isNewsletter)
    {
        $this->isNewsletter = $isNewsletter;

        return $this;
    }

    /**
     * Get isNewsletter
     *
     * @return boolean 
     */
    public function getIsNewsletter()
    {
        return $this->isNewsletter;
    }
}
