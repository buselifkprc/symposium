<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 md:p-8">
                <div class="mb-8 text-center">
                    <h2 class="text-2xl font-bold text-gray-900">ISDFS 2026 - Participation Details</h2>
                    <p class="text-gray-600 mt-1">
                        Welcome,
                        <span class="font-semibold">
            {{ auth()->user()->name }} {{ auth()->user()->surname }}
        </span>!
                        Please complete your registration.
                    </p>
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
                    <form action="{{ route('user.registration.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="registration_id" value="{{ $registration->id }}">

                        <div class="space-y-6">

                            <!-- Phone Number -->
                            <div class="p-4 border rounded-md">
                                <h3 class="text-lg font-semibold text-gray-700 mb-2">Phone Number</h3>
                                <div class="space-y-2">
                                    <input id="phone_number"
                                           class="block mt-1 w-full border-gray-300 rounded-md shadow-sm"
                                           type="text"
                                           name="phone_number"
                                           pattern="[0-9]+"
                                           title="Please enter numbers only"
                                           value="{{ old('phone_number', $registration->phone_number) }}"
                                           required>
                                </div>
                            </div>

                            <!-- Degree -->
                            <div class="p-4 border rounded-md">
                                <h3 class="text-lg font-semibold text-gray-700 mb-2">Degree</h3>
                                <div class="space-y-2">
                                    <label class="flex items-center">
                                        <input name="unvan" id="unvan_dr" class="form-radio text-indigo-600 border-gray-300"
                                               type="radio" value="1" {{ old('unvan', $registration->unvan) == 1 ? 'checked' : '' }} required>
                                        <span class="ml-2">Ph. D.</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input name="unvan" id="unvan_yrd_doc" class="form-radio text-indigo-600 border-gray-300"
                                               type="radio" value="2" {{ old('unvan', $registration->unvan) == 2 ? 'checked' : '' }} required>
                                        <span class="ml-2">Assistant Professor</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input name="unvan" id="unvan_doc_dr" class="form-radio text-indigo-600 border-gray-300"
                                               type="radio" value="3" {{ old('unvan', $registration->unvan) == 3 ? 'checked' : '' }} required>
                                        <span class="ml-2">Associate Professor</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input name="unvan" id="unvan_prof_dr" class="form-radio text-indigo-600 border-gray-300"
                                               type="radio" value="4" {{ old('unvan', $registration->unvan) == 4 ? 'checked' : '' }} required>
                                        <span class="ml-2">Professor</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input name="unvan" id="unvan_uzman" class="form-radio text-indigo-600 border-gray-300"
                                               type="radio" value="5" {{ old('unvan', $registration->unvan) == 5 ? 'checked' : '' }} required>
                                        <span class="ml-2">Expert / Student / Other</span>
                                    </label>
                                </div>
                            </div>


                            <!--  Participation -->
                            {{-- <div class="p-4 border rounded-md">
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
                            </div> --}}

                            <!-- Type of Participation -->
                            <div class="p-4 border rounded-md">
                                <h3 class="text-lg font-semibold text-gray-700 mb-2">Type of Participation</h3>
                                <div class="space-y-2">
                                    @foreach(['IEEE Member', 'Non-IEEE Member', 'IEEE Student Member', 'Student Non-IEEE member'] as $type)
                                        <label class="flex items-center">
                                            <input
                                                type="radio"
                                                name="membership_type"
                                                value="{{ $type }}"
                                                class="form-radio membership-radio"
                                                {{ old('membership_type', $registration->membership_type) == $type ? 'checked' : '' }}
                                                required
                                            >
                                            <span class="ml-2">{{ $type }}</span>
                                        </label>
                                    @endforeach
                                </div>

                                <!-- Dosya yükleme alanları -->
                                <div id="ieeeFile" class="mt-4 hidden">
                                    <label for="ieee_certificate" class="block font-medium text-sm text-gray-700"> IEEE Membership Certificate</label>
                                    <input type="file" id="ieee_certificate" name="ieee_certificate" class="block w-full border-gray-300 rounded-md shadow-sm mt-1">
                                </div>

                                <div id="studentFile" class="mt-4 hidden">
                                    <label for="student_certificate" class="block font-medium text-sm text-gray-700"> Student Certificate</label>
                                    <input type="file" id="student_certificate" name="student_certificate" class="block w-full border-gray-300 rounded-md shadow-sm mt-1">
                                </div>
                            </div>

                            <script>
                                document.addEventListener('DOMContentLoaded', function () {
                                    const radios = document.querySelectorAll('.membership-radio');
                                    const ieeeFile = document.getElementById('ieeeFile');
                                    const studentFile = document.getElementById('studentFile');

                                    function toggleFields() {
                                        const selected = document.querySelector('input[name="membership_type"]:checked');
                                        if (!selected) return;

                                        // Hepsini gizle
                                        ieeeFile.classList.add('hidden');
                                        studentFile.classList.add('hidden');

                                        if (selected.value === 'IEEE Member') {
                                            ieeeFile.classList.remove('hidden');
                                        } else if (selected.value === 'IEEE Student Member') {
                                            ieeeFile.classList.remove('hidden');
                                            studentFile.classList.remove('hidden');
                                        } else if (selected.value === 'Student Non-IEEE member') {
                                            studentFile.classList.remove('hidden');
                                        }
                                        // Non-IEEE Member seçilirse hiçbiri açılmaz
                                    }

                                    radios.forEach(radio => {
                                        radio.addEventListener('change', toggleFields);
                                    });

                                    // Sayfa yüklendiğinde eski seçim varsa ona göre aç
                                    toggleFields();
                                });
                            </script>


                            <!-- Association Member -->
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

                            <!--  Presentation Type -->
                            <div class="p-4 border rounded-md">
                                <h3 class="text-lg font-semibold text-gray-700 mb-2">Presentation Type</h3>
                                <div class="space-y-2">
                                    @foreach(['Face to Face', 'Remote-Live Presentation', 'Pre-Recorded Video'] as $type)
                                        <label class="flex items-center">
                                            <input type="radio"
                                                   name="presentation_type"
                                                   value="{{ $type }}"
                                                   class="form-radio"
                                                   {{ old('presentation_type', $registration->presentation_type) == $type ? 'checked' : '' }} required>
                                            <span class="ml-2">{{ $type }}</span>
                                        </label>
                                    @endforeach
                                </div>

                                <!-- Sunacak kişinin adı inputu -->
                                <div class="mt-4">
                                    <label for="presenter_name" class="block font-medium text-sm text-gray-700">
                                        Enter Presenter Name
                                    </label>
                                    <input id="presenter_name"
                                           name="presenter_name"
                                           type="text"
                                           class="block w-full border-gray-300 rounded-md shadow-sm mt-1"
                                           value="{{ old('presenter_name', $registration->presenter_name ?? '') }}">
                                </div>
                            </div>

                            <!-- Other Papers -->
                            <div class="mt-6 p-4 border rounded-md">
                                <label class="block text-lg font-semibold text-gray-700 mb-2">
                                    Extra Papers
                                </label>

                                <div class="flex items-center space-x-2 mb-4">
                                    <select id="paperSelect"
                                            class="block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        <option value="">-- Select a paper --</option>
                                        @foreach($otherPapers as $p)
                                            @php
                                                $shortTitle = strlen($p->paper_title) > 40 ? substr($p->paper_title, 0, 40) . '...' : $p->paper_title;
                                            @endphp
                                            <option value="{{ $p->id }}">{{ $p->id }} - {{ $shortTitle }}</option>
                                        @endforeach
                                        <option value="other" class="font-semibold text-indigo-700">-- Other --</option>
                                    </select>
                                    <button type="button" id="addPaperBtn"
                                            class="px-3 py-1 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                                        Add
                                    </button>
                                </div>

                                <!-- Yeni paper oluşturma alanı -->
                                <div id="createPaperForm" class="hidden space-y-3 border rounded-md p-3 bg-gray-50">
                                    <h3 class="font-semibold text-gray-700">Create New Paper</h3>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600">Paper ID</label>
                                        <input type="text" id="newPaperId"
                                               class="mt-1 w-full border-gray-300 rounded-md shadow-sm bg-gray-100 text-gray-600 cursor-not-allowed"
                                               readonly>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600">Paper Title</label>
                                        <input type="text" id="newPaperTitle"
                                               class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600">Paper Content</label>
                                        <textarea id="newPaperContent"
                                                  class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                                  rows="3"></textarea>
                                    </div>
                                    <button type="button" id="createPaperBtn"
                                            class="px-3 py-1 bg-green-600 text-white rounded-md hover:bg-green-700">
                                        Create Paper
                                    </button>
                                </div>

                                <!-- Seçilen paperların listesi -->
                                <div id="selectedPapers" class="flex flex-wrap gap-2 mt-4"></div>
                            </div>

                            <script>
                                document.addEventListener('DOMContentLoaded', function () {
                                    const addBtn = document.getElementById('addPaperBtn');
                                    const select = document.getElementById('paperSelect');
                                    const selectedContainer = document.getElementById('selectedPapers');
                                    const createForm = document.getElementById('createPaperForm');
                                    const createBtn = document.getElementById('createPaperBtn');
                                    const idInput = document.getElementById('newPaperId');

                                    // Dropdown değişince kontrol
                                    select.addEventListener('change', () => {
                                        if (select.value === 'other') {
                                            // Yeni ID otomatik hesapla
                                            idInput.value = getNextNumericId();
                                            createForm.classList.remove('hidden');
                                        } else {
                                            createForm.classList.add('hidden');
                                        }
                                    });

                                    // Var olan paper ekleme
                                    addBtn.addEventListener('click', function () {
                                        const selectedId = select.value;
                                        const selectedText = select.options[select.selectedIndex].text;

                                        if (!selectedId || selectedId === 'other') return;

                                        if (document.querySelector(`input[value="${selectedId}"]`)) {
                                            alert("This paper is already added!");
                                            return;
                                        }

                                        addBadge(selectedId, selectedText);
                                    });

                                    // Yeni paper oluşturma
                                    createBtn.addEventListener('click', () => {
                                        const id = idInput.value.trim();
                                        const title = document.getElementById('newPaperTitle').value.trim();
                                        const content = document.getElementById('newPaperContent').value.trim();

                                        if (!title || !content) {
                                            alert("Please fill in all fields!");
                                            return;
                                        }

                                        const text = `${id} - ${title}`;
                                        addBadge(id, text);

                                        // Dropdown'a da yeni paper'ı ekle
                                        const newOption = document.createElement('option');
                                        newOption.value = id;
                                        newOption.text = text;
                                        select.insertBefore(newOption, select.lastElementChild); // "Other"dan önce ekle

                                        // Form alanlarını sıfırla
                                        document.getElementById('newPaperTitle').value = '';
                                        document.getElementById('newPaperContent').value = '';
                                        createForm.classList.add('hidden');
                                        select.value = '';
                                    });

                                    // ID hesaplama (mevcut en büyük + 1)
                                    function getNextNumericId() {
                                        let maxId = 0;
                                        document.querySelectorAll('#paperSelect option').forEach(opt => {
                                            const val = parseInt(opt.value);
                                            if (!isNaN(val) && val > maxId) {
                                                maxId = val;
                                            }
                                        });
                                        return maxId + 1;
                                    }

                                    // Badge oluşturma fonksiyonu
                                    function addBadge(id, text) {
                                        const div = document.createElement('div');
                                        div.className = "flex items-center space-x-2 bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full shadow text-sm font-medium";

                                        const hiddenInput = document.createElement('input');
                                        hiddenInput.type = 'hidden';
                                        hiddenInput.name = 'selected_papers[]';
                                        hiddenInput.value = id;

                                        const span = document.createElement('span');
                                        span.textContent = text;

                                        const removeBtn = document.createElement('button');
                                        removeBtn.type = 'button';
                                        removeBtn.innerHTML = "&times;";
                                        removeBtn.className = "ml-2 text-red-600 font-bold hover:text-red-800";
                                        removeBtn.addEventListener('click', () => div.remove());

                                        div.appendChild(hiddenInput);
                                        div.appendChild(span);
                                        div.appendChild(removeBtn);
                                        selectedContainer.appendChild(div);
                                    }
                                });
                            </script>



                            <!--  Note -->
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
