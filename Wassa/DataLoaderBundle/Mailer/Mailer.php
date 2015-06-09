<?php
/*
 * Mailer.php
 *
 * Copyright (C) WASSA SAS - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 *
 * 09/06/2015
 */

namespace Wassa\DataLoaderBundle\Mailer;

use Symfony\Bundle\TwigBundle\TwigEngine;

class Mailer
{
    protected $mailer;
    protected $twigEngine;

    public function __construct(\Swift_Mailer $mailer, TwigEngine $twigEngine)
    {
        $this->mailer = $mailer;
        $this->twigEngine = $twigEngine;
    }

    public function sendMail($result, $from, $to, $subject = 'Data load report')
    {
        $message = \Swift_Message::newInstance()
            ->setSubject($subject)
            ->setFrom($from)
            ->setTo($to);

        $viewParams = ['result' => $result];

        $message
            ->setBody($this->twigEngine->render('WassaDataLoaderBundle:Email:email_body.txt.twig', $viewParams))
            ->addPart($this->twigEngine->render('WassaDataLoaderBundle:Email:email_body.html.twig', $viewParams), 'text/html');

        $mailer = $this->mailer->send($message);
    }
}