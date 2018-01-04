<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 04.01.18
 * Time: 11:18
 */

namespace EntasisBundle\Service\Email;



use Symfony\Component\Form\FormInterface;

class ContactMailer extends EmailService
{
    public function send(FormInterface $form)
    {
        $data = $form->getData();

        $message = (new \Swift_Message('Письмо от Entasis'))
            ->setFrom(self::EMAIL_BOX)
            ->setTo(self::EMAIL_BOX)
            ->setBody(
                $this->twig->render('@Entasis/email/contact_email.html.twig', [
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'message' => $data['message']
                ]),
                'text/html'
            );

        return $this->mailer->send($message);
    }
}