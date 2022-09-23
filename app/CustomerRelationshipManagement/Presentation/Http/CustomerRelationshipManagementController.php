<?php


namespace App\CustomerRelationshipManagement\Presentation\Http;

use App\CustomerRelationshipManagement\Application\SubmitContactRequest\SubmitContactRequest;
use App\CustomerRelationshipManagement\Application\SubmitContactRequest\SubmitContactRequestInput;
use App\CustomerRelationshipManagement\Domain\Repositories\CustomerRepositoryInterface;
use App\CustomerRelationshipManagement\Domain\Services\NotificationSenderServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class CustomerRelationshipManagementController
{
    public function submitContactRequest(Request $request)
    {
        $submitContactRequest = new SubmitContactRequest(App::make(CustomerRepositoryInterface::class),
            App::make(NotificationSenderServiceInterface::class));
        $name = $request->input('name');
        $parts = explode(" ", $name);
        $lastName = array_pop($parts);
        $firstName = implode(" ", $parts);

        $email = $request->input('email');
        $message = $request->input('message');
        $phone = $request->input('phone');

        $submitContactRequestInput = new SubmitContactRequestInput([
            'customer' => [
                'customer_number' => null,
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => $email,
                'phone_number' => $phone
            ],
            'message' => $message
        ]);

        $submitContactRequestResult = $submitContactRequest->execute($submitContactRequestInput);

        $response["meta"]["created_at"] = time();
        $response["payload"]["message"] = $submitContactRequestResult->notificationSent()->message();

        return redirect()->back()->with('submit_contact_request_successful', true);
    }
}
