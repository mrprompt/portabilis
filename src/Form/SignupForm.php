<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;

final class SignupForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'required' => true,
            ])
            ->add('email', EmailType::class, [
                'required' => true,
                'attr' => [
                    'class' => 'form-control'
                ],
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'required' => true,
                'options' => [
                    'attr' => ['class' => 'password-field form-control']
                ],
                'first_options'  => ['label' => 'Password'],
                'second_options' => ['label' => 'Repeat Password'],
            ])
            ->add('document_cpf', TextType::class, [
                'attr' => [
                    'class' => 'form-control cpf',
                ],
                'required' => true,
                'label' => 'CPF',
            ])
            ->add('document_rg', TextType::class, [
                'attr' => [
                    'class' => 'form-control rg'
                ],
                'required' => true,
                'label' => 'RG'
            ])
            ->add('phone_number', TextType::class, [
                'attr' => [
                    'class' => 'form-control sp_celphones'
                ],
                'required' => true,
                'label' => 'Phone number'
            ])
            ->add('birthday', BirthdayType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'required' => true,
                'label' => 'Birthday',
                'format' => 'dd/MM/yyyy',
            ])
            ->add(
                'save',
                SubmitType::class, [
                    'label' => 'Save',
                    'attr' => [
                        'class' => 'btn btn-primary'
                    ],
                ]
            )
        ;
    }
}
