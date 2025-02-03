<?php

namespace App\Infrastructure\Form;

use App\Domain\Entity\Specialist;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SpecialistType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', TextType::class, [
                'label' => false,
            ])
            ->add('lastName', TextType::class, [
                'label' => false,
            ])
            ->add('code', IntegerType::class, [
                'label'    => false,
                'required' => true,
            ])
            ->add('email', EmailType::class, [
                'label'    => false,
                'required' => false,
            ])
            ->add('mobile', TelType::class, [
                'label'    => false,
                'required' => false,
            ])
            ->add('city', TextType::class, [
                'label'    => false,
                'required' => false,
            ])
            ->add('online', CheckboxType::class, [
                'required' => false,
                'attr'     => ['class' => 'form-check-input'],
                'label'    => false,
            ])
            ->add('description', TextareaType::class, [
                'label'    => false,
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Specialist::class,
        ]);
    }
}
