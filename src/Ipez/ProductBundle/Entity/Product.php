<?php

namespace Ipez\ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Product
 */
class Product
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $reference;

    /**
     * @var string
     */
    private $tradeName;

    /**
     * @var integer
     */
    private $cI;


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
     * Set reference
     *
     * @param string $reference
     * @return Product
     */
    public function setReference($reference)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * Get reference
     *
     * @return string 
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Set tradeName
     *
     * @param string $tradeName
     * @return Product
     */
    public function setTradeName($tradeName)
    {
        $this->tradeName = $tradeName;

        return $this;
    }

    /**
     * Get tradeName
     *
     * @return string 
     */
    public function getTradeName()
    {
        return $this->tradeName;
    }

    /**
     * Set cI
     *
     * @param integer $cI
     * @return Product
     */
    public function setCI($cI)
    {
        $this->cI = $cI;

        return $this;
    }

    /**
     * Get cI
     *
     * @return integer 
     */
    public function getCI()
    {
        return $this->cI;
    }
}
