<?php

namespace Blogger\UserBundle\Form\Role;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * Description of UserType
 *
 * @author homelleon
 */
class UserType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('name',TextType::class, [
                'label' => 'Название: '
            ])
            ->add('password',TextType::class, [
                'label' => 'Пароль: '
            ])               
            ->add('email',TextType::class, [
                'label' => 'Электронный адрес: '
            ])
            ->add('submit',SubmitType::class, [
                'label' => 'Применить'
            ])            
        ;             
    }
}
