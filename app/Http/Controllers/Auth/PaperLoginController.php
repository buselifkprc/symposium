<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Paper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class PaperLoginController extends Controller
{


    public function login(Request $request)
    {
        // 1️⃣ Giriş formu doğrulaması
        $data = $request->validate([
            'email'    => ['required', 'email'],
            'paper_id' => ['required', 'integer'],
        ]);

        // 2️⃣ Kullanıcıyı email ile bul
        $user = User::where('email', $data['email'])->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Kullanıcı bulunamadı.']);
        }

        // 3️⃣ Paper ID geçerli mi kontrol et ve kaydı al
        $paper = Paper::with('registration')->find($data['paper_id']);

        if (!$paper) {
            return back()->withErrors(['paper_id' => 'Girilen Paper ID sistemde bulunamadı.']);
        }

        // 4️⃣ Giriş işlemi
        Auth::login($user, true);
        $request->session()->regenerate();

        // 5️⃣ Yönlendirme: doğrudan güncelleme sayfasına (route name ile)
        return redirect()->intended(route('kullanici.PaperUpdatePage', ['id' => $paper->id]));
    }
}
