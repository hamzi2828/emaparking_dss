<?php
namespace App\Mailbox;

use App\Models\ParsedEmails;
use BeyondCode\Mailbox\InboundEmail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;


class CatchAllMailbox
{
    public function __invoke(InboundEmail $email)
    {
        Log::debug('Inbound Email trigger');
        Log::info($email->from());
        Log::info($email->fromName());
        try {
            $attachments = [];
            foreach ($email->attachments() as $attachment) {
                $filename = time().'_'.$attachment->getFilename();
                $attachment->saveContent(Storage::disk('public')->path($filename));
                $attachments[] = $filename;
            }
            ParsedEmails::create([
                'email' => $email->from(),
                'name' => $email->fromName(),
                'subject' => $email->subject(),
                'html'=> $email->html(),
                'text'=> $email->text(),
                'attachments'=>$attachments,
            ]);
        }
        catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }
}
