<?php

namespace Ipez\ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Feature
 */
class Feature
{
    /**
     * @var integer
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=45)
     */
    private $nameFeature;

    /**
     * @var string
     * @ORM\Column(type="string", length=45)
     */
    private $value;


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
     * Set nameFeature
     *
     * @param string $nameFeature
     * @return Feature
     */
    public function setNameFeature($nameFeature)
    {
        $this->nameFeature = $nameFeature;

        return $this;
    }

    /**
     * Get nameFeature
     *
     * @return string 
     */
    public function getNameFeature()
    {
        return $this->nameFeature;
    }

    /**
     * Set value
     *
     * @param string $value
     * @return Feature
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string 
     */
    public function getValue()
    {
        return $this->value;
    }
}
