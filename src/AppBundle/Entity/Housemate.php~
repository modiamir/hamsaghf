<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Housemate
 *
 * @ORM\Table(name="housemate")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\HousemateRepository")
 */
class Housemate extends Profile
{
    /**
     * @var integer
     *
     * @ORM\Column(name="age", type="integer", nullable=false)
     */
    private $age;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\JobType")
     */
    private $jobType;

    /**
     * @var Media
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Image")
     */
    private $photo;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\User", inversedBy="housemate")
     */
    private $user;

    /**
     * Constructor
     */
    public function __construct()
    {
    }

    /**
     * Set age
     *
     * @param integer $age
     * @return Housemate
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
     * Set photo
     *
     * @param \AppBundle\Entity\Image $photo
     * @return Housemate
     */
    public function setPhoto(\AppBundle\Entity\Image $photo = null)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return \AppBundle\Entity\Image 
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set jobType
     *
     * @param \AppBundle\Entity\JobType $jobType
     * @return Housemate
     */
    public function setJobType(\AppBundle\Entity\JobType $jobType = null)
    {
        $this->jobType = $jobType;

        return $this;
    }

    /**
     * Get jobType
     *
     * @return \AppBundle\Entity\JobType 
     */
    public function getJobType()
    {
        return $this->jobType;
    }

    /**
     * Set smoker
     *
     * @param boolean $smoker
     * @return Housemate
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
     * Set guest
     *
     * @param boolean $guest
     * @return Housemate
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
     * @return Housemate
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
     * @param integer $wakeful
     * @return Housemate
     */
    public function setWakeful($wakeful)
    {
        $this->wakeful = $wakeful;

        return $this;
    }

    /**
     * Get wakeful
     *
     * @return integer 
     */
    public function getWakeful()
    {
        return $this->wakeful;
    }

    /**
     * Set constrained
     *
     * @param integer $constrained
     * @return Housemate
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
     * @return Housemate
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
     * @return Housemate
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
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     * @return Housemate
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add regions
     *
     * @param \AppBundle\Entity\Region $regions
     * @return Housemate
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
     * Set title
     *
     * @param string $title
     *
     * @return Housemate
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
