<?php

namespace App\Http\Controllers;

use App\Services\NewsletterInterface;
use Illuminate\Validation\ValidationException;
use Exception;


class NewsletterController extends Controller
{
    /**
     * @throws ValidationException
     */
    public function __invoke(NewsletterInterface $newsletter)
    {
        request()->validate(['email' => 'required|email']);

        try {
            $newsletter->subscribe(request('email'));
        } catch (Exception $e) {
                throw ValidationException::withMessages([
                'email' => 'This email could not be added to our newsletter list.'
            ]);
        }

        return redirect('/')
            ->with('success', 'You have successfully subscribed to our newsletter list.');
    }
}
