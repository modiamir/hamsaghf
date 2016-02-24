<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Profile
 *
 * @ORM\Table(name="profile")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProfileRepository")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="context", type="string")
 * @ORM\DiscriminatorMap({"housemate" = "Housemate", "householder" = "Householder"})
 */
abstract class Profile
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", nullable=false)
     */
    protected $title;

    /**
     * @var boolean
     *
     * @ORM\Column(name="status", type="boolean", nullable=false, options={"default"=true})
     */
    protected $status = true;

    /**
     * @var \DateTime $created
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @var \DateTime $updated
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $updated;

    /**
     * @ORM\Column(name="smoker", type="string")
     */
    protected $smoker;

    /**
     * @ORM\ManyToMany(targetEntity="AgeRange")
     */
    protected $ageRanges;

    /**
     * @ORM\Column(name="guest", type="string")
     */
    protected $guest;

    /**
     * @ORM\Column(name="cleaning", type="integer")
     */
    protected $cleaning = 0;

    /**
     * @ORM\Column(name="wakeful", type="string")
     * @Assert\Choice(choices={"soon", "normal", "late"})
     */
    protected $wakeful;

    /**
     * @ORM\Column(name="constrained", type="integer")
     */
    protected $constrained = 0;

    /**
     * @ORM\ManyToMany(targetEntity="Feature")
     */
    protected $features;

    /**
     * @ORM\Column(name="description", type="text")
     */
    protected $description;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Region")
     */
    protected $regions;

    /**
     * @var integer
     *
     * @ORM\Column(name="min_mortgage", type="integer")
     */
    protected $minMortgage;

    /**
     * @var integer
     *
     * @ORM\Column(name="max_mortgage", type="integer")
     */
    protected $maxMortgage;

    /**
     * @var integer
     *
     * @ORM\Column(name="min_rent", type="integer")
     */
    protected $minRent;

    /**
     * @var integer
     *
     * @ORM\Column(name="max_rent", type="integer")
     */
    protected $maxRent;

    /**
     * @var string
     *
     * @ORM\Column(name="culturally", type="string", nullable=false)
     * @Assert\Choice(choices={"modern", "moderate", "traditional"})
     */
    private $culturally;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set status
     *
     * @param boolean $status
     * @return Profile
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return boolean 
     */
    public function getStatus()
    {
        return $this->status;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->ageRanges = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set smoker
     *
     * @param boolean $smoker
     * @return Profile
     */
    public function setSmoker($smoker)
    {
        $this->smoker = $smoker;

        return $this;
    }

    /**
     * Get smoker
     *
     * @return boolean 
     */
    public function getSmoker()
    {
        return $this->smoker;
    }

    /**
     * Add ageRanges
     *
     * @param \AppBundle\Entity\AgeRange $ageRanges
     * @return Profile
     */
    public function addAgeRange(\AppBundle\Entity\AgeRange $ageRanges)
    {
        $this->ageRanges[] = $ageRanges;

        return $this;
    }

    /**
     * Remove ageRanges
     *
     * @param \AppBundle\Entity\AgeRange $ageRanges
     */
    public function removeAgeRange(\AppBundle\Entity\AgeRange $ageRanges)
    {
        $this->ageRanges->removeElement($ageRanges);
    }

    /**
     * Get ageRanges
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAgeRanges()
    {
        return $this->ageRanges;
    }

    /**
     * Set guest
     *
     * @param boolean $guest
     * @return Profile
     */
    public function setGuest($guest)
    {
        $this->guest = $guest;

        return $this;
    }

    /**
     * Get guest
     *
     * @return boolean 
     */
    public function getGuest()
    {
        return $this->guest;
    }

    /**
     * Set cleaning
     *
     * @param integer $cleaning
     * @return Profile
     */
    public function setCleaning($cleaning)
    {
        $this->cleaning = $cleaning;

        return $this;
    }

    /**
     * Get cleaning
     *
     * @return integer 
     */
    public function getCleaning()
    {
        return $this->cleaning;
    }

    /**
     * Set wakeful
     *
     * @param string $wakeful
     * @return Profile
     */
    public function setWakeful($wakeful)
    {
        $this->wakeful = $wakeful;

        return $this;
    }

    /**
     * Get wakeful
     *
     * @return string
     */
    public function getWakeful()
    {
        return $this->wakeful;
    }

    /**
     * Set constrained
     *
     * @param integer $constrained
     * @return Profile
     */
    public function setConstrained($constrained)
    {
        $this->constrained = $constrained;

        return $this;
    }

    /**
     * Get constrained
     *
     * @return integer 
     */
    public function getConstrained()
    {
        return $this->constrained;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Profile
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Add features
     *
     * @param \AppBundle\Entity\Feature $features
     * @return Profile
     */
    public function addFeature(\AppBundle\Entity\Feature $features)
    {
        $this->features[] = $features;

        return $this;
    }

    /**
     * Remove features
     *
     * @param \AppBundle\Entity\Feature $features
     */
    public function removeFeature(\AppBundle\Entity\Feature $features)
    {
        $this->features->removeElement($features);
    }

    /**
     * Get features
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFeatures()
    {
        return $this->features;
    }

    /**
     * Add regions
     *
     * @param \AppBundle\Entity\Region $regions
     * @return Profile
     */
    public function addRegion(\AppBundle\Entity\Region $regions)
    {
        $this->regions[] = $regions;

        return $this;
    }

    /**
     * Remove regions
     *
     * @param \AppBundle\Entity\Region $regions
     */
    public function removeRegion(\AppBundle\Entity\Region $regions)
    {
        $this->regions->removeElement($regions);
    }

    /**
     * Get regions
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRegions()
    {
        return $this->regions;
    }

    /**
     * Set minMortgage
     *
     * @param integer $minMortgage
     * @return Profile
     */
    public function setMinMortgage($minMortgage)
    {
        $this->minMortgage = $minMortgage;

        return $this;
    }

    /**
     * Get minMortgage
     *
     * @return integer 
     */
    public function getMinMortgage()
    {
        return $this->minMortgage;
    }

    /**
     * Set maxMortgage
     *
     * @param integer $maxMortgage
     * @return Profile
     */
    public function setMaxMortgage($maxMortgage)
    {
        $this->maxMortgage = $maxMortgage;

        return $this;
    }

    /**
     * Get maxMortgage
     *
     * @return integer 
     */
    public function getMaxMortgage()
    {
        return $this->maxMortgage;
    }

    /**
     * Set minRent
     *
     * @param integer $minRent
     * @return Profile
     */
    public function setMinRent($minRent)
    {
        $this->minRent = $minRent;

        return $this;
    }

    /**
     * Get minRent
     *
     * @return integer 
     */
    public function getMinRent()
    {
        return $this->minRent;
    }

    /**
     * Set maxRent
     *
     * @param integer $maxRent
     * @return Profile
     */
    public function setMaxRent($maxRent)
    {
        $this->maxRent = $maxRent;

        return $this;
    }

    /**
     * Get maxRent
     *
     * @return integer 
     */
    public function getMaxRent()
    {
        return $this->maxRent;
    }


    /**
     * Set culturally
     *
     * @param string $culturally
     * @return Housemate
     */
    public function setCulturally($culturally)
    {
        $this->culturally = $culturally;

        return $this;
    }

    /**
     * Get culturally
     *
     * @return string
     */
    public function getCulturally()
    {
        return $this->culturally;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Profile
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     *
     * @return Profile
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Profile
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }
}
