<?php
namespace App\Manager;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;


class PlatoManager {

   protected MailerInterface $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }


   public function load (UploadedFile $file, string $destino){
        $fileName = uniqid().'.'.$file -> guessClientExtension();
        $file -> move( $destino, $fileName );
        return $fileName;
   }

   public function sendmail(string $texto)
   {
       $email = (new Email())
           ->from('javier.sánchez@gmail.com')
           ->to('ana.castellanos.sanz@gmail.com')
           //->cc('cc@example.com')
           //->bcc('bcc@example.com')
           //->replyTo('fabien@example.com')
           //->priority(Email::PRIORITY_HIGH)
           ->subject('Esto es un email de Symfony')
           ->text($texto)
           ->html($texto);

       $this->mailer->send($email);
   }

}
