<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paper;

class PaymentController extends Controller
{
    public function show($paper_id)
    {
        $paper = Paper::findOrFail($paper_id);
        return view('payment.show', compact('paper'));
    }
}
