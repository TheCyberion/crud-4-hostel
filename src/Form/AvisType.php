<?php

namespace App\Form;

use App\Entity\Commentaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class AvisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('email')
            ->add('content')
            // ->add('date_enregistrement')
            ->add('categorie', ChoiceType::class, [
                'choices' => [
                    'Hôtel'=>'Hôtel',
                    'Chambres' =>'Chambres',
                    'Restaurant' =>'Restaurant',
                    'Spas' => 'Spas'
           ] 
           ])

            ->add('note', ChoiceType::class,[
                'choices' => range(0,5,1)
            ])

            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commentaire::class,
        ]);
    }
}
