<?php

namespace fc\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	$builder->add('title', 'text', array('label'=>'Titre : '));

        $builder->add('content', 'textarea', array('label'=>'Contenu : '));

        $builder->add('date', 'date', array(
		    'placeholder' => array(
    		    'year' => 'Year', 'month' => 'Month', 'day' => 'Day'
    		),
            'format' => 'yyyy-MM-dd'
		));

		$builder->add('kwConv', 'textarea', array(
		'label'=>'Mots-Clés : '
		));
    }

    public function getName()
    {
        return 'article';
    }
}