<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;

final class LoginForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'required' => true,
                'constraints' => [
                    new Email(),
                    new NotBlank([
                        'groups' => ['Default', 'Edit']
                    ]),
                ],
                'attr' => [
                    'class' => 'form-control'
                ],
            ])
            ->add('password', PasswordType::class, [
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'groups' => ['Default', 'Password']
                    ])
                ],
                'attr' => [
                    'class' => 'password-field form-control'
                ]
            ])
            ->add(
                'login',
                SubmitType::class, [
                    'label' => 'Login',
                    'attr' => [
                        'class' => 'btn btn-primary'
                    ],
                ]
            )
        ;
    }
}
