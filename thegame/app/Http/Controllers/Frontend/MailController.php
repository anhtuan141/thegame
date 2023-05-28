<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Throwable;
use Illuminate\Support\Facades\Mail;
use PhpParser\Node\Stmt\TryCatch;

class MailController extends Controller
{
    public function contact()
    {
        return view('frontend.system.contact');
    }

    public function sendEmail(Request $request)
    {
        $details = [
            'name' => $request->name,
            'email' => $request->email,
            'title' => $request->title,
            'content' => $request->content
        ];
        try {
            Mail::to('laptrinhweb1401@gmail.com')->send(new ContactMail($details));
            return redirect()->route('f.contact')
                ->with([
                    'msg' => 'Mail Has Been Sent Successfully!',
                    'type' => 'success'
                ]);
        } catch (Throwable $e) {
            return redirect()->route('f.contact')
                ->with([
                    'msg' => 'Mail Has Been Sent Fail!',
                    'type' => 'fail'
                ]);
        }
    }


    // public function send(Request $request)
    // {
    //     try {
    //         Mail::raw($request->content, function ($message) use ($request) {
    //             // $message->from($request->email, $request->name);
    //             // $message->sender('john@johndoe.com', 'John Doe');
    //             //  $message->to('laptrinhweb1401@gmail.com', 'TheGameGT');
    //             // $message->cc('john@johndoe.com', 'John Doe');
    //             $message->bcc('laptrinhweb1401@gmail.com', 'TheGameGT');
    //             // $message->replyTo('john@johndoe.com', 'John Doe');
    //             $message->subject($request->title);
    //             // $message->priority(3);
    //             // $message->attach('pathToFile');
    //         });
    //         return redirect()->route('f.contact')->with(['msg' => 'Mail Send Success', 'type' => 'success']);
    //     } catch (Throwable $e) {
    //         return redirect()->route('f.contact')->with(['msg' => $e->getMessage(), 'type' => 'fail']);
    //     }
    // }

    // public function send(Request $request)
    // {
    //     //dd($request->all());
    //     try {
    //         Mail::send(
    //             'frontend.mail.contact',
    //             [
    //                 'name' => $request->name,
    //                 'email' => $request->email,
    //                 'title' => $request->title,
    //                 'content' => $request->content
    //             ],
    //             function ($message) use ($request) {
    //                 //$message->from('john@johndoe.com', 'John Doe');
    //                 //$message->sender('john@johndoe.com', 'John Doe');
    //                 //$message->to('laptrinhweb1401@gmail.com', 'TheGameGT');
    //                 //$message->cc('john@johndoe.com', 'John Doe');
    //                 $message->bcc('laptrinhweb1401@gmail.com', 'TheGameGT');
    //                 //$message->replyTo('john@johndoe.com', 'John Doe');
    //                 $message->subject($request->title);
    //                 //$message->priority(3);
    //                 //$message->attach('pathToFile');
    //             }
    //         );
    //         return redirect()->route('f.contact')->with(['msg' => 'Mail Send Success', 'type' => 'success']);
    //     } catch (Throwable $e) {
    //         return redirect()->route('f.contact')->with(['msg' => $e->getMessage(), 'type' => 'fail']);
    //     }
    // }


}
