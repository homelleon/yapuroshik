<?php

namespace AppBundle\Form\User;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

/**
 * Description of UserType
 *
 * @author homelleon
 */
class UserType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('username',TextType::class, [
                'label' => 'Логин: '
            ])
            ->add('password',RepeatedType::class, [
                'label' => 'Пароль: ',
                'type' => PasswordType::class,
                'first_options'  => array('label' => 'Пароль: '),
                'second_options' => array('label' => 'Пароль еще раз: '),
            ])               
            ->add('email',EmailType::class, [
                'label' => 'Электронный адрес: '
            ])
            ->add('submit',SubmitType::class, [
                'label' => 'Применить'
            ])            
        ;             
    }
}
