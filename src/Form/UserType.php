<?php

namespace App\Form;

use App\Entity\SonataUserUser;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class)
            ->add('username', TextType::class)
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => ['label' => 'Password'],
                'second_options' => ['label' => 'Confirm Password']
            ])
//            ->add('lastLogin')
//            ->add('confirmationToken')
//            ->add('passwordRequestedAt')
//            ->add('roles')
//            ->add('createdAt')
//            ->add('updatedAt')
//            ->add('dateOfBirth')
//            ->add('firstname')
//            ->add('lastname')
//            ->add('website')
//            ->add('biography')
//            ->add('gender')
//            ->add('locale')
//            ->add('timezone')
//            ->add('phone')
//            ->add('facebookUid')
//            ->add('facebookName')
//            ->add('facebookData')
//            ->add('twitterUid')
//            ->add('twitterName')
//            ->add('twitterData')
//            ->add('gplusUid')
//            ->add('gplusName')
//            ->add('gplusData')
//            ->add('token')
//            ->add('twoStepVerificationCode')
//            ->add('groups')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SonataUserUser::class,
        ]);
    }
}
