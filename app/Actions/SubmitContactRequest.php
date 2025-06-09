<?php

namespace App\Actions;

use App\Data\ContactRequestData;
use App\Http\Requests\SubmitContactRequestRequest;
use App\Jobs\SendMailJob;
use App\Mail\SubmitContactRequestMail;
use App\Models\ContactRequest;
use Illuminate\Http\RedirectResponse;
use Lorisleiva\Actions\Concerns\AsAction;

class SubmitContactRequest
{
    use AsAction;

    public function handle(ContactRequestData $data): void
    {
        $customerNumber = uniqid();
        $customer = ContactRequest::create([
            'customer_number' => $customerNumber,
            'first_name' => $data->first_name,
            'last_name' => $data->last_name,
            'email' => $data->email,
            'phone_number' => $data->phone_number,
            'message' => $data->message,
        ]);

        $myEmail = 'florismeccanici@tutanota.com';
        $message = $customer->full_name.' with email address '.$customer->email.' has sent the following message: '.$data->message;
        $mailable = new SubmitContactRequestMail($message, $myEmail);

        SendMailJob::dispatch(
            $mailable, $myEmail
        )->onQueue('emails');
    }

    public function asController(SubmitContactRequestRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $data = ContactRequestData::from([
            'name' => $validated['first_name'].' '.$validated['last_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone_number'],
            'message' => $validated['message'],
        ]);

        $this->handle($data);

        return redirect()->back();
    }
}
