<?php

namespace App\Http\Controllers;

use LaravelGmail;
use Illuminate\Http\Request;

class MailController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ], [
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng'
        ]);
        $email = $request->email;
        if (LaravelGmail::check()) {
            // search email query email by laravel gmail
            $messages = LaravelGmail::message()->to($email)
                ->preload()->all()->toArray();
            $messagesUnread = LaravelGmail::message()->to($email)
                ->preload()->unread()->all()->toArray();
            $messageSpamUnread = LaravelGmail::message()->to($email)
                ->preload()->in('SPAM')->unread()->all()->toArray();
            $messageSpam = LaravelGmail::message()->to($email)
                ->preload()->in('SPAM')->all()->toArray();


            if(count($messagesUnread) == 0 && count($messages) == 0 && count($messageSpamUnread) == 0 && count($messageSpam) == 0){
                return response()->json([
                    "data" => [],
                    "message" => "false",
                    "status" => 200
                ], 404);
            } else {
                $emailFrom = [];

                foreach ($messages as $key => $value) {
                    $emailFrom[] = $value->getFrom();
                    //get id email
                    $emailFrom[$key]['id'] = $value->getId();
                    $emailFrom[$key]['isUnread'] = false;
                }
                foreach ($messagesUnread as $key => $value) {
                    $emailFrom[] = $value->getFrom();
                    $emailFrom[$key]['id'] = $value->getId();
                    $emailFrom[$key]['isUnread'] = true;
                }
                foreach ($messageSpamUnread as $key => $value) {
                    $emailFrom[] = $value->getFrom();
                    $emailFrom[$key]['id'] = $value->getId();
                    $emailFrom[$key]['isUnread']  = true;
                }
                foreach ($messageSpam as $key => $value) {
                    $emailFrom[] = $value->getFrom();
                    $emailFrom[$key]['id'] = $value->getId();
                    $emailFrom[$key]['isUnread']  = false;
                }
                return response()->json([
                    "data" => $emailFrom,
                    "message" => "success",
                    "status" => 200
                ], 200);
            }
        }
        return response()->json([
            "data" => [],
            "message" => "false",
            "status" => 200
        ], 404);
    }

    public function getInfoEmail(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ], [
            'id.required' => 'Id không được để trống',
        ]);
        $id = $request->id;
        if (LaravelGmail::check()) {
            $message = LaravelGmail::message()->preload()->get($id);
            // get body
            $body = $message->getHtmlBody();
            // get subject
            $subject = $message->getSubject();
            // get from
            $from = $message->getFrom();
            // get to
            $to = $message->getTo();
            // get cc
            $cc = $message->getCc();
            // get bcc
            $bcc = $message->getBcc();
            // get date
            $date = $message->getDate();
            // get attachments
            $attachments = $message->getAttachments();
            return response()->json([
                "data" => [
                    "body" => $body,
                    "subject" => $subject,
                    "from" => $from,
                    "to" => $to,
                    "cc" => $cc,
                    "bcc" => $bcc,
                    "date" => $date,
                    "attachments" => $attachments,
                ],
                "message" => "success",
                "status" => 200
            ], 200);
        }
    }
}
