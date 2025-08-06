<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 md:p-8">

                <div class="mb-8 text-center">
                    <h2 class="text-2xl font-bold text-gray-900">ISDFS 2025 - Participation Details</h2>
                    <p class="text-gray-600 mt-1">Welcome, <span class="font-semibold">{{ auth()->user()->name }}</span>! Please complete your registration.</p>
                </div>

                @if ($errors->any())
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Whoops! Something went wrong.</strong>
                        <ul class="mt-2 list-disc list-inside">@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>
                    </div>
                @endif

                <form action="{{ route('registration.store') }}" method="POST">
                    @csrf
                    <div class="space-y-6">

                        <!-- 1. Participation -->
                        <div class="p-4 border rounded-md">
                            <h3 class="text-lg font-semibold text-gray-700 mb-2">Participation *</h3>
                            <div class="space-y-2">
                                <label class="flex items-center"><input type="radio" name="participation_type" value="1" class="participation-radio" {{ old('participation_type', 'Listener (Main Conference)') == 'Listener (Main Conference)' ? 'checked' : '' }}><span class="ml-2">Listener (Main Conference)</span></label>
                                <label class="flex items-center"><input type="radio" name="participation_type" value="2" class="participation-radio" {{ old('participation_type') == 'Listener (WDIAA - Alteryx workshop session)' ? 'checked' : '' }}><span class="ml-2">Listener (WDIAA - Alteryx workshop session)</span></label>
                                <label class="flex items-center"><input id="p_have_paper" type="radio" name="participation_type" value="Have Paper" class="participation-radio" {{ old('participation_type') == 'Have Paper' ? 'checked' : '' }}><span class="ml-2">Have Paper</span></label>
                            </div>

                            <!-- DİNAMİK ALANIN DÜZELTİLMİŞ HALİ -->
                            <div id="paper-id-block" class="mt-4 pt-4 border-t border-gray-200">
                                <label for="paper_ids" class="block font-medium text-sm text-gray-700">Paper ID / Bildiri ID *</label>
                                <p class="text-xs text-gray-500 mb-1">If you have more than 1 paper, please specify other paper IDs in the note section below.</p>
                                <input id="paper_ids" class="block w-full border-gray-300 rounded-md shadow-sm" type="text" name="paper_ids" value="{{ old('paper_ids') }}">
                            </div>
                        </div>

                        <!-- 2. Type of Participation (IEEE Member, etc) -->
                        <div class="p-4 border rounded-md">
                            <h3 class="text-lg font-semibold text-gray-700 mb-2">Type of Participation </h3>
                            <div class="space-y-2">
                                @foreach(['IEEE Member', 'Non-IEEE Member', 'IEEE Student Member', 'Student Non-IEEE member'] as $type)
                                    <label class="flex items-center"><input type="radio" name="membership_type" value="{{ $type }}" class="form-radio" {{ old('membership_type') == $type ? 'checked' : '' }} required><span class="ml-2">{{ $type }}</span></label>
                                @endforeach
                            </div>
                        </div>

                        <!-- 3. Association Member -->
                        <div class="p-4 border rounded-md">
                            <h3 class="text-lg font-semibold text-gray-700 mb-2">Are you Association of Software and Cyber Security Members? </h3>
                            <div class="space-y-2">
                                <label class="flex items-center"><input type="radio" name="is_ascs_member" value="1" class="form-radio" {{ old('is_ascs_member') == '1' ? 'checked' : '' }} required><span class="ml-2">Yes</span></label>
                                <label class="flex items-center"><input type="radio" name="is_ascs_member" value="0" class="form-radio" {{ old('is_ascs_member') == '0' ? 'checked' : '' }}><span class="ml-2">No</span></label>
                            </div>
                        </div>

                        <div class="p-4 border rounded-md">
                            <h3 class="text-lg font-semibold text-gray-700 mb-2">Presentation Type </h3>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="radio" name="presentation_type" value="Face to Face" class="form-radio" {{ old('presentation_type') == 'Face to Face' ? 'checked' : '' }} required>
                                    <span class="ml-2">Face to Face</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="presentation_type" value="Remote-Live Presentation" class="form-radio" {{ old('presentation_type') == 'Remote-Live Presentation' ? 'checked' : '' }} required>
                                    <span class="ml-2">Remote-Live Presentation</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="presentation_type" value="Pre-Recorded Video" class="form-radio" {{ old('presentation_type') == 'Pre-Recorded Video' ? 'checked' : '' }} required>
                                    <span class="ml-2">Pre-Recorded Video</span>
                                </label>
                            </div>
                        </div>


                        <!-- 6. Extra Paper & Note -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="extra_paper_count" class="block font-medium text-sm text-gray-700">Extra Paper</label>
                                <input id="extra_paper_count" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" type="number" name="extra_paper_count" value="{{ old('extra_paper_count', 0) }}" min="0">
                            </div>
                            <div>
                                <label for="note" class="block font-medium text-sm text-gray-700">Note</label>
                                <textarea name="note" id="note" rows="3" class="border-gray-300 rounded-md shadow-sm block mt-1 w-full">{{ old('note') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end mt-8">
                        <button type="submit" class="ms-4 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                            SUBMIT REGISTRATION
                        </button>
                    </div>
                </form>

                <!-- Ödeme Bilgileri -->
                <div class="w-full mt-8 p-6 space-y-4 border border-gray-200 bg-gray-50 rounded-lg text-sm text-gray-700">
                    <div class="space-y-1">
                        <p class="font-bold text-gray-800 uppercase tracking-wide">Dollar Account Information</p>
                        <p><span class="font-semibold">Account owner:</span> YAZILIM VE SİBER GÜVENLİK DERNEĞİ</p>
                        <p><span class="font-semibold">IBAN NO:</span> TR59 0001 0015 6183 9337 9450 06 (Dollar)</p>
                        <p><span class="font-semibold">SWIFT code:</span> TCZBTR2AXXX</p>
                        <p class="pt-2"><span class="font-semibold">Account number:</span> 83933794-5006</p>
                        <p><span class="font-semibold">Bank branch:</span> 1561-İstasyon/Elazig-Turkey</p>
                        <br>
                    </div>
                    <hr class="border-gray-300" />
                    <div class="space-y-1">
                        <br>
                        <p class="font-bold text-gray-800">TURKISH LIRA ACCOUNT INFORMATİON </p>
                        <p class="italic text-gray-600">If you want to transfer the registration fee as Turkish Lira, you should convert Dollar into Turkish Lira course.</p>
                        <p class="pt-2"><span class="font-semibold">Account owner:</span> YAZILIM VE SİBER GÜVENLİK DERNEĞİ</p>
                        <p><span class="font-semibold">IBAN NO:</span> TR16 0001 0015 6183 9337 9450 04 (Turkish Lira)</p>
                        <p class="pt-2"><span class="font-semibold">Account number:</span> 83933794-5004</p>
                        <p><span class="font-semibold">Bank branch:</span> 1561-İstasyon/Elazig-Turkey</p>
                        <p class="pt-2"><span class="font-semibold">SWIFT code:</span> TCZBTR2AXXX</p>
                        <p class="pt-2"><span class="font-semibold">Bank Name:</span> Ziraat Bankasi Firat Subesi (Elazig)</p><br>
                    </div>
                    <hr class="border-gray-300" />
                    <div>
                        <br>
                        <p class="font-bold text-indigo-700">PayPal Payment Link will be Released at the end of Registration! (After Submit)</p>
                    </div>
                </div>

            </div>
        </div>
    </div>


        @push('scripts')
            <style>
                #paper-id-block { display: none; }
            </style>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const paperIdBlock = document.getElementById('paper-id-block');
                    const paperIdInput = document.getElementById('paper_ids');

                    function updateFormVisibility() {
                        const selected = document.querySelector('input[name="participation_type"]:checked');
                        if (!selected) {
                            paperIdBlock.style.display = 'none';
                            paperIdInput.removeAttribute('required');
                            return;
                        }

                        // Eğer value "1" veya "2" ise göster, değilse gizle
                        if (selected.value === "1" || selected.value === "2") {
                            paperIdBlock.style.display = 'block';
                            paperIdInput.setAttribute('required', 'required');
                        } else {
                            paperIdBlock.style.display = 'none';
                            paperIdInput.removeAttribute('required');
                        }
                    }

                    document.querySelectorAll('.participation-radio').forEach(radio => {
                        radio.addEventListener('change', updateFormVisibility);
                    });

                    // Sayfa yüklendiğinde çalıştır
                    updateFormVisibility();
                });

            </script>
        @endpush


</x-app-layout>
