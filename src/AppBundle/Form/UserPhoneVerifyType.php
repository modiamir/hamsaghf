<?php

namespace AppBundle\Form;

use AppBundle\Entity\PhoneVerificationCode;
use AppBundle\Entity\User;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Validator\Context\ExecutionContext;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class UserPhoneVerifyType extends AbstractType
{
    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $container = $this->container;
        $builder
            ->add('phone', null, array(
                'constraints' => [
                    new NotBlank(),
                    new Type(array(
                        'type' => 'numeric'
                    )),
                    new Length(array(
                        'min' => 11,
                        'max' => 11
                    )),
                    new Callback(array(
                        'callback' => function ($value, ExecutionContext $context) use ($container) {
                            $user = $container->get('doctrine')->getRepository('AppBundle:User')
                                ->findOneBy(['phone' => $value]);

                            if (!($user instanceof User)) {
                                $context->buildViolation('The phone entered is not exists')
                                    ->atPath('phone')
                                    ->addViolation();
                            }
                        }
                    ))
                ]
            ))
            ->add('code', null, array(
                'constraints' => [
                    new NotBlank(),
                    new Type(array(
                        'type' => 'numeric'
                    )),
                    new Length(array(
                        'min' => 6,
                        'max' => 6
                    ))
                ]
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $container = $this->container;
        $resolver->setDefaults(array(
            'csrf_protection' => false
        ));
    }
}
