<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Kayıt formunu gösterir.
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Gelen yeni kayıt isteğini işler.
     */
    public function store(Request $request)
    {
        // 1. DOĞRULAMA: Artık 'unvan' ve 'surname' bekliyoruz.
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone_number' => ['required', 'string', 'max:20'],
            'unvan' => ['required', 'string'], // Formdan 'unvan' geldiğini biliyoruz.
            'password' => ['required', 'confirmed', \Illuminate\Validation\Rules\Password::defaults()],
        ]);

        // 2. VERİ ÇEVİRME: Formdan gelen '1', '2' gibi rakamları metne dönüştür.
        $degreeValue = match($request->input('unvan')) {
            '1' => 'Ph. D.',
            '2' => 'Assistant Professor',
            '3' => 'Associate Professor',
            '4' => 'Professor',
            '5' => 'Expert / Student / Other',
            default => null, // Beklenmedik bir değer gelirse boş bırak.
        };

        // 3. KAYIT: Veritabanına doğru alan adları ve çevrilmiş veri ile kayıt yap.
        $user = \App\Models\User::create([
            'name' => $request->name,
            'surname' => $request->surname, // Doğru sütun adı.
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'institution' => $request->institution,
            'degree' => $degreeValue, // 'degree' sütununa çevrilmiş metni kaydet.
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
        ]);

        // 4. Giriş yaptır ve yönlendir (Bu kısımlar aynı).
        \Illuminate\Support\Facades\Auth::login($user);

        return redirect()->route('registration.create');
    }
}
