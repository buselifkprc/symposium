<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegistrationController extends Controller
{
    /**
     * Kayıt formunu (2. formu) ekrana getirir.
     */
    public function create()
    {
        return view('registration.create');
    }

    /**
     * Yeni kayıt oluşturur.
     */
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

        // Kullanıcının zaten kayıt oluşturup oluşturmadığını kontrol et
        if (Registration::where('user_id', auth()->id())->exists()) {
            return redirect()->back()->with('error', 'You have already completed registration.');
        }

        // Kayıt oluşturma
        $registration = Registration::create([
            'user_id' => auth()->id(),
            'participation_type' => $this->mapParticipationType($validated['participation_type']),
            'membership_type' => $validated['membership_type'],
            'is_ascs_member' => $validated['is_ascs_member'],
            'presentation_type' => $validated['presentation_type'] ?? null,
            'extra_paper_count' => $validated['extra_paper_count'] ?? 0,
            'note' => $validated['note'] ?? null,
        ]);

        // Kullanıcının kayıt sürecini tamamladığını işaretle
        $user = auth()->user();
        $user->has_completed_registration = true;
        $user->save();

        // Özet sayfasına yönlendirme
        return redirect()->route('registration.summary')->with('data', [
            ...$validated,
            'participation_type' => $this->mapParticipationType($validated['participation_type']),
        ]);
    }

    /**
     * Kullanıcıya kayıt özetini gösterir.
     */
    public function summary()
    {
        $data = session('data');

        if (!$data) {
            return redirect()->route('home')->with('error', 'No registration data found.');
        }

        return view('registration.formInfo', compact('data'));
    }

    /**
     * Katılım tipini metin karşılığına dönüştürür.
     */
    private function mapParticipationType($value)
    {
        return match ($value) {
            '1' => 'Listener (Main Conference)',
            '2' => 'Listener (WDIAA - Alteryx workshop session)',
            'Have Paper' => 'Have Paper',
            default => throw new \InvalidArgumentException('Invalid participation type.'),
        };
    }

    /**
     * Mevcut kayıt verilerini günceller.
     */
    public function update(Request $request)
    {
        $request->validate([
            'registration_id' => 'required|exists:registrations,id',
            'participation_type' => 'nullable|string|in:1,2,Have Paper',
            'membership_type' => 'required|string',
            'is_ascs_member' => 'required|boolean',
            'presentation_type' => 'required|string',
            'phone_number' => 'nullable|string|max:20',
            'degree' => 'nullable|string|max:100',
            'paper_ids' => 'nullable|string',
        ]);

        $registration = Registration::findOrFail($request->registration_id);

        // participation_type varsa map'lenerek güncellenir
        if (!empty($request->participation_type)) {
            $registration->participation_type = $this->mapParticipationType($request->participation_type);
        }

        $registration->membership_type = $request->membership_type;
        $registration->is_ascs_member = $request->is_ascs_member;
        $registration->presentation_type = $request->presentation_type;
        $registration->phone_number = $request->phone_number;
        $registration->degree = $request->degree;
        $registration->paper_ids = $request->paper_ids;
        $registration->save();

        return redirect()->route('kullanici.PaperIndex')->with('success', 'Registration updated successfully!');
    }
}
