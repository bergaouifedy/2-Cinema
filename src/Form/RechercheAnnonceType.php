<?php

namespace App\Form;

use App\Entity\RechercheAnnonce;
use Doctrine\DBAL\Types\StringType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RechercheAnnonceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('ville',ChoiceType::class, array(
            'choices'  => array(
                '-Choisir-' => null,
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
         ->add('maxPrix', IntegerType::class, [
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' =>'budget maximal'
                ]
            ])        

            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RechercheAnnonce::class,
            'method' =>'get',
            'csrf_protection' => false,
        ]);
    }

}
