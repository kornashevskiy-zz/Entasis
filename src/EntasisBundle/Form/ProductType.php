<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 03.01.18
 * Time: 10:34
 */

namespace EntasisBundle\Form;


use EntasisBundle\Entity\Category;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ruName', null, [
                'attr' => ['class' => 'form-control'],
                'required' => true,
                'label' => 'Название (ru)'
            ])
            ->add('ruDescription', CKEditorType::class, [
                'config_name' => 'my_config',
                'label' => 'Описание (ru)',
                'required' => false
            ])
            ->add('enName', null, [
                'attr' => ['class' => 'form-control'],
                'required' => true,
                'label' => 'Title (en)'
            ])
            ->add('enDescription', CKEditorType::class, [
                'config_name' => 'my_config',
                'label' => 'Description (en)',
                'required' => false
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'ruName',
                'attr' => ['class' => 'form-control'],
                'required' => true,
                'placeholder' => 'категория'
            ])
            ->add('titleImage', FileType::class, [
                'label' => 'Титульное изображение',
                'required' => true,
            ])
            ->add('images', FileType::class, [
                'label' => 'Изображения',
                'required' => false,
                'multiple' => true,
            ]);
    }
}