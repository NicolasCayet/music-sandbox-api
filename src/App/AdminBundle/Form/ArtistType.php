<?php

namespace App\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Defines the default form managing any type of artists
 *
 * @package App\AdminBundle\Form
 */
class ArtistType extends AbstractType {
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('name') //delegate to children form because label is different
            ->add('description', 'textarea', array(
                'attr' => array('rows' => 10),
                'label' => 'label.description'
            ));
    }
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'app_admin_artist';
    }

}