<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use App\Models\Paper;
use App\Models\Registration;
use App\Models\User;
use App\Http\Controllers\Controller;


class AdminController extends Controller
{



    public function index()
    {
        // Eager Loading (with metodu) kullanarak N+1 problemini önlüyoruz.
        // Bu, sorgu sayısını ciddi oranda azaltır ve performansı artırır.

        // Bütün kullanıcıları rollerini de alarak çekiyoruz.
        $users = User::with('roles')->get();

        // Bütün kayıtları, ilgili kullanıcı bilgisiyle birlikte çekiyoruz.
        $registrations = Registration::with('user')->get();

        // Bütün bildirileri, ilgili kayıt ve o kaydın kullanıcısıyla birlikte çekiyoruz.
        $papers = Paper::with('registration.user')->get();

        // Verileri view'e gönderiyoruz.
        return view('panel.admin.index', compact('users', 'registrations', 'papers'));
    }


    public function superadminindex()
    {
        // Mevcut adminleri ve süper adminleri hariç tutarak, rol atanabilecek kullanıcıları listele.
        $potentialAdmins = User::whereDoesntHave('roles', function ($query) {
            $query->whereIn('name', ['admin', 'superadmin']);
        })->latest()->get();

        // Sadece 'admin' rolüne sahip olan kullanıcıları listele.
        $admins = User::role('admin')->latest()->get();

        // Her iki listeyi de view'a gönder.
        return view('panel.super admin.index', compact('admins', 'potentialAdmins'));
    }

    /**
     * Mevcut bir kullanıcıya 'admin' rolü atar.
     * Bu metod artık yeni kullanıcı oluşturmaz.
     */
    public function store(Request $request)
    {
        // Gelen isteğin içinde 'user_id' olup olmadığını ve geçerli bir kullanıcı olup olmadığını kontrol et.
        $request->validate([
            'user_id' => 'required|exists:users,id'
        ]);

        // Kullanıcıyı bul.
        $user = User::findOrFail($request->user_id);

        // Kullanıcıya 'admin' rolünü ata.
        $user->assignRole('admin');

        return redirect()->route('superadmin.admins.index')->with('success', "'{$user->name}' kullanıcısı başarıyla admin yapıldı.");
    }

    /**
     * Bir kullanıcının 'admin' rolünü kaldırır.
     * ÖNEMLİ: Bu metod artık kullanıcıyı tamamen silmez, sadece rolünü kaldırır. Bu daha güvenli bir yöntemdir.
     */
    public function destroy(User $user)
    {
        if (auth()->user()->id === $user->id) {
            return redirect()->route('superadmin.admins.index')->with('error', 'Kendi admin rolünüzü kaldıramazsınız.');
        }
        // Kullanıcının 'admin' rolüne sahip olup olmadığını kontrol et.
        if ($user->hasRole('admin')) {
            $user->removeRole('admin');
            return redirect()->route('superadmin.admins.index')->with('success', "'{$user->name}' kullanıcısının admin rolü başarıyla kaldırıldı.");
        }

        return redirect()->route('superadmin.admins.index')->with('error', 'İşlem başarısız, kullanıcı admin rolüne sahip değil.');
    }
}
