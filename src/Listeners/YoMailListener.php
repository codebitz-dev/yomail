<?php

namespace Codebitz\Yomail\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\File;
use Illuminate\Support\Arr;
use Codebitz\Yomail\Models\YoMail;
use Symfony\Component\Mime\MessageConverter;
use Config;


class YoMailListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {


        if(!Config::get('yomail.enabled')){ return false;  }

        $msgId = $event->message->generateMessageId();

        $email = MessageConverter::toEmail($event->message);

        //ray($email);
        //ray($event->message->getPreparedHeaders()->get('message-id'));

        $to = collect($email->getTo())->map(function ($email) {
            return ['email'=>$email->getAddress(),'name'=>$email->getName()];
        })->toArray();

        $from = collect($email->getFrom())->map(function ($email) {
            return ['email'=>$email->getAddress(),'name'=>$email->getName()];
        })->toArray();

        $cc = collect($email->getCc())->map(function ($email) {
            return ['email'=>$email->getAddress(),'name'=>$email->getName()];
        })->toArray();

        $bcc = collect($email->getBcc())->map(function ($email) {
            return ['email'=>$email->getAddress(),'name'=>$email->getName()];
        })->toArray();

        $attachments = [];
        foreach($email->getAttachments() as $attachment){
                $item = $this->attachAttachment($attachment,$msgId);
                array_push($attachments,$item);
        }


        YoMail::create([
            'message_id' => $msgId,
            'to' => $to,
            'from' => $from,
            'cc' => $cc,
            'bcc' => $bcc,
            'subject' => $email->getSubject(),
            'html' => $email->getHtmlBody(),
            'text' => $email->getTextBody(),
            'attachments' => $attachments,
            'headers' => $email->getHeaders()->toArray()
        ]);

    }

    private function attachAttachment($attachment,$msgid){


        $fileName = $attachment->getPreparedHeaders()->getHeaderParameter('content-type','name');

        $fileData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $attachment->bodyToString()));

        $tmpFilePath = sys_get_temp_dir() . '/' . $msgid;
        file_put_contents($tmpFilePath, $fileData);


        $tmpFile = new File($tmpFilePath);

        $file = new UploadedFile(
            $tmpFile->getPathname(),
            $tmpFile->getFilename(),
            $tmpFile->getMimeType(),
            0,
            true // Mark it as test, since the file isn't from real HTTP POST.
        );

        $path = $file->storePublicly('yomail/'.$msgid,'public');

        return [
            'fileName' => $fileName,
            'path' =>$path
        ];

    }
}
