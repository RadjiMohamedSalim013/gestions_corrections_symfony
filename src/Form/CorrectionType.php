<?php

namespace App\Form;

use App\Entity\Correction;
use App\Entity\Epreuve;
use App\Entity\Professeur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CorrectionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date')
            ->add('nbrCopie')
            ->add('professeur', EntityType::class, [
                'class' => Professeur::class,
                'choice_label' => 'id',
            ])
            ->add('epreuve', EntityType::class, [
                'class' => Epreuve::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Correction::class,
        ]);
    }
}
