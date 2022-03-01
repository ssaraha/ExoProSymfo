<?php

namespace App\Form;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Doctrine\ORM\EntityRepository;

use App\Data\SearchPlayerData;
use App\Entity\Club;
use App\Entity\Poste;

class SearchFormPlayer extends AbstractType 
{
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
            ->add('club', EntityType::class, [
                'label'        => false,
                'required'     => false,
                'class'        => Club::class,
                'choice_label' => 'name',
                'multiple'     => true,
                'expanded'     => true,
                'attr' => [
                    'class' => 'form-control-sm'
                ]
            ])
            ->add('poste', EntityType::class, [
                'class'        => Poste::class,
                'choice_label' => 'name',
                'query_builder' => function(EntityRepository $er){
                    return $er->createQueryBuilder('p')
                              ->orderBy('p.name', 'ASC');
                },
                'label'        => false, 
                'required'     => false,
                'expanded'     => false,
                'multiple'     => true,
                'attr'         => [
                    'class' => 'form-control-sm select-poste'
                ]
            ])
            ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SearchPlayerData::class,
            'method' => 'GET',
            'csrf_protection' => false
        ]);
    }

    public function getBlockPrefix()
    {

    	return ''; //Eviter le prefix sur le nom des objets du formulaire
    }
}