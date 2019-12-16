<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdminType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
     
        ->add('prenom', TextType::class ,[
            'attr' => ['placeholder' => 'Nom ' , 'class' => 'form-control'],
            
        ])
        ->add('email' , EmailType::class ,[
            
            'attr' => ['placeholder' => 'Email' , 'class' => 'form-control']
        ])
        ->add('password' ,  PasswordType::class ,[
            
            'attr' => ['placeholder' => 'Mot De Passe'  , 'class' => 'form-control']
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
