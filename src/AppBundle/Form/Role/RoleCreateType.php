<?php

namespace AppBundle\Form\Role;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Form\Param\RoleParamType;

/**
 * Form for creating role.
 *
 * @author homelleon
 */
class RoleCreateType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('name', TextType::class, [
                    'label' => 'Название: '
                ])
                ->add('role', RoleParamType::class, [
                    'label' => 'Роль: '
                ])
                ->add('submit', SubmitType::class, [
                    'label' => 'Применить'
                ])
        ;
    }

}
