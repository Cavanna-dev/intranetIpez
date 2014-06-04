<?php

namespace Ipez\ProductBundle\Entity;

use Ipez\ProductBundle\Entity\Feature;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Product
 */
class Product
{

    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string",length=55)
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
     * @var integer
     */
    private $type;

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
     * Get cI
     *
     * @return integer 
     */
    public function getCI()
    {
        return $this->cI;
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
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set cI
     *
     * @param integer $cI
     * @return Product
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

}
