<?php

namespace AppBundle\Form;

use Faker\Provider\Image;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Count;
use Symfony\Component\Validator\Constraints\NotBlank;
use Doctrine\Common\Collections\ArrayCollection;

class HouseholderFilterType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('regions', null, [
                'choice_label' => 'name',
                'attr' => ['class' => 'ui fluid search dropdown'],
                'label' => 'مناطق',
                'required' => false
            ])
            ->add('minMortgage', null , [
                'label' => 'حداقل رهن',
                'required' => false
            ])
            ->add('maxMortgage', null , [
                'label' => 'حداکثر رهن',
                'required' => false
            ])
            ->add('minRent', null , [
                'label' => 'حداقل اجاره',
                'required' => false
            ])
            ->add('maxRent', null , [
                'label' => 'حداکثر اجاره',
                'required' => false
            ])
            ->add('jobTypes', null, [
                'choice_label' => 'name',
                'attr' => ['class' => 'ui fluid search dropdown'],
                'label' => 'شغل',
                'required' => false
            ])
            ->add('submit', SubmitType::class, [
                'label' => "جستجو"
            ])
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Householder',
            'method' => 'GEt'
        ));
    }

    public function getName()
    {
        return 'householder_filter';
    }
}
