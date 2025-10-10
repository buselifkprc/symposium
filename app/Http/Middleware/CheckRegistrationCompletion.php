<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRegistrationCompletion
{
    public function handle(Request $request, Closure $next): Response
    {
        // Kullanıcı giriş yapmış mı?
        if (Auth::check()) {
            $user = Auth::user();

            // ✅ Eğer kayıt tamamlandıysa hiçbir kısıtlama uygulanmaz
            if ($user->has_completed_registration) {
                return $next($request);
            }

            // 🚫 Eğer kayıt tamamlanmamışsa, sadece bu rotalara izin ver
            $allowedRoutes = [
                'registration.create',       // kayıt formu sayfası
                'registration.store',        // kayıt formu kaydetme
                'registration.update',       // kayıt güncelleme
                'kullanici.PaperUpdatePage', // paper update sayfası
            ];

            // Eğer bu izinli rotalardan birine gitmiyorsa, yönlendir
            if (!$request->routeIs($allowedRoutes)) {
                return redirect()->route('registration.create');
            }
        }

        // Varsayılan olarak devam et
        return $next($request);
    }
}
