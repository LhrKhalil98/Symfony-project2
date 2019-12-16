<?php

namespace App\Form;

use App\Entity\Livre;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LivreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', TextType::class , [
                'attr' => [  'class' => 'form-control']
            ])
            ->add('edition', TextType::class , [
                'attr' => [  'class' => 'form-control']
            ])
            ->add('num_edition', TextType::class , [
                'attr' => [  'class' => 'form-control']
            ])
            ->add('prix', TextType::class , [
                'attr' => [  'class' => 'form-control']
            ])
            ->add('description' , TextType::class , [
                'attr' => [  'class' => 'form-control']
            ])
            ->add('imageUrl', TextType::class , [
                'attr' => [  'class' => 'form-control']
            ])
            ->add('auteur' , EntityType::class , [
                'placeholder' => 'Auteur ',
                'class' => 'App\Entity\Auteur',
                'choice_label' => 'nom_prenom' ,
                'attr' => [  'class' => 'form-control']
            ]
            )
            ->add('categorie'  ,EntityType::class , [
                'placeholder' => 'Categorie ',
                'class' => 'App\Entity\Categorie',
                'choice_label' => 'nom_categorie' ,
                'attr' => [  'class' => 'form-control']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Livre::class,
        ]);
    }
}
