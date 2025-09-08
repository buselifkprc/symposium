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
                        <ul class="mt-2 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if($registration)
                    <form action="{{ route('registration.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="registration_id" value="{{ $registration->id }}">

                        <div class="space-y-6">

                            <!-- Phone Number & Degree Başta -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="phone_number" class="block font-medium text-sm text-gray-700">Phone Number</label>
                                    <input id="phone_number" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" type="text" name="phone_number" value="{{ old('phone_number', $registration->phone_number) }}">
                                </div>
                                <div>
                                    <label for="degree" class="block font-medium text-sm text-gray-700">Degree</label>
                                    <input id="degree" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" type="text" name="degree" value="{{ old('degree', $registration->degree) }}">
                                </div>
                            </div>

                            <!-- 1. Participation -->
                            <div class="p-4 border rounded-md">
                                <h3 class="text-lg font-semibold text-gray-700 mb-2">Participation *</h3>
                                <div class="space-y-2">
                                    <label class="flex items-center">
                                        <input type="radio" name="participation_type" value="Listener (Main Conference)" class="participation-radio" {{ old('participation_type', $registration->participation_type) == 'Listener (Main Conference)' ? 'checked' : '' }}>
                                        <span class="ml-2">Listener (Main Conference)</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="participation_type" value="Listener (WDIAA - Alteryx workshop session)" class="participation-radio" {{ old('participation_type', $registration->participation_type) == 'Listener (WDIAA - Alteryx workshop session)' ? 'checked' : '' }}>
                                        <span class="ml-2">Listener (WDIAA - Alteryx workshop session)</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="participation_type" value="Have Paper" class="participation-radio" {{ old('participation_type', $registration->participation_type) == 'Have Paper' ? 'checked' : '' }}>
                                        <span class="ml-2">Have Paper</span>
                                    </label>

                                    <div id="paper-id-block" class="mt-4 pt-4 border-t border-gray-200">
                                        <label for="paper_ids" class="block font-medium text-sm text-gray-700">Paper ID / Bildiri ID *</label>
                                        <p class="text-xs text-gray-500 mb-1">If you have more than 1 paper, please specify other paper IDs in the note section below.</p>
                                        <input id="paper_ids" class="block w-full border-gray-300 rounded-md shadow-sm" type="text" name="paper_ids" value="{{ old('paper_ids', $registration->paper_ids) }}">
                                    </div>
                                </div>
                            </div>

                            <!-- 2. Type of Participation -->
                            <div class="p-4 border rounded-md">
                                <h3 class="text-lg font-semibold text-gray-700 mb-2">Type of Participation</h3>
                                <div class="space-y-2">
                                    @foreach(['IEEE Member', 'Non-IEEE Member', 'IEEE Student Member', 'Student Non-IEEE member'] as $type)
                                        <label class="flex items-center">
                                            <input type="radio" name="membership_type" value="{{ $type }}" class="form-radio" {{ old('membership_type', $registration->membership_type) == $type ? 'checked' : '' }} required>
                                            <span class="ml-2">{{ $type }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <!-- 3. Association Member -->
                            <div class="p-4 border rounded-md">
                                <h3 class="text-lg font-semibold text-gray-700 mb-2">Are you Association of Software and Cyber Security Members?</h3>
                                <div class="space-y-2">
                                    <label class="flex items-center">
                                        <input type="radio" name="is_ascs_member" value="1" class="form-radio" {{ old('is_ascs_member', $registration->is_ascs_member) == '1' ? 'checked' : '' }} required>
                                        <span class="ml-2">Yes</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="is_ascs_member" value="0" class="form-radio" {{ old('is_ascs_member', $registration->is_ascs_member) == '0' ? 'checked' : '' }}>
                                        <span class="ml-2">No</span>
                                    </label>
                                </div>
                            </div>

                            <!-- 4. Presentation Type -->
                            <div class="p-4 border rounded-md">
                                <h3 class="text-lg font-semibold text-gray-700 mb-2">Presentation Type</h3>
                                <div class="space-y-2">
                                    @foreach(['Face to Face', 'Remote-Live Presentation', 'Pre-Recorded Video'] as $type)
                                        <label class="flex items-center">
                                            <input type="radio" name="presentation_type" value="{{ $type }}" class="form-radio" {{ old('presentation_type', $registration->presentation_type) == $type ? 'checked' : '' }} required>
                                            <span class="ml-2">{{ $type }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <!-- 5. Note -->
                            <div>
                                <label for="note" class="block font-medium text-sm text-gray-700">Note</label>
                                <textarea name="note" id="note" rows="3" class="border-gray-300 rounded-md shadow-sm block mt-1 w-full">{{ old('note', $registration->note) }}</textarea>
                            </div>

                        </div>

                        <div class="flex justify-end mt-8">
                            <button type="submit" class="ms-4 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                                UPDATE REGISTRATION
                            </button>
                        </div>
                    </form>
                @else
                    <p class="text-red-500">No registration data found for this paper.</p>
                @endif

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

                    if (selected.value === "Have Paper") {
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

                updateFormVisibility();
            });
        </script>
    @endpush

</x-app-layout>
