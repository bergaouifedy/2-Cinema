<?php

namespace App\Form;

use App\Entity\Annonces;
use App\Entity\Demande;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DemandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('datetournage', DateType::class, [
                // renders it as a single text box
                'widget' => 'single_text',
            ])
            ->add('duree')
            ->add('nombreeffectif')
            ->add('description')
            ->add('nomsociete')
            ->add('annonce',EntityType::class, [
                'class' => Annonces::class,
                // this method must return an array of User entities
                'choice_label' => 'titre',
                'multiple' => false,
                ])        
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Demande::class,
        ]);
    }
}
