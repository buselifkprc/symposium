<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <div class="flex flex-col items-center">
                <img src="{{ asset('panel/assets/images/logos/ısdfs.png') }}"
                     alt="Site Logosu"
                     class="rounded-full object-cover" style="height: 100px; width: 100px;">
                <h2 class="mt-4 text-sm font-semibold text-gray-700">
                    International Symposium on Digital Forensics and Security
                </h2>
            </div>
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form id="listenerForm" method="POST" action="{{ route('listener.register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input id="name" class="block mt-1 w-full capitalize-input" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <!-- Surname -->
            <div class="mt-4">
                <x-label for="surname" value="{{ __('Surname') }}" />
                <x-input id="surname" class="block mt-1 w-full capitalize-input" type="text" name="surname" :value="old('surname')" required autocomplete="family-name" />
            </div>

            <!-- Email -->
            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            </div>

            <!-- Institution -->
            <div class="mt-4">
                <x-label for="institution" value="{{ __('Institution') }}" />
                <x-input id="institution" class="block mt-1 w-full capitalize-input" type="text" name="institution" :value="old('institution')" required autocomplete="organization" />
            </div>

            <!-- Phone Number -->
            <div class="mt-4">
                <x-label for="phone_number" value="{{ __('Phone number') }}" />
                <x-input id="phone_number" class="block mt-1 w-full" type="text" name="phone_number" :value="old('phone_number')" required />
            </div>

            <!-- Degree -->
            <li class="mt-4">
                <label class="description" for="unvan"> Degree </label><br>
                <input name="unvan" id="unvan_dr" class="element radio" type="radio" value="1" required>
                <label class="choice" for="unvan_dr">Ph. D.</label><br>
                <input name="unvan" id="unvan_yrd_doc" class="element radio" type="radio" value="2" required>
                <label class="choice" for="unvan_yrd_doc">Assistant Professor</label><br>
                <input name="unvan" id="unvan_doc_dr" class="element radio" type="radio" value="3" required>
                <label class="choice" for="unvan_doc_dr">Associate Professor</label><br>
                <input name="unvan" id="unvan_prof_dr" class="element radio" type="radio" value="4" required>
                <label class="choice" for="unvan_prof_dr">Professor</label><br>
                <input name="unvan" id="unvan_uzman" class="element radio" type="radio" value="5" required>
                <label class="choice" for="unvan_uzman">Expert / Student / Other</label>
            </li>

            <!-- Participation -->
            <li class="mt-4">
                <label class="description" for="participation_type"> Participation </label><br>
                <input name="participation_type" id="participation_listener_main" class="element radio" type="radio" value="1" required>
                <label class="choice" for="participation_listener_main">Main Conference</label><br>

                <input name="participation_type" id="participation_listener_wdiaa" class="element radio" type="radio" value="2" required>
                <label class="choice" for="participation_listener_wdiaa">WDIAA – ... workshop session</label><br>
                <input name="participation_type" id="participation_listener_elif" class="element radio" type="radio" value="3" required>
                <label class="choice" for="participation_listener_elif">Elif</label><br>

                <input name="participation_type" id="participation_listener_murat" class="element radio" type="radio" value="4" required>
                <label class="choice" for="participation_listener_murat">Murat</label><br>

                 <input name="participation_type" id="participation_listener_buse" class="element radio" type="radio" value="5" required>
                 <label class="choice" for="participation_listener_buse">Buse</label><br>

                {{--  <div class="mt-2 ">
                     <x-input id="listener_paper" class="block mt-1 w-full" type="text" name="listener_paper" :value="old('listener_paper')" placeholder="Enter the paper title you will listen to" />
                 </div> --}}
            </li>

            <div class="flex items-center justify-end mt-6">
                <x-button type="submit" class="ms-4">
                    {{ __('Submit') }}
                </x-button>
            </div>
        </form>

        <!-- SweetAlert -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Capitalize input
                document.querySelectorAll('.capitalize-input').forEach(input => {
                    input.addEventListener('input', function () {
                        let val = input.value;
                        input.value = val.charAt(0).toUpperCase() + val.slice(1);
                    });
                });
                const form = document.getElementById('listenerForm');

                form.addEventListener('submit', function (e) {
                    e.preventDefault();
                    const formData = new FormData(form);

                    fetch(form.action, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: formData
                    })
                        .then(async response => {
                            const data = await response.json();

                            if (response.ok) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: data.success,
                                    confirmButtonText: 'OK'
                                });
                                form.reset();
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    html: Object.values(data.errors).flat().join('<br>')
                                });
                            }
                        })
                        .catch(error => {
                            console.error(error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Something went wrong!'
                            });
                        });
                });
            });
        </script>
    </x-authentication-card>
</x-guest-layout>
