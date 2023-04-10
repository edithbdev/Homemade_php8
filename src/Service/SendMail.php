<?php

namespace App\Service;

/**
 * L'envoi de mail
 */
 
class SendMail
{ 
    /**
     * Envoi un mail
     *
     * @param string $to l'adresse mail du destinataire
     * @param string $subject le sujet du mail
     * @param string $message le message du mail
     * @param string $from l'adresse mail de l'expéditeur
     * @return boolean true si l'envoi a réussi, false sinon
     */
    public static function send(string $to, string $subject, string $message, string $from ='no-reply@homemade'): bool
    {
        define('MAIL_HOST', $_ENV['MAIL_HOST']);
        define('MAIL_PORT', $_ENV['MAIL_PORT']);
        define('MAIL_USERNAME', $_ENV['MAIL_USERNAME']);
        define('MAIL_PASSWORD', $_ENV['MAIL_PASSWORD']);
        define('MAIL_ENCRYPTION', $_ENV['MAIL_ENCRYPTION']);
        

        $transport = (new \Swift_SmtpTransport(MAIL_HOST, MAIL_PORT, MAIL_ENCRYPTION))
            ->setUsername(MAIL_USERNAME)
            ->setPassword(MAIL_PASSWORD);

        $mailer = new \Swift_Mailer($transport);

        $message = (new \Swift_Message($subject))
            ->setFrom([$from => 'Homemade'])
            ->setTo([$to])
            ->setBody($message, 'text/html');

        return $mailer->send($message) > 0;
    }
}