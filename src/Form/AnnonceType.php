<?php

namespace App\Form;

use App\Entity\Annonces;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class AnnonceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Titre')
            ->add('Description')
            ->add('Type',ChoiceType::class,
            ['choices' => [
                'Immobilier'=>'Immobilier',
                'Villa'=>'Villa',
                'Appartement'=>'Appartement',
            ],
            ])
            ->add('Prix')
            ->add('Surface')
            ->add('CodePostal')
            ->add('NbrChambres')
            ->add('NbrEtages')
            ->add('Garage')
            ->add('Parking')
            ->add('Adresse')
            ->add('ville',ChoiceType::class, array(
                'choices'  => array(
                     'Tunis' => 'Tunis',
                    'Sfax' => 'Sfax',
                    'Sousse' => 'Sousse',
                    'Kairouen' => 'Kairouen',
                    'Bizerte'=>'Bizerte',
                    'Gabès'=>'Gabès',
                    'Ariana'=>'Ariana',
                    'Gafsa'=>'Gafsa',
                    'Monastir'=>'Monastir',
                    'Ben arous'=>'Ben arous',
                    'Kasserine'=>'Kasserine',
                    'Mednine'=>'Mednine',
                    'Nabeul'=>'Nabeul',
                    'Tataouine'=>'Tataouine',
                    'Bèja'=>'Bèja',
                    'Kef'=>'Kef',
                    'Mahdia'=>'Mahdia',
                    'Sidi bouzid'=>'Sidi bouzid',
                    'Jandouba'=>'Jandouba',
                    'Tozeur'=>'Tozeur',
                    'Manouba'=>'Manouba',
                    'Siliana'=>'Siliana',
                    'Zghouan'=>'Zghouan',
                    'Kébili'=>'Kébili'
                  
                   
                ),
                  
                 'attr' => array('class'=>'form-control','placeholder'=>'Ville','required'=>true ,'property_path' => false,
                
                  'placeholder' => 'Ville',
                 
            
                 
            
            )
            
               ))            
            ->add('Image', FileType::class,[
                'label' => false,
                'multiple' => false,
                'mapped' => false,
                'required' => false
            ])
            ->add('Media', FileType::class,[
                'label' => false,
                'multiple' => true,
                'mapped' => false,
                'required' => false
            ])
            ;
            }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Annonces::class,
        ]);
    }
}
