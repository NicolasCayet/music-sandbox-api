<?php

namespace App\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SingleType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', null, array('label' => 'label.firstname'))
            ->add('name', null, array('label' => 'label.lastname'))
            ->add('birthday', 'birthday', array(
                'label' => 'label.birthday', 'years' => range(date('Y'), 1950)
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\CoreBundle\Entity\Single'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return new ArtistType();
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'app_admin_single';
    }
}
