<?php

namespace App\Form;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Doctrine\ORM\EntityRepository;

use App\Data\SearchTransferData;
use App\Entity\Club;
use App\Entity\Poste;
use App\Entity\Season;



class SearchFormTransfer extends AbstractType {

	public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	$builder
    		->add('firstname', TextType::class, [
    			'label'    => false,
    			'required' => false, 
    			'attr'     => [
    				'class'       => 'form-control-sm',
    				'placeholder' => 'Nom de joueur'
    			]
    		])
    		->add('lastname', TextType::class, [
    			'label'    => false,
    			'required' => false, 
    			'attr'     => [
    				'class'       => 'form-control-sm',
    				'placeholder' => 'Prénom de joueur'
    			]
    		])
            ->add('from_club', EntityType::class, [
                'label'        => false,
                'required'     => false,
                'class'        => Club::class,
                'choice_label' => 'name',
                'multiple'     => false,
                'expanded'     => false,
                'query_builder' => function(EntityRepository $er){
                    return $er->createQueryBuilder('c')
                              ->orderBy('c.name', 'ASC');
                },
                'placeholder' => 'Club de départ',
                'attr' => [
                    'class' => 'form-control-sm'
                ]
            ])
            ->add('to_club', EntityType::class, [
                'class'        => Club::class,
                'choice_label' => 'name',
                'placeholder' => 'Club d\' arrivé',
                'query_builder' => function(EntityRepository $er){
                    return $er->createQueryBuilder('c')
                              ->orderBy('c.name', 'ASC');
                },
              'required'     => false,
                'label'        => false, 
                'expanded'     => false,
                'multiple'     => false,
                'attr'         => [
                    'class' => 'form-control-sm'
                ]
            ])
            ->add('min_price', IntegerType::class, [
                'required' => false, 
                'label' => false,
                'attr' => [
                    'placeholder' => 'Prix minimum',
                    'class' => 'form-control-sm'
                ]
            ])
            ->add('max_price', IntegerType::class, [
                'required' => false, 
                'label' => false,
                'attr' => [
                    'placeholder' => 'Prix maximum',
                    'class' => 'form-control-sm'
                ]
            ])
            ->add('season', EntityType::class, [
                'required' => false, 
            	'class' => Season::class,
            	'choice_label' => 'season',
            	'label' => false,
            	'placeholder' => 'Choisir une saison',
            	'attr' => [
            		'class' => 'form-control-sm'
            	]
            ])
            ;

    }

	public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SearchTransferData::class,
            'method' => 'GET',
            'csrf_protection' => false
        ]);
    }

    public function getBlockPrefix()
    {

    	return ''; //Eviter le prefix sur le nom des objets du formulaire
    }
}