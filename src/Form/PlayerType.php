<?php

namespace App\Form;

use App\Entity\Player;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Repository\ClubRepository;
use App\Repository\PosteRepository;

use Vich\UploaderBundle\Form\Type\VichImageType;

use App\Entity\Club;
use App\Entity\Poste;

class PlayerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('imageFile', VichImageType::class, [
                'required' => false,
                'allow_delete' => true,
                'delete_label' => '...',
                'download_label' => '...',
                'download_uri' => true,
                //'image_uri' => true,
                'imagine_pattern' => 'square_thumbnail_small',
                //'asset_helper' => true,
            ])
            ->add('firstname', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Votre prénom',
                    'class' => 'form-control-sm'
                ]
            ])
            ->add('lastname', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Votre nom',
                    'class' => 'form-control-sm'
                ]
            ])
            ->add('birthday', DateType::class, [
                'label' => false,
                'widget' => 'single_text', 
                'attr' => [
                    'class' => 'input-date  form-control-sm',
                    'placeholder' => 'yyyy/dd/mm'
                ],
                'empty_data' => null
            ])
            ->add('size', IntegerType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Votre taille en cm',
                    'class' => 'form-control-sm'
                ]
            ])
            ->add('weight', IntegerType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Votre poids en kg',
                    'class' => 'form-control-sm'
                ]
            ])
            ->add('nationality', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Votre nationalité',
                    'class' => 'form-control-sm'
                ]
            ])
            //->add('createdAt')
            //->add('updatedAt')
            ->add('club', EntityType::class, [
                'label' => false,
                'placeholder' => 'Veuillez choisser un club',
                'class' => Club::class,
                'query_builder' => function(ClubRepository $cr){
                    return $cr->createQueryBuilder('c')
                              ->orderBy('c.name', 'ASC');
                },
                'choice_label' => 'name',
                'attr' => [
                    'class' => 'form-control-sm'
                ]
            ])
            ->add('poste', EntityType::class, [
                'label' => false,
                'placeholder' => 'Veuillez choisser un poste',
                'class' => Poste::class,
                'query_builder' => function(PosteRepository $pr){
                    return $pr->createQueryBuilder('p')
                              ->orderBy('p.name', 'ASC');
                },
                'choice_label' => 'name',
                'attr' => [
                    'class' => 'form-control-sm'
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Player::class,
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
