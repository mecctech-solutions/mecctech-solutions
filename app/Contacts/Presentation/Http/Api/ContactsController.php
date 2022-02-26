<?php


namespace App\Contacts\Presentation\Http\Api;


use Illuminate\Http\Request;

class ContactsController
{
    public function index(Request $request)
    {
        // Handle the response
    }

    public function submitOrderForm(Request $request)
    {
        return redirect()->back()->with([
            'order-form-sent' => true
        ]);
    }
}
