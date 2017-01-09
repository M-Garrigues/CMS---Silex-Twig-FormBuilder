<?php

namespace fc\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class EntryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array('label' => 'Nom'))
            ->add('url', 'text', array('label' => "Url"))
            ->add('content', 'textarea', array('label' => "Contenu"))
            ;
    }

    public function getName()
    {
        return 'entree';
    }
}