<?php

namespace Blogger\BlogBundle\Form\Comment;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * Description of ArticleType
 *
 * @author Админ
 */
class CommentType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder           
            ->add('content',TextareaType::class, [
                'label' => 'Комментарий: '
            ])
            ->add('submit',SubmitType::class, [
                'label' => 'Применить'
            ])            
        ;             
    }
}
