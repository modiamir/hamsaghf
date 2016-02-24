<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AgeRange
 *
 * @ORM\Table(name="age_range")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AgeRangeRepository")
 */
class AgeRange
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="low", type="integer")
     */
    private $low;

    /**
     * @var int
     *
     * @ORM\Column(name="hight", type="integer")
     */
    private $hight;


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
     * Set low
     *
     * @param integer $low
     *
     * @return AgeRange
     */
    public function setLow($low)
    {
        $this->low = $low;

        return $this;
    }

    /**
     * Get low
     *
     * @return int
     */
    public function getLow()
    {
        return $this->low;
    }

    /**
     * Set hight
     *
     * @param integer $hight
     *
     * @return AgeRange
     */
    public function setHight($hight)
    {
        $this->hight = $hight;

        return $this;
    }

    /**
     * Get hight
     *
     * @return int
     */
    public function getHight()
    {
        return $this->hight;
    }

    /**
     * Convert to string
     *
     * @return string
     */
    public function __toString()
    {
        if ($this->low == 0 && $this->hight > 0) {
            return 'کمتر از  ' . $this->hight;
        } elseif ($this->low > 0 && $this->hight == 1000) {
            return 'بیشتر از ' . $this->low;
        } elseif ($this->low >0 && $this->hight > 0) {
            return $this->low . ' - ' . $this->hight;
        } else {
            return 'نامشخص';
        }
    }
}
