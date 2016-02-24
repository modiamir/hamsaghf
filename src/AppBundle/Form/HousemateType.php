<?php

namespace AppBundle\Form;

use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Count;
use Symfony\Component\Validator\Constraints\NotBlank;

class HousemateType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', null, [
                'attr' => ['class' => 'ui fluid'],
                'constraints' => [
                    new NotBlank()
                ],
                'label' => 'عنوان'
            ])
            ->add('regions', null, [
                'choice_label' => 'name',
                'attr' => ['class' => 'ui fluid search dropdown'],
                'constraints' => [
                    new Count([
                        'min' => 1,
                        'max' => 10
                    ])
                ],
                'label' => 'موقعیت های مطلوب جغرافیایی'
            ])
            ->add('minMortgage', null , [
                'label' => 'حداقل رهن'
            ])
            ->add('maxMortgage', null , [
                'label' => 'حداکثر رهن'
            ])
            ->add('minRent', null , [
                'label' => 'حداقل اجاره'
            ])
            ->add('maxRent', null , [
                'label' => 'حداکثر اجاره'
            ])
            ->add('jobType', null, [
                'choice_label' => 'name',
                'attr' => ['class' => 'ui fluid search dropdown'],
                'label' => 'شغل'
            ])
            ->add('wakeful', ChoiceType::class, array(
                'choices'  => array(
                    'زود' => 'soon',
                    'متوسط' => 'normal',
                    'دیر' => 'late'
                ),
                'expanded' => true,
                'multiple' => false,
                'label' => 'ساعت خواب',
                'choices_as_values' => true,
            ))
            ->add('culturally', ChoiceType::class, array(
                'choices'  => array(
                    'modern' => 'مدرن',
                    'moderate' => 'میانه رو',
                    'traditional' => 'سنتی'
                ),
                'expanded' => true,
                'multiple' => false,
                'label' => 'دید فرهنگی',
            ))
            ->add('smoker', ChoiceType::class, array(
                'choices'  => array(
                    'no' => 'ممنوع',
                    'yes' => 'آزاد',
                ),
                'expanded' => true,
                'multiple' => false,
                'label' => 'سیگار',
            ))
            ->add('description', null, [
                'label' => 'توضیحات',
                'constraints' => [
                    new NotBlank()
                ]
            ])
        ;

    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Housemate',
        ));
    }

    public function getName()
    {
        return 'housemate';
    }
}
