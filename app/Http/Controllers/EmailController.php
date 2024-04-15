<?php

namespace App\Http\Controllers;

use App\Mail\AddNewAnimal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendNewAnimalEmail(){

        $toEmail = 'hemal.chathuranga91@gmail.com';
        $mailMessage = 'Test Email';
        $subject = 'New Animal Added.';
        $qrCode = 'HL-0001';

        // Mail::to($toEmail)->send(new AddNewAnimal($mailMessage, $subject, $qrCode));
    }
}
