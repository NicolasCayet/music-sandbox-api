<?php

namespace App\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BandType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, array('label' => 'label.name'))
            ->add('formedDate', 'birthday', array(
                'label' => 'label.formed_date',
                'years' => range(date('Y'), 1950)
            ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\CoreBundle\Entity\Band'
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
        return 'app_admin_band';
    }
}
