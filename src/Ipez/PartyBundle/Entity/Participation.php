<?php

namespace Ipez\PartyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Participation
 */
class Participation
{

    /**
     * @var integer
     */
    private $id;

    /**
     * @var boolean
     */
    private $confirm;

    /**
     * @var \DateTime
     */
    private $dateInvit;

    /**
     * @var \DateTime
     */
    private $dateConfirm;

    /**
     * @var integer
     */
    private $userId;

    /**
     * @var integer
     */
    private $partyId;

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
     * Set confirm
     *
     * @param boolean $confirm
     * @return Participation
     */
    public function setConfirm($confirm)
    {
        $this->confirm = $confirm;

        return $this;
    }

    /**
     * Get confirm
     *
     * @return boolean 
     */
    public function getConfirm()
    {
        return $this->confirm;
    }

    /**
     * Set dateInvit
     *
     * @param \DateTime $dateInvit
     * @return Participation
     */
    public function setDateInvit($dateInvit)
    {
        $this->dateInvit = $dateInvit;

        return $this;
    }

    /**
     * Get dateInvit
     *
     * @return \DateTime 
     */
    public function getDateInvit()
    {
        return $this->dateInvit;
    }

    /**
     * Set dateConfirm
     *
     * @param \DateTime $dateConfirm
     * @return Participation
     */
    public function setDateConfirm($dateConfirm)
    {
        $this->dateConfirm = $dateConfirm;

        return $this;
    }

    /**
     * Get dateConfirm
     *
     * @return \DateTime 
     */
    public function getDateConfirm()
    {
        return $this->dateConfirm;
    }

    /**
     * Set dateConfirm
     *
     * @param \DateTime $dateConfirm
     * @return Participation
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get dateConfirm
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set partyId
     *
     * @param \DateTime $dateConfirm
     * @return Participation
     */
    public function setPartyId($partyId)
    {
        $this->partyId = $partyId;

        return $this;
    }

    /**
     * Get partyId
     *
     * @return \DateTime 
     */
    public function getPartyId()
    {
        return $this->partyId;
    }

}
