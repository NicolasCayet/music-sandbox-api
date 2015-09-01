<?php

namespace App\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AlbumType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', null, array('label' => 'label.title'))
            ->add('releaseDate', 'birthday', array(
                'years' => range(date('Y'), 1950),
                'label' => 'label.release_date'
            ))
            ->add('artists', null, array('label' => 'label.artists'))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\CoreBundle\Entity\Album'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'app_admin_album';
    }
}
