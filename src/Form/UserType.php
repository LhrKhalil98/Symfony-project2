<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        
            ->add('prenom', TextType::class ,[
                'attr' => ['placeholder' => 'Nom '],
                
            ])
            ->add('nom',TextType::class ,[
                
                'attr' => ['placeholder' => 'Nom de Famille']
            ])
            ->add('CIN', IntegerType::class ,[
                
                'attr' => ['placeholder' => 'Numero Carte Identite national ']
            ])
            ->add('email' , EmailType::class ,[
                
                'attr' => ['placeholder' => 'Email']
            ])
            ->add('password' ,  PasswordType::class ,[
                
                'attr' => ['placeholder' => 'Mot De Passe' ,
                           ]
            ])   
            ->add('adress',TextType::class ,[
                
                'attr' => ['placeholder' => 'Adress Domicile']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
