<?php

namespace App\Console\Commands;

use App\Models\NewsLetter;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Modules\Booking\Models\Booking;
use Modules\User\Models\Subscriber;
use Modules\User\Models\User;
use Modules\User\Models\CampaginCustomer;

class SendNewsLetter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cron:send_news_letter';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send newsletters to subscribers or customers';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $newsLetters = NewsLetter::where('status', 'active')->get();

        if ($newsLetters->isEmpty()) {
            $this->info('No active newsletters found.');
            return 0;
        }

        foreach ($newsLetters as $newsLetter) {
            $recipientScope = $newsLetter->recipient_scope;
            $emails = $this->getEmailsBasedOnRecipientScope($recipientScope);

            $newsLetter->update([
                'action_performed_at' => now(),
                'status' => 'processing'
            ]);

            if (empty($emails)) {
                $this->info("No recipients found for scope: $recipientScope");
                $newsLetter->update(['status' => 'failed', 'failure_logs' => 'No recipients found']);
                continue;
            }

            $subject = $newsLetter->email_subject;

            if (empty($subject)) {
                $this->error("Subject not found for newsletter ID: {$newsLetter->id}. Skipping.");
                $newsLetter->update(['status' => 'failed', 'failure_logs' => 'Subject not found']);
                continue;
            }

            $templateKey = $newsLetter->template_key;
            $otherinfo = $newsLetter->other_info;
            $template = '';

            try {
                // Render the email template
                $template = view("newsletter-templates.$templateKey")->render();
            } catch (\Exception $e) {
                $this->error("Template not found for $templateKey. Skipping newsletter ID: {$newsLetter->id}");
                $newsLetter->update(['status' => 'failed', 'failure_logs' => 'Template not found']);
                continue;
            }

            if($otherinfo==1){
                $oldname= "";
                foreach ($emails as $key=> $email) {
                    $emailuser= $email['email'];
                    $name = $email['first_name'].' '.$email['last_name'];
                    try {
                        if($key==0){
                            $template= str_replace('{FNAME}',$name ,$template);
                        }else
                        {
                            $template= str_replace($oldname,$name ,$template);
                        }
                        
                
                        \Log::info('payment booking id url reponse Log: '.@$name.' '.$key);
                        $r = Mail::send([], [], function ($message) use ($emailuser, $subject, $template) {
                            $message->to($emailuser)
                                ->subject($subject)
                                ->html($template); // Use html() instead of setBody
                        });
                        $oldname= $name;
                        // $this->info("Newsletter sent to $emailuser successfully.");
                    } catch (\Exception $e) {
                        $this->error("Failed to send email to $emailuser: " . $e->getMessage());
                    }
                }
          
            }else{
            // foreach ($emails as $email) {
            //     try {
            //         $r = Mail::send([], [], function ($message) use ($email, $subject, $template) {
            //             $message->to($email)
            //                 ->subject($subject)
            //                 ->html($template); // Use html() instead of setBody
            //         });
            //         $this->info("Newsletter sent to $email successfully.");
            //     } catch (\Exception $e) {
            //         $this->error("Failed to send email to $email: " . $e->getMessage());
            //     }
            // }
        }
            $newsLetter->update(['status' => 'sent']);
        }

        $this->info('Newsletter sending process completed.');
        return 0;
    }

    /**
     * Get recipient emails based on the recipient scope.
     *
     * @param string $recipientScope
     * @return array
     */
    private function getEmailsBasedOnRecipientScope($recipientScope)
    {
        $emails = [];

        switch ($recipientScope) {
            case 'subscribers':
                $emails = Subscriber::where('email', '!=', '')
                    ->whereNotNull('email')
                    ->distinct()
                    ->pluck('email')
                    ->toArray();
                break;

            case 'customers':
                $emails = Booking::where('email', '!=', '')
                    ->whereNotNull('email')
                    ->distinct()
                    ->pluck('email')
                    ->toArray();
                break;
                case 'campagin-user':
                    $emails = CampaginCustomer::where('email', '!=', '')->get()
                      
                        //->pluck('email')
                        ->toArray();
                    break;
            default:
                $this->error("Unknown recipient scope: $recipientScope");
                break;
        }

        return $emails;
    }
}
