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
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;

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
                'constraints' => [
                    new NotBlank([
                        'groups' => ['Default', 'Edit']
                    ])
                ],
                'invalid_message' => 'The name field is invalid.',
            ])
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
                'invalid_message' => 'The password field is invalid.',
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'groups' => ['Default', 'Password']
                    ])
                ],
                'invalid_message' => 'The password fields must match.',
                'options' => [
                    'attr' => ['class' => 'password-field form-control']
                ],
                'first_options'  => ['label' => 'Password'],
                'second_options' => ['label' => 'Repeat Password'],
            ])
            ->add('locale', ChoiceType::class, [
                'choices' => [
                    'Portuguese' => 'pt_BR',
                    'English' => 'en',
                ],
                'constraints' => [
                    new NotBlank([
                        'groups' => ['Default', 'Edit']
                    ])
                ],
                'attr' => [
                    'class' => 'form-control'
                ],
                'invalid_message' => 'The locale field is invalid.',
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
