<?php

namespace App\Actions;

use App\Jobs\SendMailJob;
use App\Mail\SubmitContactRequestMail;
use App\Models\ContactRequest;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class SubmitContactRequest
{
    use AsAction;

    public function handle(array $customer, string $message)
    {
        $foundCustomer = ContactRequest::where([
            'email' => $customer['email'],
        ])->first();

        if ($foundCustomer === null) {
            $customerNumber = uniqid();
            $customer = ContactRequest::create([
                'customer_number' => $customerNumber,
                'first_name' => $customer['first_name'],
                'last_name' => $customer['last_name'],
                'email' => $customer['email'],
                'phone_number' => $customer['phone_number'],
                'message' => $message,
            ]);
        } else {
            $customer = $foundCustomer;
        }

        $myEmail = 'florismeccanici@tutanota.com';
        $message = $customer->full_name.' with email address '.$customer->email.' has sent the following message: '.$message;
        $mailable = new SubmitContactRequestMail($message, $myEmail);

        SendMailJob::dispatch(
            $mailable, $myEmail
        )->onQueue('emails');
    }

    public function asController(Request $request)
    {
        $name = $request->input('name');
        $parts = explode(' ', $name);
        $lastName = array_pop($parts);
        $firstName = implode(' ', $parts);

        $email = $request->input('email');
        $message = $request->input('message');
        $phone = $request->input('phone');

        $this->handle([
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $email,
            'phone_number' => $phone,
        ], $message);

        return redirect()->back();
    }
}
