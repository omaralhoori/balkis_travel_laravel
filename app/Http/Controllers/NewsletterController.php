<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsletterRequest;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\RedirectResponse;

class NewsletterController extends Controller
{
    public function subscribe(NewsletterRequest $request): RedirectResponse
    {
        NewsletterSubscriber::create([
            'email' => $request->email,
            'name' => $request->name,
            'is_active' => true,
            'subscribed_at' => now(),
        ]);

        return back()->with('newsletter_success', 'تم الاشتراك في النشرة البريدية بنجاح! شكراً لك.');
    }
}
