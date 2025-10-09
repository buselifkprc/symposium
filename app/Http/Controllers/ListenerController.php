<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listener;

class ListenerController extends Controller
{
    // Formu göster
    public function registration()
    {
        return view('listener.registration');
    }

    // Form submit
    public function store(Request $request)
    {
        // Validate
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|email|unique:listeners,email',
            'institution' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'unvan' => 'required',
            'participation_type' => 'required',
        ]);

        // Eğer validation hatası varsa JSON dön
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422); // important: HTTP status 422
        }

        // Listener kaydı oluştur
        Listener::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'institution' => $request->institution,
            'phone_number' => $request->phone_number,
            'degree' => $request->unvan,
            'participation_type' => $request->participation_type,
        ]);

        // Başarılı mesaj
        return response()->json([
            'success' => 'You have been successfully registered as a listener!'
        ], 200);
    }


}
