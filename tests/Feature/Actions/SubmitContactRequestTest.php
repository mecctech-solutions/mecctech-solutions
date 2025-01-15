<?php

namespace Tests\Feature\Actions;

use App\CustomerRelationshipManagement\Application\SubmitContactRequest\SubmitContactRequest;
use App\CustomerRelationshipManagement\Application\SubmitContactRequest\SubmitContactRequestInput;
use App\CustomerRelationshipManagement\Domain\Customers\Customer;
use App\CustomerRelationshipManagement\Domain\Notifications\Notification;
use App\CustomerRelationshipManagement\Domain\Services\NotificationSenderServiceInterface;
use Mockery\MockInterface;
use Tests\TestCase;

class SubmitContactRequestTest extends TestCase
{
    /** @test */
    public function it_should_add_customer_if_it_does_not_exist(){

        // Given
        $customer = new Customer(null, "John", "Doe", "johndoe@example.com", '0612345678');
        $message = "johndoe@example.com";
        $notificationSenderServiceMock = $this->mock(NotificationSenderServiceInterface::class, function (MockInterface $mock) use ($message) {
            $mock->shouldReceive('send')
                ->once()
                ->andReturn(new Notification($message));
        });
        $submitContactRequest = new SubmitContactRequest($this->customerRepository,
                                                            $notificationSenderServiceMock);
        $submitContactRequestInput = new SubmitContactRequestInput([
            "customer" => $customer->toArray(),
            "message" => $message
        ]);

        // When
        $submitContactRequestResult = $submitContactRequest->execute($submitContactRequestInput);


        // Then
        self::assertNotNull($this->customerRepository->findByEmail($customer->email()));
    }

    /** @test */
    public function it_should_send_notification_of_new_message(){

        // Given
        $customer = new Customer(uniqid(), "John", "Doe", "johndoe@example.com", '0612345678');
        $message = "Test Message";

        $submitContactRequest = new SubmitContactRequest($this->customerRepository,
                                                            $this->notificationSenderService);
        $submitContactRequestInput = new SubmitContactRequestInput([
            "customer" => $customer->toArray(),
            "message" => $message
        ]);

        // When
        $submitContactRequestResult = $submitContactRequest->execute($submitContactRequestInput);

        // Then
        $expectedMessage = $customer->name()." with email address ".$customer->email()." has sent the following message: ".$message;

        self::assertEquals(new Notification($expectedMessage), $submitContactRequestResult->notificationSent());
    }

    /** @test */
    public function it_should_create_a_customer_number_when_customer_does_not_exist(){

        $customer = new Customer(null, "John", "Doe", "johndoe@example.com", '0612345678');
        $message = "johndoe@example.com";
        $notificationSenderServiceMock = $this->mock(NotificationSenderServiceInterface::class, function (MockInterface $mock) use ($message) {
            $mock->shouldReceive('send')
                ->once()
                ->andReturn(new Notification($message));
        });

        $submitContactRequest = new SubmitContactRequest($this->customerRepository,
            $notificationSenderServiceMock);
        $submitContactRequestInput = new SubmitContactRequestInput([
            "customer" => $customer->toArray(),
            "message" => $message
        ]);

        // When
        $submitContactRequestResult = $submitContactRequest->execute($submitContactRequestInput);


        // Then
        self::assertNotNull($this->customerRepository->findByEmail($customer->email())->customerNumber());
    }
}
