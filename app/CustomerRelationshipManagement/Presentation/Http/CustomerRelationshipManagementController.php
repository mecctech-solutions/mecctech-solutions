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
        try {
            $submitContactRequest = new SubmitContactRequest(App::make(CustomerRepositoryInterface::class),
                App::make(NotificationSenderServiceInterface::class));
            $firstName = $request->input('first_name');
            $lastName = $request->input('last_name');
            $email = $request->input('email');
            $message = $request->input('message');

            $submitContactRequestInput = new SubmitContactRequestInput([
                'customer' => [
                    'customer_number' => null,
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                    'email' => $email
                ],
                'message' => $message
            ]);

            $submitContactRequestResult = $submitContactRequest->execute($submitContactRequestInput);

            $response["meta"]["created_at"] = time();
            $response["payload"]["message"] = $submitContactRequestResult->notificationSent()->message();

        } catch (\Exception $e)
        {
            $response["meta"]["created_at"] = time();
            $response["error"]["code"] = $e->getCode();
            $response["error"]["message"] = $e->getMessage();
        }

        return redirect()->back()->with('submit_contact_request_successful', true);
    }
}
