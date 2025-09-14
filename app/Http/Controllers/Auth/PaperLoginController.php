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
        $data = $request->validate([
            'email'    => ['required', 'email'],
            'paper_id' => ['required', 'integer'],
        ]);

        // Kullanıcıyı email ile bul
        $user = User::where('email', $data['email'])->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Kullanıcı bulunamadı.']);
        }

        // Eğer kullanıcıda login_paper_id boşsa, seçilen paper id'yi ata
        if (!$user->login_paper_id) {
            $user->login_paper_id = $data['paper_id'];
            $user->save();
        }

        // Eğer mevcutsa, giriş yapılan paper ile eşleşiyor mu kontrol et
        if ((int)$user->login_paper_id !== (int)$data['paper_id']) {
            return back()->withErrors(['paper_id' => 'Bu Paper ID ile giriş yapamazsınız.']);
        }

        // Giriş yap
        Auth::login($user, true);
        $request->session()->regenerate();

        return redirect()->intended('/paper/index');
    }
}
