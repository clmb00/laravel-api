<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\NewContact;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class LeadController extends Controller
{
    public function store(Request $request){
        $data = $request->all();

        $success = true;

        // verificare i dati
        $validator  = Validator::make($data,
            [
                'name' => 'required|min:2|max:255',
                'email' => 'required|email|max:255',
                'message' => 'required|min:5'
            ]
        );

        if($validator->fails()){
            $success = false;
            $errors = $validator->errors();
            return response()->json(compact('success', 'errors'));
        }

        // salvarl nel db
        $new_lead = new Lead();
        $new_lead->fill($data);
        $new_lead->save();

        // inviare la mail
        Mail::to('info@portfolio.com')->send(new NewContact($new_lead));

        return response()->json(compact('success'));
    }
}
