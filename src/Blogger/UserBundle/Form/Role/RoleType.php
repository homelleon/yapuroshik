<?php

namespace Blogger\UserBundle\Form\Role;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * Description of RoleType
 *
 * @author homelleon
 */
class RoleType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('name',TextType::class, [
                'label' => 'Название: '
            ])
            ->add('role',TextType::class, [
                'label' => 'Роль: '
            ])
            ->add('submit',SubmitType::class, [
                'label' => 'Применить'
            ])            
        ;             
    }
}
