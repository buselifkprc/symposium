<?php

namespace App\Http\Controllers;

use App\Models\Paper;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KullaniciController extends Controller
{
    public function index()
    {
        if (!auth()->user()->hasRole('admin') && !auth()->user()->hasRole('süperadmin')) {
            abort(403);
        }

        $users = User::all();
        return view('panel.admin.kullanicilar.index', compact('users'));
    }


/* public function paperindex()
    {
        // 1. Her kullanıcının sadece kendi makalelerini görmesini sağlar.
        // 2. Makaleyle birlikte yazar bilgisini de (user) verimli bir şekilde çeker.
        // Giriş yapan kullanıcı
        $user = auth()->user();
        // Kullanıcının registration'ları üzerinden bağlı paper'ları getir
        $papers = Paper::with('registration')
            ->whereHas('registration', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            })
            ->orderByDesc('created_at')
            ->get();

        return view('panel.kullanici.index', compact('papers'));
    } */
    public function paperindex()
    {
        $user = auth()->user();

        // Login paper id ile paper'ı çek ve collection yap
        $papers = Paper::where('id', $user->login_paper_id)->get();

        if ($papers->isEmpty()) {
            return redirect()->back()->with('error', 'Login paper bulunamadı.');
        }

        return view('panel.kullanici.index', compact('papers'));
    }

    public function paperupdatepage()
    {
        $user = auth()->user();

        // Ana paper
        $mainPaper = Paper::with('registration')->find($user->login_paper_id);

        if (!$mainPaper) {
            return redirect()->back()->with('error', 'Login paper bulunamadı.');
        }

        // Diğer paperlar (ana paper hariç)
        $otherPapers = Paper::where('registration_id', $mainPaper->registration_id)
            ->where('id', '!=', $user->login_paper_id)
            ->get();

        $registration = $mainPaper->registration;

        return view('panel.kullanici.update', compact('mainPaper', 'registration', 'otherPapers'));
    }




    public function papercreatepage()
    {
        return view('panel.kullanici.create');
    }

    public function paperadd(Request $request)
    {
        $request->validate([
            'paper_title' => 'required|min:3',
            'paper_content' => 'required|min:3', // Düzeltildi
        ]);

        $paper = new Paper();
        $paper->paper_title = $request->paper_title;
        $paper->paper_content = $request->paper_content;
        $paper->registration_id = auth()->user()->registration->id;
        $paper->save();

        return redirect()->route('kullanici.PaperIndex')->with('success', 'Paper başarıyla eklendi.');
    }

   /* public function paperupdatepage()
    {
        $user = auth()->user();

        // 1. Kullanıcının ana paper'ı
        $mainPaper = Paper::findOrFail($user->loginpaper_id);

        // 2. Kullanıcının diğer paper'ları (ana paper hariç)
        $otherPapers = Paper::where('user_id', $user->id)
            ->where('id', '!=', $user->loginpaper_id)
            ->get();

        return view('panel.kullanici.update', compact('mainPaper', 'otherPapers'));
    } */



    public function paperupdate(Request $request)
    {
        $request->validate([
            'paper_title' => 'required|min:3',
            'paper_content' => 'required|min:3',
        ]);

        $oldpaper = Paper::findOrFail($request->paperId);

        $oldpaper->paper_title = $request->paper_title;
        $oldpaper->paper_content = $request->paper_content;
        $oldpaper->registration_id = auth()->user()->registration->id;
        $oldpaper->save();

        return redirect()->route('kullanici.PaperIndex')->with('success', 'Paper başarıyla güncellendi.');
    }
    public function paymentPage(Request $request)
    {
        $selectedPaperIds = $request->input('selected_papers', []);

        if(empty($selectedPaperIds)){
            return redirect()->back()->with('error', 'Please select at least one paper.');
        }

        $papers = Paper::whereIn('id', $selectedPaperIds)->get();
        $pricePerPaper = 100; // Örnek: her paper 100 USD
        $total = count($papers) * $pricePerPaper;

        return view('panel.kullanici.payment', compact('papers', 'total', 'pricePerPaper'));
    }

}

