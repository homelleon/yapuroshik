<?php

namespace Blogger\UserBundle\Form\Param;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

/**
 * Description of GenderType
 *
 * @author Админ
 */
class GenderType extends AbstractType {
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'choices' => [
                'М' => 'Мужчина',
                'Ж' => 'Женщина'
            ]
        ]);
    }
    
    public function getParent() {
        return ChoiceType::class;
    }
}
