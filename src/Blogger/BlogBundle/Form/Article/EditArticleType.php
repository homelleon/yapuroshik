<?php

namespace Blogger\BlogBundle\Form\Article;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Blogger\BlogBundle\Form\Article\ArticleType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
/**
 * Description of EditArticleType
 *
 * @author Админ
 */
class EditArticleType extends ArticleType {
    public function buildForm(FormBuilderInterface $builder, array $options) {   
        parent::buildForm($builder,$options);
        $builder
            ->add('is_deleted',CheckboxType::class, [
                'label' => 'Удалить',
                'required' => false
            ]) 
        ;             
    }
}
