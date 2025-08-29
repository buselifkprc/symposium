<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class PaperLoginController extends Controller
{
    public function login(Request $request)
    {
        // validasyon
        $data = $request->validate([
            'email'    => ['required', 'email'],
            'paper_id' => ['required', 'integer'],
        ]);

        // kullanıcıyı bul
        $user = User::where('email', $data['email'])->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Kullanıcı bulunamadı.']);
        }

        // sadece login_paper_id eşleşirse girişe izin ver
        if ((int)$user->login_paper_id !== (int)$data['paper_id']) {
            return back()->withErrors(['paper_id' => 'Bu Paper ID ile giriş yapamazsınız.']);
        }

        // paper gerçekten kullanıcıya ait mi kontrol et
        $owned = $user->papers()
            ->where('papers.id', $user->login_paper_id)
            ->exists();
        if (!$owned) {
            return back()->withErrors(['paper_id' => 'Bu Paper bu kullanıcıya ait değil.']);
        }

        // giriş yap
        Auth::login($user, true);
        $request->session()->regenerate();

        return redirect()->intended('/dashboard');
    }
}
