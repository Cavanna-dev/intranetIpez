<?php

namespace Ipez\PartyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TypeParty
 */
class TypeParty
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $partyId;

    /**
     * @var integer
     */
    private $typeId;


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
     * Set partyId
     *
     * @param integer $partyId
     * @return TypeParty
     */
    public function setPartyId($partyId)
    {
        $this->partyId = $partyId;

        return $this;
    }

    /**
     * Get partyId
     *
     * @return integer 
     */
    public function getPartyId()
    {
        return $this->partyId;
    }

    /**
     * Set typeId
     *
     * @param integer $typeId
     * @return TypeParty
     */
    public function setTypeId($typeId)
    {
        $this->typeId = $typeId;

        return $this;
    }

    /**
     * Get typeId
     *
     * @return integer 
     */
    public function getTypeId()
    {
        return $this->typeId;
    }
}
