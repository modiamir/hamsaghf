<?php

namespace AppBundle\Form;

use Faker\Provider\Image;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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

class ProfileFilterType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('regions', EntityType::class, [
                'choice_label' => 'name',
                'attr' => ['class' => 'ui fluid search dropdown'],
                'label' => 'مناطق',
                'required' => false,
                'class' => 'AppBundle\Entity\Region',
                'multiple' => true,
            ])
            ->add('minMortgage', IntegerType::class , [
                'label' => 'حداقل رهن',
                'required' => false
            ])
            ->add('maxMortgage', IntegerType::class , [
                'label' => 'حداکثر رهن',
                'required' => false
            ])
            ->add('minRent', IntegerType::class , [
                'label' => 'حداقل اجاره',
                'required' => false
            ])
            ->add('maxRent', IntegerType::class , [
                'label' => 'حداکثر اجاره',
                'required' => false
            ])
            ->add('jobTypes', EntityType::class, [
                'choice_label' => 'name',
                'attr' => ['class' => 'ui fluid search dropdown'],
                'label' => 'شغل',
                'multiple' => true,
                'class' => 'AppBundle\Entity\JobType',
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
            'method' => 'GET'
        ));
    }

    public function getName()
    {
        return 'profile_filter';
    }
}
