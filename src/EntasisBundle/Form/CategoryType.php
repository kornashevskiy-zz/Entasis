<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 28.12.17
 * Time: 14:57
 */

namespace EntasisBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ruName', null, [
                'required' => true,
                'label' => 'Имя категории (ru)',
                'attr' => ['class' => 'form-control']
            ])
            ->add('enName', null, [
                'required' => true,
                'label' => 'Category name (en)',
                'attr' => ['class' => 'form-control']
            ]);
    }
}