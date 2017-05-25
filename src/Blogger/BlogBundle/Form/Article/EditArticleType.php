<?php

namespace Blogger\BlogBundle\Form\Article;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Blogger\BlogBundle\Form\Article\ArticleType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
/**
 * Description of EditArticleType
 *
 * @author Админ
 */
class EditArticleType extends ArticleType {
    public function buildForm(FormBuilderInterface $builder, array $options) {   
        parent::buildForm($builder,$options);
        $builder
            ->remove('submit')
            ->add('is_deleted',CheckboxType::class, [
                'label' => 'Удалить',
                'required' => false
            ])
            ->add('submit',SubmitType::class, [
                'label' => 'Подтвердить'
            ]) 
        ;             
    }
}
