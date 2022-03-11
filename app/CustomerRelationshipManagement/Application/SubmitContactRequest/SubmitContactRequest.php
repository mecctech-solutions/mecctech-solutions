<?php


namespace App\CustomerRelationshipManagement\Application\SubmitContactRequest;

use App\CustomerRelationshipManagement\Domain\Customers\CustomerFactory;
use App\CustomerRelationshipManagement\Domain\Exceptions\CustomerNotFoundException;
use App\CustomerRelationshipManagement\Domain\Notifications\Notification;
use App\CustomerRelationshipManagement\Domain\Notifications\Recipient;
use App\CustomerRelationshipManagement\Domain\Repositories\CustomerRepositoryInterface;
use App\CustomerRelationshipManagement\Domain\Services\NotificationSenderServiceInterface;

class SubmitContactRequest implements SubmitContactRequestInterface
{
    private CustomerRepositoryInterface $customerRepository;
    private NotificationSenderServiceInterface $notificationSenderService;

    /**
     * SubmitContactRequest constructor.
     */
    public function __construct(CustomerRepositoryInterface $customerRepository,
                                NotificationSenderServiceInterface $notificationSenderService)
    {
        $this->customerRepository = $customerRepository;
        $this->notificationSenderService = $notificationSenderService;
    }

    /**
     * @inheritDoc
     */
    public function execute(SubmitContactRequestInput $input): SubmitContactRequestResult
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

        return new SubmitContactRequestResult($notificationSent);
    }
}
