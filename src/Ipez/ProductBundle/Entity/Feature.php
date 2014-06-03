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
     */
    private $id;

    /**
     * @var string
     */
    private $nameFeature;

    /**
     * @var string
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
