<?php

namespace App\Actions;

use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class SubmitContactRequest
{
    use AsAction;

    public function handle()
    {
        $customer = CustomerFactory::fromArray($input->customer());

        try {
            $this->customerRepository->findByEmail($customer->email());
        } catch (CustomerNotFoundException)
        {
            $customerNumber = uniqid();
            $customer->changeCustomerNumber($customerNumber);
            $this->customerRepository->add($customer);
        }

        $message = $customer->name()." with email address ".$customer->email()." has sent the following message: ".$input->message();
        $notificationSent = $this->notificationSenderService->send(new Notification($message), new Recipient("florismeccanici@tutanota.com"));

    }

    public function asController(Request $request)
    {
        $this->handle();
    }
}
