<?php

namespace App\Utility;

use App\ApplicationParams;
use Safe\Exceptions\JsonException;
use Yiisoft\Aliases\Aliases;
use Yiisoft\Http\Status;
use Yiisoft\Mailer\File;
use Yiisoft\Mailer\MailerInterface;
use Yiisoft\Mailer\Message;

class MailUtility
{
    function __construct(
        private ApplicationParams $applicationParams,
        private MailerInterface $mailer
    ){}

    public function sendMail(
        array $toEmails,
        string $content,
        string $subject,
        string $contentType = 'text/plain',
        ?string $attachment = null
    ): void {

        // Redirect logic
        if ($this->applicationParams->enableRedirect) {
            $originalRecipients = implode(';', $toEmails);

            if ($contentType === 'text/html') {
                $content .= "<br><br>Real sender: {$originalRecipients}";
            } else {
                $content .= "\n\nReal sender: {$originalRecipients}";
            }

            $toEmails = $this->applicationParams->redirectEmail
                ?: [$this->applicationParams->fallbackEmail];
        }

        $message = (new Message())
            ->withTo($toEmails)
            ->withSubject($subject)
            ->withFrom($this->applicationParams->adminEmail);

        if ($contentType === 'text/html') {
            $message = $message->withHtmlBody($content);
        } else {
            $message = $message->withTextBody($content);
        }

        if ($attachment !== null && file_exists($attachment)) {
            $message = $message->withAttachments(
                File::fromPath($attachment),
            );
        }

        $this->mailer->send($message);
    }
}
