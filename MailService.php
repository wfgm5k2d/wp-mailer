<?php

use PHPMailer\PHPMailer\PHPMailer;

/**
 * Декоратор PHPMailer
 */
class MailService
{
    protected string $sHost = 'smtp.yandex.ru';
    protected int $nPort = 25;
    protected string $sUsername = 'mail@example.com';
    protected string $sPassword = 'Your password';
    protected ?object $obMail = null;
    protected string $sFromName = 'Sender';
    protected string $sTo = '';

    /**
     * @throws \PHPMailer\PHPMailer\Exception
     */
    public function __construct()
    {
        $this->obMail = new PHPMailer();
        $this->obMail->isSMTP();
        $this->obMail->SMTPAuth = true;
        $this->obMail->SMTPDebug = 0;

        $this->obMail->Host = $this->sHost;
        $this->obMail->Port = $this->nPort;
        $this->obMail->Username = $this->sUsername;
        $this->obMail->Password = $this->sPassword;

        $this->obMail->IsHTML = true;
        $this->obMail->CharSet = 'UTF-8';
        $this->obMail->ContentType = 'text/plain;';

        $this->obMail->setFrom($this->sUsername, $this->sFromName);
    }

    public static function load(): MailService
    {
        return new MailService();
    }

    /**
     * @throws \PHPMailer\PHPMailer\Exception
     */
    public function setFrom($from, $fromName = ''): MailService
    {
        $this->obMail->setFrom($from, $fromName);

        return $this;
    }

    /**
     * @throws \PHPMailer\PHPMailer\Exception
     */
    public function setTo($to): MailService
    {
        if (is_array($to)) {
            foreach ($to as $address) {
                $this->obMail->addAddress($address);
                $this->sTo .= trim($address . ',', ',');
            }
        } else {
            $this->obMail->addAddress($to);
            $this->sTo = $to;
        }

        return $this;
    }

    public function setSubject($subject): MailService
    {
        $this->obMail->Subject = $subject;

        return $this;
    }

    public function setBody($body): MailService
    {
        $this->obMail->Body = $body;

        return $this;
    }

    /**
     * @throws \PHPMailer\PHPMailer\Exception
     */
    public function setHeaders($additionalHeaders = []): MailService
    {
        if (!empty($additionalHeaders)) {
            foreach ($additionalHeaders as $name => $value) {
                $this->obMail->addCustomHeader($name, $value);
            }
        }

        return $this;
    }

    /**
     * @throws \PHPMailer\PHPMailer\Exception
     */
    public function send(): bool
    {
        return $this->obMail->send();
    }
}