<?php

namespace Blogger\UserBundle\Form\Param;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

/**
 * Description of RoleType
 *
 * @author Админ
 */
class RoleParamType extends AbstractType {
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'choices' => [
                'пользователь' => 'ROLE_USER',
                'редактор' => 'ROLE_EDITOR',
                'админ' => 'ROLE_ADMIN',
                'супер-админ' => 'ROLE_SUPER_ADMIN'
            ]
        ]);
    }
    
    public function getParent() {
        return ChoiceType::class;
    }
}
