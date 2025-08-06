<?php

namespace App\Http\Controllers;
use App\Models\Paper;

use App\Models\User;
use Illuminate\Http\Request;

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


    public function paperindex()
    {
        $papers = Paper::latest()->get(); // En son ekleneni en üstte gösterir
        return view('panel.kullanici.index', compact('papers'));
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

    public function paperupdatepage($id)
    {
        $paper = Paper::findOrFail($id); // find yerine findOrFail kullanmak kayıt bulunamazsa 404 hatası verir.
        return view('panel.kullanici.update', compact('paper'));
    }

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
}
