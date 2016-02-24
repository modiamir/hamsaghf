<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;

class UserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fullName', null, array(
                'label' => 'نام و نام خانوادگی'
            ))
            ->add('phone', null, array(
                'label' => 'شماره تلفن'
            ))
            ->add('email', null, array(
                'label' => 'پست الکترونیک'
            ))
            ->add('gender', ChoiceType::class, array(
                'choices'  => array(
                    true => 'مرد',
                    false => 'زن',
                ),
                'expanded' => true,
                'multiple' => false,
                'label' => 'جنسیت'
            ))
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options'  => array('label' => 'رمز عبور'),
                'second_options' => array('label' => 'تکرار رمز عبور'),
            ))
            ->add('termsAccepted', CheckboxType::class, array(
                'mapped' => false,
                'constraints' => new IsTrue(),
                'label' => 'قوانین را می پذیرم.'
            ))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\User'
        ));
    }
}
