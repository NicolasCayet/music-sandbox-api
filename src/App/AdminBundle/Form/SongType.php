<?php

namespace App\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SongType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', null, array('label' => 'label.title'))
            ->add('duration', 'integer', array('label' => 'label.duration'))
            ->add('dailymotionUrl', 'url', array('label' => 'label.dailymotion_url'))
            ->add('releaseDate', 'birthday', array(
                'years' => range(date('Y'), 1950),
                'label' => 'label.release_date'
            ))
            ->add('artists', null, array('label' => 'label.artists'))
            ->add('album', null, array('label' => 'label.album'))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\CoreBundle\Entity\Song'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'app_admin_song';
    }
}
