@extends('panel.layout.app')

@section('content')
    <div class="row mt-3">
        <div class="col-lg-8 mx-auto">
            <div class="card p-4 space-y-6 shadow-lg">
                <h3 class="text-xl font-semibold mb-4">Payment for Paper: {{ $paper->paper_title }}</h3>

                <p class="mb-2"><span class="font-semibold">Author:</span> {{ $paper->registration->user->name ?? '-' }} {{ $paper->registration->user->surname ?? '' }}</p>
                <p class="mb-4"><span class="font-semibold">Amount to Pay:</span> <span class="font-bold text-green-600">${{ $paper->payment_amount ?? '0.00' }}</span></p>

                <a href="#" class="inline-block px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
                    Proceed to Payment
                </a>

                <!-- Bank Info Box -->
                <div class="w-full mt-8 p-6 space-y-4 border border-gray-200 bg-gray-50 rounded-lg text-sm text-gray-700">
                    <div class="space-y-1">
                        <p class="font-bold text-gray-800 uppercase tracking-wide">Dollar Account Information</p>
                        <p><span class="font-semibold">Account owner:</span> YAZILIM VE SİBER GÜVENLİK DERNEĞİ</p>
                        <p><span class="font-semibold">IBAN NO:</span> TR59 0001 0015 6183 9337 9450 06 (Dollar)</p>
                        <p><span class="font-semibold">SWIFT code:</span> TCZBTR2AXXX</p>
                        <p class="pt-2"><span class="font-semibold">Account number:</span> 83933794-5006</p>
                        <p><span class="font-semibold">Bank branch:</span> 1561-İstasyon/Elazig-Turkey</p>
                    </div>

                    <hr class="border-gray-300" />

                    <div class="space-y-1">
                        <p class="font-bold text-gray-800">Turkish Lira Account Information</p>
                        <p class="italic text-gray-600">If you want to transfer the registration fee as Turkish Lira, you should convert Dollar into Turkish Lira course.</p>
                        <p class="pt-2"><span class="font-semibold">Account owner:</span> YAZILIM VE SİBER GÜVENLİK DERNEĞİ</p>
                        <p><span class="font-semibold">IBAN NO:</span> TR16 0001 0015 6183 9337 9450 04 (Turkish Lira)</p>
                        <p class="pt-2"><span class="font-semibold">Account number:</span> 83933794-5004</p>
                        <p><span class="font-semibold">Bank branch:</span> 1561-İstasyon/Elazig-Turkey</p>
                        <p class="pt-2"><span class="font-semibold">SWIFT code:</span> TCZBTR2AXXX</p>
                        <p class="pt-2"><span class="font-semibold">Bank Name:</span> Ziraat Bankasi Firat Subesi (Elazig)</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
