<?php

namespace App\Infrastructure\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LoginFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', EmailType::class, [
                'label' => 'Email',
                'attr'  => ['class' => 'shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline'],
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Mot de passe',
                'attr'  => ['class' => 'shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline'],
            ])
            ->add('_csrf_token', HiddenType::class) // Champ CSRF token
            ->add('submit', SubmitType::class, [
                'label' => 'Se connecter',
                'attr'  => ['class' => 'bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline hover:bg-blue-700'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'csrf_protection' => true,
            'csrf_field_name' => '_csrf_token',
            'csrf_token_id'   => 'authenticate',
            'compound'        => true,  // Ensure the form is compound
            'data_class'      => null,  // If the form is not bound to a specific entity class
        ]);
    }

    // To remove the prefix entirely, you can override the getBlockPrefix method
    public function getBlockPrefix(): string
    {
        return ''; // This ensures no prefix will be added
    }
}
