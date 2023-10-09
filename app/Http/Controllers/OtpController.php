<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OtpController extends Controller
{
    public function create()
    {

        return view('otp.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'mobile_number' => ['required']
        ]);

        $client = $this->getClient();

        // $response = $client->sms()->send(
        //     new \Vonage\SMS\Message\SMS("201098938880", "wazzufny", 'A text message sent using the Nexmo SMS API')
            
        // );
        // $message = $response->current();
        // if ($message->getStatus() == 0) {
        //     echo "The message was sent successfully\n";
        // } else {
        //     echo "The message failed with status: " . $message->getStatus() . "\n";
        // }

        $request = new \Vonage\Verify\Request($request->post('mobile_number'), "Vonage");
        $response = $client->verify()->start($request);

        Session::put('nexmo.verify.requestId', $response->getRequestId());

        return redirect()->route('otp.verify');
    }

    public function verifyForm()
    {
        return view('otp.verify');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'code' => ['required'],
        ]);

        $client = $this->getClient();

        try {
            $requestId = Session::get('nexmo.verify.requestId');
            $result = $client->verify()->check($requestId, $request->post('code'));
        } catch (\Vonage\Client\Exception\Request $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        Session::forget('nexmo.verify.requestId');

        return redirect()->route(RouteServiceProvider::HOME);
    }

    protected function getClient()
    {


        $basic  = new \Vonage\Client\Credentials\Basic(config('services.vonage.key'), config('services.vonage.secret'));
        $client = new \Vonage\Client($basic);
        return $client;
    }
}
