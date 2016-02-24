<?php

namespace AppBundle\Repository;
use Symfony\Component\Form\Form;

/**
 * HousemateRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class HousemateRepository extends ProfileRepository
{
    public function filterByForm(Form $form)
    {
        $qb = parent::filterByForm($form);

        $jobTypes = $form->get('jobTypes')->getViewData();

        if (is_array($jobTypes) && count($jobTypes) > 0) {
            $qb->join('p.jobType', 'jt')
                ->andWhere($qb->expr()->in('jt.id',$jobTypes));
        }

        return $qb;
    }
}
