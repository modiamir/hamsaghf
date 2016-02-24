<?php

namespace AppBundle\Form;

use Faker\Provider\Image;
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

class HouseholderType extends AbstractType
{
    /**
     * HouseholderType constructor.
     *
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

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
                        'max' => 3
                    ])
                ],
                'label' => 'مناطق'
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
            ->add('dimension', null , [
                'label' => 'متراژ'
            ])
            ->add('startDate', TextType::class, [
                'label' => 'تاریخ دسترسی'
            ])
            ->add('dueDate', TextType::class, [
                'label' => 'تاریخ پایان دسترسی'
            ])
//            ->add('photos', CollectionType::class, array(
//                'entry_type' => ImageType::class,
//                'label' => 'تصاویر',
//                'allow_add'    => true,
//            ))
            ->add('jobTypes', null, [
                'choice_label' => 'name',
                'attr' => ['class' => 'ui fluid search dropdown'],
                'constraints' => [
                    new Count([
                        'min' => 1,
                        'max' => 3
                    ])
                ],
                'label' => 'شغل'
            ])
            ->add('smoker', ChoiceType::class, array(
                'choices'  => array(
                    'no' => 'ممنوع',
                    'yes' => 'آزاد',
                ),
                'expanded' => true,
                'multiple' => false,
                'label' => 'سیگار',
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
            ->add('guest', ChoiceType::class, array(
                'choices'  => array(
                    'limited' => 'محدود',
                    'free' => 'آزاد',
                ),
                'expanded' => true,
                'multiple' => false,
                'label' => 'وضعیت میهمان',
            ))
            ->add('ageRanges', null, [
                'attr' => ['class' => 'ui fluid search dropdown'],
                'constraints' => [
                    new Count([
                        'min' => 1,
                        'max' => 3
                    ])
                ],
                'label' => 'رنج سنی'
            ])
            ->add('features', null, [
                'attr' => ['class' => 'ui fluid search dropdown'],
                'choice_label' => 'title',
                'label' => 'امکانات'
            ])
            ->add('description', null, [
                'label' => 'توضیحات',
                'constraints' => [
                    new NotBlank()
                ]
            ])
            ->add('photos', HiddenType::class)
        ;

//        $builder->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent  $event) {
//            $form = $event->getForm();
//
//            $form->add('photos', null, [
//                'choice_label' => 'id',
//            ]);
//        });
//
//        $builder->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent  $event) {
//            $form = $event->getForm();
//
//            if ($form->has('photos')) {
//                $form->remove('photos');
//            }
//        });

        $jDateTransformer = new CallbackTransformer(
        // transform <br/> to \n so the textarea reads easier
            function ($originalDate) {
                if ($originalDate instanceof \DateTime )
                {
                    $jDate = $this->container->get('symfony_persia.jdate');
                    $jArray = $jDate->toJalali($originalDate->format('Y'),$originalDate->format('n'), $originalDate->format('j'));

                    return implode('/', $jArray);
                } else {
                    return $originalDate;
                }
            },
            function ($submittedDate ) {
                if ($submittedDate != null ) {
                    $jDate = $this->container->get('symfony_persia.jdate');

                    list($y, $m, $d) = explode('/', $submittedDate );
                    $gArray = $jDate->toGregorian($y, $m, $d);

                    return new \DateTime("$gArray[0]-$gArray[1]-$gArray[2]");
                } else {
                    return $submittedDate;
                }

            }
        );

        $photosTransformer = new CallbackTransformer(
        // transform <br/> to \n so the textarea reads easier
            function ($originalData) {
                if (!$originalData) {
                    return "";
                }

                /* @var $iterator \ArrayIterator */
                $iterator = $originalData->getIterator();

                $val = '';
                while($iterator->valid()) {
                    $val .= $iterator->current()->getId() . ',';

                    $iterator->next();
                }
                return substr($val, 0, strlen($val) - 1);
            },
            function ($submittedData) {
                $ids = explode(',', $submittedData);

                $doctrine = $this->container->get('doctrine');
                $col = new ArrayCollection($doctrine->getRepository('AppBundle:Image')->findBy(['id' => $ids]));

                return $col;
            }
        );

        $builder->get('photos')->addModelTransformer($photosTransformer);

        $builder->get('startDate')
            ->addModelTransformer($jDateTransformer)
        ;
        $builder->get('dueDate')
            ->addModelTransformer($jDateTransformer)
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Householder'
        ));
    }

    public function getName()
    {
        return 'householder';
    }
}
