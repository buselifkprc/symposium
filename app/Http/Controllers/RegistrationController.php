<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegistrationController extends Controller
{
    // Bu fonksiyonun tek işi, senin ikinci formunu ekrana getirmek.
    public function create()
    {
        return view('registration.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'participation_type' => ['required', 'in:1,2,Have Paper'],
            'paper_ids' => [
                'nullable',
                'string',
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->participation_type === 'Have Paper' && empty($value)) {
                        $fail('The ' . str_replace('_', ' ', $attribute) . ' field is required when "Have Paper" is selected.');
                    }
                },
            ],
            'membership_type' => ['required', 'in:IEEE Member,Non-IEEE Member,IEEE Student Member,Student Non-IEEE member'],
            'is_ascs_member' => ['required', 'in:0,1'],
            'extra_paper_count' => ['nullable', 'integer', 'min:0'],
            'note' => ['nullable', 'string', 'max:1000'],
            'presentation_type' => ['nullable', 'in:Face to Face,Remote-Live Presentation,Pre-Recorded Video'],
        ]);

        $registration = Registration::create([
            'user_id' => auth()->id(),
            'participation_type' => $this->mapParticipationType($validated['participation_type']),
            'membership_type' => $validated['membership_type'],
            'is_ascs_member' => $validated['is_ascs_member'],
            'presentation_type' => $validated['presentation_type'] ?? null,
            'extra_paper_count' => $validated['extra_paper_count'] ?? 0,
            'note' => $validated['note'] ?? null,
        ]);
        // formu doldurmadan çıkan kişi için güncellenmiş kısım - kontrol
        $user = auth()->user();
        $user->has_completed_registration = true; // Değeri 1 (true) yap
        $user->save(); // Değişikliği veritabanına kaydet

        return redirect()->route('registration.summary')->with('data', [
            ...$validated,
            'participation_type' => $this->mapParticipationType($validated['participation_type']),
        ]);
    }

    public function summary()
    {
        $data = session('data');

        // Eğer session boşsa, ana sayfaya yönlendir
        if (!$data) {
            return redirect()->route('home')->with('error', 'No registration data found.');
        }

        return view('registration.formİnfo', compact('data'));
    }

    private function mapParticipationType($value)
    {
        return match ($value) {
            '1' => 'Listener (Main Conference)',
            '2' => 'Listener (WDIAA - Alteryx workshop session)',
            'Have Paper' => 'Have Paper',
            default => throw new \InvalidArgumentException('Invalid participation type.'),
        };
    }
    public function update(Request $request)
    {
        // Validation (isteğe göre detaylandırabilirsin)
        $request->validate([
            'registration_id' => 'required|exists:registrations,id',
            'participation_type' => 'required|string',
            'membership_type' => 'required|string',
            'is_ascs_member' => 'required|boolean',
            'presentation_type' => 'required|string',
            'phone_number' => 'nullable|string|max:20',
            'degree' => 'nullable|string|max:100',
            'paper_ids' => 'nullable|string',
        ]);

        // Registration bul ve güncelle
        $registration = Registration::findOrFail($request->registration_id);
        $registration->participation_type = $request->participation_type;
        $registration->membership_type = $request->membership_type;
        $registration->is_ascs_member = $request->is_ascs_member;
        $registration->presentation_type = $request->presentation_type;
        $registration->phone_number = $request->phone_number;
        $registration->degree = $request->degree;
        $registration->paper_ids = $request->paper_ids;

        $registration->save();

        return back()->with('success', 'Registration updated successfully!');
    }



}

