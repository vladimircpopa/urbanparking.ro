<?php
/**
 * Created by PhpStorm.
 * User: Winnetou
 * Date: 2017-09-22
 * Time: 23:54
 */

namespace AppBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationType extends AbstractType {
    /**
     * {@inheritdoc}
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('parking_id')
            ->add('start_time', null, array(
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd HH:mm',
            ))
            ->add('end_time', null, array(
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd HH:mm',
            ))
        ;
    }

    /**
     * {@inheritdoc}
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Reservation',
            'csrf_protection' => false,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'reservation';
    }
}
