<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 04.01.18
 * Time: 11:09
 */

namespace EntasisBundle\Service\Email;


use Symfony\Component\Form\FormInterface;

abstract class EmailService
{
    protected $mailer;
    protected $twig;
    const EMAIL_BOX = 'entasisby@gmail.com';

    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $twig)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
    }

    abstract public function send(FormInterface $form);
}