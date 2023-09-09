<?php

namespace App\Http\Controllers;

use App\Actions\CreateSubscription;
use App\Models\Plan;
use App\Models\subscription;
use Illuminate\Http\Request;

class subscriptionController extends Controller
{
    //

    public function store(CreateSubscriptionRequest $request,CreateSubscription $request)
    {
        $request->validate([
            'plan_id' =>['required','int'],
            'period' =>['required','int','min:1']
        ]);
        $plan=Plan::findorfail($request->post('plan_id'));
        $months=$request->post('period');




    }
}
