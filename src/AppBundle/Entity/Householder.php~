<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Householder
 *
 * @ORM\Table(name="householder")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\HouseholderRepository")
 */
class Householder extends Profile
{
    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Image",cascade={"persist"})
     * @Assert\Count(
     *      min = "0",
     *      max = "5",
     *      minMessage = "You must specify at least one email",
     *      maxMessage = "You cannot specify more than {{ limit }} emails"
     * )
     */
    private $photos;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\JobType")
     */
    private $jobTypes;

    /**
     * @ORM\Column(name="num_of_current_hommates", type="integer")
     */
    private $numOfCurrentHommates;

    /**
     * @ORM\Column(name="num_of_needed_hommates", type="integer")
     */
    private $numOfNeededHommates;

    /**
     * @ORM\Column(name="dimension", type="integer")
     */
    private $dimension;

    /**
     * @ORM\Column(name="start_date", type="date")
     */
    private $startDate;

    /**
     * @ORM\Column(name="due_date", type="date")
     */
    private $dueDate;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\User", inversedBy="householder")
     */
    private $user;

    /**
     * Set numOfCurrentHommates
     *
     * @param integer $numOfCurrentHommates
     * @return Householder
     */
    public function setNumOfCurrentHommates($numOfCurrentHommates)
    {
        $this->numOfCurrentHommates = $numOfCurrentHommates;

        return $this;
    }

    /**
     * Get numOfCurrentHommates
     *
     * @return integer 
     */
    public function getNumOfCurrentHommates()
    {
        return $this->numOfCurrentHommates;
    }

    /**
     * Set numOfNeededHommates
     *
     * @param integer $numOfNeededHommates
     * @return Householder
     */
    public function setNumOfNeededHommates($numOfNeededHommates)
    {
        $this->numOfNeededHommates = $numOfNeededHommates;

        return $this;
    }

    /**
     * Get numOfNeededHommates
     *
     * @return integer 
     */
    public function getNumOfNeededHommates()
    {
        return $this->numOfNeededHommates;
    }

    /**
     * Set dimension
     *
     * @param integer $dimension
     * @return Householder
     */
    public function setDimension($dimension)
    {
        $this->dimension = $dimension;

        return $this;
    }

    /**
     * Get dimension
     *
     * @return integer 
     */
    public function getDimension()
    {
        return $this->dimension;
    }

    /**
     * Add photos
     *
     * @param \AppBundle\Entity\Image $photos
     * @return Householder
     */
    public function addPhoto(\AppBundle\Entity\Image $photos)
    {
        $this->photos[] = $photos;

        return $this;
    }

    /**
     * Remove photos
     *
     * @param \AppBundle\Entity\Image $photos
     */
    public function removePhoto(\AppBundle\Entity\Image $photos)
    {
        $this->photos->removeElement($photos);
    }

    /**
     * Get photos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPhotos()
    {
        return $this->photos;
    }

    /**
     * Add jobTypes
     *
     * @param \AppBundle\Entity\JobType $jobTypes
     * @return Householder
     */
    public function addJobType(\AppBundle\Entity\JobType $jobTypes)
    {
        $this->jobTypes[] = $jobTypes;

        return $this;
    }

    /**
     * Remove jobTypes
     *
     * @param \AppBundle\Entity\JobType $jobTypes
     */
    public function removeJobType(\AppBundle\Entity\JobType $jobTypes)
    {
        $this->jobTypes->removeElement($jobTypes);
    }

    /**
     * Get jobTypes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getJobTypes()
    {
        return $this->jobTypes;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     * @return Householder
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
     * Set startDate
     *
     * @param \DateTime $startDate
     * @return Householder
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime 
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set dueDate
     *
     * @param \DateTime $dueDate
     * @return Householder
     */
    public function setDueDate($dueDate)
    {
        $this->dueDate = $dueDate;

        return $this;
    }

    /**
     * Get dueDate
     *
     * @return \DateTime 
     */
    public function getDueDate()
    {
        return $this->dueDate;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Householder
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
