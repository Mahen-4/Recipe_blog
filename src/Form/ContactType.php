<?php

namespace App\Form;

use App\DTO\ContactDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'required' => true,
                'empty_data' => ''
            ])
            ->add('email', EmailType::class, [
                'required' => true,
                'empty_data' => ''
            ])
            ->add('services', ChoiceType::class, [
                'choices' => [
                    'IT' => 'it@gmail.com',
                    'RH' => 'rh@gmail.com',
                    'CM' => 'cm@gmail.com',
                ]
            ])
            ->add('message', TextareaType::class, [
                'required' => true,
                'empty_data' => ''
            ])
            ->add('send', SubmitType::class, [
                'label' => 'Send'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ContactDTO::class
        ]);
    }
}
