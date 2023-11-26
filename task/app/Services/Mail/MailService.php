<?php

namespace App\Services\Mail;

use App\Models\ProfileReset;
use App\Repositories\Mail\IMailRepository;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Models\Mail as MailLogix;

class MailService implements IMailService
{
    public function __construct(
        private IMailRepository $mailRepository
    ){}

    public function send(array $data, ProfileReset $profileReset)
    {
        $mailStoreData = [
            'to' => $data['email'],
            'from' => env('MAIL_FROM_ADDRESS'),
            'from_name' => env('MAIL_FROM_NAME'),
            'subject' => env('MAIL_SUBJECT'),
        ];

        $mail = $this->mailRepository->create($mailStoreData);


        $mailData = [
            'type' => $data['type'],
            'token' => $profileReset->token ?? null,
            'code' => $profileReset->code ?? null,
        ];

        try {
            Mail::send('mail.index', ['mailData' => $mailData], function ($m) use ($data) {
                $m->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                $m->to($data['email'])->subject(env('MAIL_SUBJECT'));
            });

            $mail->status = MailLogix::STATUS_SENT;
        } catch (\Exception $e) {
            Log::error('mail_service.send.' . $e->getMessage());

            $mail->status = MailLogix::STATUS_FAILED;
        }

        $mail->save();
    }
}
