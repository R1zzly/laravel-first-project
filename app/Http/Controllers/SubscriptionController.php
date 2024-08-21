<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function show()
    {
        return view('subscribe');
    }

    public function store(Request $request)
    {
        $userId = Auth::id();

        $request->validate([
            'plan_id' => 'required|string',
        ]);

        $planDetails = $this->getPlanDetails($request->plan_id);
        $user = User::findOrFail($userId);
        if ($user->balance >= $planDetails['cost']) {

            $user->balance -= $planDetails['cost'];
            $user->save();

            $user->subscriptions()->create([
                'plan_id' => $request->plan_id,
                'status' => 'active',
                'expires_at' => now()->add($planDetails['duration']),
            ]);

            return redirect('/category')->with('success', 'Subscription created successfully.');
        }

        return redirect()->back()->with('error', 'Insufficient balance.');
    }

    protected function getPlanDetails($planId)
    {
        $plans = [
            'basic_monthly' => ['cost' => 10.00, 'duration' => '1 month'],
            'basic_yearly' => ['cost' => 100.00, 'duration' => '1 year'],
            'premium_monthly' => ['cost' => 20.00, 'duration' => '1 month'],
            'premium_yearly' => ['cost' => 200.00, 'duration' => '1 year'],
        ];

        return $plans[$planId] ?? ['cost' => 0, 'duration' => '0 days'];
    }
}
