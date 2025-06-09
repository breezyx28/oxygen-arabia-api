<?php

namespace App\Traits;

use Illuminate\Support\Facades\Mail;

trait EmailsTrait
{
    public function sendVerificationEmail($user, $verificationUrl)
    {
        $subject = 'Verify Your Email Address';
        $view = 'emails.verification';
        $data = ['user' => $user, 'url' => $verificationUrl];

        $this->sendEmail($user->email, $subject, $view, $data);
    }

    public function sendOtpEmail($user, $otp)
    {
        $subject = 'Your OTP Code';
        $view = 'emails.otp';
        $data = ['user' => $user, 'otp' => $otp];

        $this->sendEmail($user->email, $subject, $view, $data);
    }

    public function sendGreetingEmail($user)
    {
        $subject = 'Greetings from Our Company';
        $view = 'emails.greeting';
        $data = ['user' => $user];

        $this->sendEmail($user->email, $subject, $view, $data);
    }

    public function sendNewsletter($user, $newsletterContent)
    {
        $subject = 'Our Latest News';
        $view = 'emails.newsletter';
        $data = ['user' => $user, 'content' => $newsletterContent];

        $this->sendEmail($user->email, $subject, $view, $data);
    }

    private function sendEmail($to, $subject, $view, $data)
    {
        Mail::send($view, $data, function ($message) use ($to, $subject) {
            $message->to($to)
                ->subject($subject);
        });
    }
}
