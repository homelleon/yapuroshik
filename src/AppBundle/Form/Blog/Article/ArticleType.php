<?php

namespace AppBundleForm\Blog\Article;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * Description of ArticleType
 *
 * @author Админ
 */
class ArticleType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('title',TextType::class, [
                'label' => 'Название: '
            ])
            ->add('theme',TextType::class, [
                'label' => 'Тема: '
            ])           
            ->add('image', FileType::class, [
                'label' => 'Изображение (JPG формат)',
                'data_class' => null,
                'required' => false
            ])
            ->add('description',TextareaType::class, [
                'label' => 'Описание: '
            ])
            ->add('submit',SubmitType::class, [
                'label' => 'Подтвердить'
            ])            
        ;             
    }
}
