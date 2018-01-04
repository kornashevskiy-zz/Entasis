<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 04.01.18
 * Time: 10:49
 */

namespace EntasisBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, [
                'label' => 'Имя',
                'label_attr' => ['class' => 'control-label'],
                'attr' => ['class' => 'form-control'],
                'required' => false,
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email *',
                'label_attr' => ['class' => 'control-label'],
                'attr' => ['class' => 'form-control'],
                'required' => true,
            ])
            ->add('message', TextareaType::class, [
                'label' => 'Текст сообщения *',
                'label_attr' => ['class' => 'control-label'],
                'attr' => ['class' => 'form-control', 'rows' => 6],
                'required' => true,
            ]);
    }
}