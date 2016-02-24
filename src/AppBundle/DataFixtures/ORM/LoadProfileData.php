<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Householder;
use AppBundle\Entity\Housemate;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\User;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadProfileData extends AbstractFixture implements FixtureInterface, ContainerAwareInterface
{
    private $container;
    private $regions;
    private $jobs;
    private $ageRanges;
    private $features;
    private $photos;

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 50; $i++ ) {
            $user = new User();
            $user->setEmail('test'.$i.rand(10000, 99999).'@example.com');
            $user->setEnabled(true);
            $user->setPlainPassword('test');

            $holdermate = rand(0, 1);

            if ($holdermate) {
                $profile = $this->randHousemate($user);
                $user->setHousemate($profile);
            } else {
                $profile = $this->randHousemate($user);
                $user->setHousemate($profile);
            }



            $manager->persist($profile);
            $manager->persist($user);

            $manager->flush();
        }
    }

    private function randHouseholder(User $user)
    {
        $householder = new Householder();

        $householder->addRegion($this->randRegion());
        $householder->setGuest($this->randGuest());

        $minMortgage = rand(0,40);
        $maxMortgage = rand($minMortgage, 40);
        $householder->setMinMortgage($minMortgage);
        $householder->setMaxMortgage($maxMortgage);

        $minRent = rand(0,40);
        $maxRent = rand($minRent, 40);
        $householder->setMinRent($minRent);
        $householder->setMaxRent($maxRent);

        $householder->addJobType($this->randJob());

        $householder->addAgeRange($this->randAgeRange());

        $householder->addFeature($this->randFeature());

        $householder->addPhoto($this->randPhoto());

        $householder->setStartDate(new \DateTime());
        $householder->setDueDate(new \DateTime());

        $householder->setDescription('description ' . ' ' . rand(10000, 99999));
        $householder->setDimension(rand(40,100));

        $householder->setSmoker($this->randSmoker());
        $householder->setCulturally($this->randCulturally());
        $householder->setWakeful($this->randWakeful());

        $householder->setUser($user);

        return $householder;
    }

    private function randHousemate(User $user)
    {
        $housemate = new Housemate();

        $housemate->addRegion($this->randRegion());

        $minMortgage = rand(0,40);
        $maxMortgage = rand($minMortgage, 40);
        $housemate->setMinMortgage($minMortgage);
        $housemate->setMaxMortgage($maxMortgage);

        $minRent = rand(0,40);
        $maxRent = rand($minRent, 40);
        $housemate->setMinRent($minRent);
        $housemate->setMaxRent($maxRent);

        $housemate->setJobType($this->randJob());


        

        $housemate->setSmoker($this->randSmoker());
        $housemate->setCulturally($this->randCulturally());
        $housemate->setWakeful($this->randWakeful());
        $housemate->setGuest('free');

        $housemate->setUser($user);
        $housemate->setDescription('description ' . ' ' . rand(10000, 99999));

        return $housemate;
    }

    private function randRegion()
    {
        return $this->regions[rand(0, count($this->regions) - 1)];
    }

    private function randAgeRange()
    {
        return $this->ageRanges[rand(0, count($this->ageRanges) - 1)];
    }

    private function randJob()
    {
        return $this->jobs[rand(0, count($this->jobs) - 1)];
    }

    private function randFeature()
    {
        return $this->features[rand(0, count($this->features) - 1)];
    }

    private function randPhoto()
    {
        return $this->photos[rand(0, count($this->photos) - 1)];
    }

    private function randGuest()
    {
        $values = ["limited", "free"];

        return $values[rand(0,1)];
    }

    private function randSmoker()
    {
        $values = ["no", "yes"];

        return $values[rand(0,1)];
    }

    private function randCulturally()
    {
        $values = ["modern", "moderate", "traditional"];

        return $values[rand(0,2)];
    }

    private function randWakeful()
    {
        $values = ["soon", "late", "normal"];

        return $values[rand(0,2)];
    }

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;

        $this->regions = $this->container->get('doctrine')
            ->getRepository('AppBundle:Region')
            ->findAll();

        $this->jobs = $this->container->get('doctrine')
            ->getRepository('AppBundle:JobType')
            ->findAll();

        $this->ageRanges = $this->container->get('doctrine')
            ->getRepository('AppBundle:AgeRange')
            ->findAll();

        $this->features = $this->container->get('doctrine')
            ->getRepository('AppBundle:Feature')
            ->findAll();

        $this->photos = $this->container->get('doctrine')
            ->getRepository('AppBundle:Image')
            ->findAll();
    }
}
