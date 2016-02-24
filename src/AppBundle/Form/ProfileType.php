<?php

namespace AppBundle\Form;

use FOS\UserBundle\Util\LegacyFormHelper;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;

class ProfileType extends AbstractType
{
    private $container;

    /**
     * HouseholderType constructor.
     *
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('gender', ChoiceType::class, array(
                'choices'  => array(
                    'male' => 'مرد',
                    'female' => 'زن',
                ),
                'expanded' => true,
                'multiple' => false,
                'label' => 'جنسیت'
            ))
            ->add('phone', null, array(
                'label' => 'شماره تلفن'
            ))
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'options' => array('translation_domain' => 'FOSUserBundle'),
                'first_options' => array('label' => 'form.password'),
                'second_options' => array('label' => 'form.password_confirmation'),
                'invalid_message' => 'fos_user.password.mismatch',
                'required' => false,
            ))
            ->remove('username')
            ->add('photo', HiddenType::class)
        ;


        $photoTransformer = new CallbackTransformer(
        // transform <br/> to \n so the textarea reads easier
            function ($originalData) {
                if (!$originalData) {
                    return "";
                }

                return $originalData->getId();
            },
            function ($submittedData) {
                $doctrine = $this->container->get('doctrine');
                $image = $doctrine->getRepository('AppBundle:Image')->findOneBy(['id' => $submittedData]);

                return $image;
            }
        );
        $builder->get('photo')->addModelTransformer($photoTransformer);

        $builder->get('email')->setDisabled(true);
        $builder->get('phone')->setDisabled(true);
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\ProfileFormType';
    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }

    // For Symfony 2.x
    public function getName()
    {
        return $this->getBlockPrefix();
    }
}
