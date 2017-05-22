<?php

namespace Blogger\UserBundle\Form\User;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * Description of UserAccountType
 *
 * @author homelleon
 */
class UserAccountType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('firstName',TextType::class, [
                'label' => 'Имя: ',
                'required' => false
            ])
            ->add('lastName',TextType::class, [
                'label' => 'Фамилия: ',
                'required' => false
            ])
            ->add('birthday',DateType::class, [
                'label' => 'день рождения: ',
                'required' => false
            ])
            ->add('gender',TextType::class, [
                'label' => 'пол: ',
                'required' => false
            ])           
            ->add('submit',SubmitType::class, [
                'label' => 'Применить'
            ])            
        ;             
    }
}