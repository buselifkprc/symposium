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

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input id="name" class="block mt-1 w-full capitalize-input" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>
            <div class="mt-4">
                <x-label for="surname" value="{{ __('Surname') }}" />
                <x-input id="surname" class="block mt-1 w-full capitalize-input" type="text" name="surname" :value="old('surname')" required autofocus autocomplete="family-name" />
            </div>

            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="institution" value="{{ __('Institution') }}" />
                <x-input id="institution" class="block mt-1 w-full capitalize-input" type="text" name="institution" :value="old('institution')" required autofocus autocomplete="organization" />
            </div>

            <div class="mt-4">
                <x-label for="phone_number" value="{{ __('Phone number') }}" />
                <x-input id="phone_number" class="block mt-1 w-full" type="text" name="phone_number" :value="old('phone_number')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
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
            </div>

           {{--  <li class="mt-4">
                <label class="description" for="katilim_turu"> Type of Participation  </label><br>
                <input name="katilim_turu" class="element radio" type="radio" value="1">
                    <label class="choice" for="katilim_turu_ieee_member">IEEE Member</label><br>
                    <input name="katilim_turu" class="element radio" type="radio" value="2">
                    <label class="choice" for="katilim_turu_non_ieee_member">Non-IEEE Member</label> <br>
                    <input name="katilim_turu" class="element radio" type="radio" value="3">
                    <label class="choice" for="katilim_turu_ieee_student_member">IEEE Student Member</label> <br>
                    <input name="katilim_turu" class="element radio" type="radio" value="4">
                    <label class="choice" for="katilim_turu_non_ieee_student_member">Student Non-IEEE member</label> <br>
              </li>
            <li class="highlighted mt-4"><label class="description" for="dernek_uyesi"> Are you Association of Software and Cyber Security Members  </label> <br>
                <span>
                    <input id="element_118_1" name="dernek_uyesi" class="element radio" type="radio" value="1" required="">
                    <label class="choice" for="dernek_uyesi_evet">Yes </label> <br>
                    <input id="element_118_2" name="dernek_uyesi" class="element radio" type="radio" value="0" required="">
                    <label class="choice" for="dernek_uyesi_hayır">No </label> <br>
                </span></li>
            <li class="mt-4">
                    <label class="description" for="ekstra_sayfa">Presentation Type </label> <br> <span>
                    <input id="element_10_1" name="ekstra_sayfa" class="element radio" type="radio" value="1" required="">
                    <label class="choice" for="ekstra_sayfa_1">Face to Face </label> <br>
                    <input id="element_10_2" name="ekstra_sayfa" class="element radio" type="radio" value="2" required="">
                    <label class="choice" for="ekstra_sayfa_2">Remote-Live Presentation</label> <br>
                    <input id="element_10_3" name="ekstra_sayfa" class="element radio" type="radio" value="3" required="">
                    <label class="choice" for="ekstra_sayfa_3">Pre-Recorded Video</label> <br>
                </span></li>

            <div class="mt-4">

                <x-label for="ozel_not" value="Note" />
                <textarea id="ozel_not"
                          name="ozel_not"
                          rows="4"
                          maxlength="250"
                          class="block w-full mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"></textarea>
            </div>
          --}}
            <div class="mt-4" x-data="{ show: false }">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password"
                         class="block mt-1 w-full"
                         x-bind:type="show ? 'text' : 'password'"
                         name="password"
                         required
                         autocomplete="new-password" />
                <label for="show_password" class="inline-flex items-center mt-2">
                    <x-checkbox id="show_password" x-model="show" />
                    <span class="ms-2 text-sm text-gray-600">Şifreyi Göster</span>
                </label>
            </div>

            <div class="mt-4" x-data="{ show: false }">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />

                <x-input id="password_confirmation"
                         class="block mt-1 w-full"
                         x-bind:type="show ? 'text' : 'password'"
                         name="password_confirmation"
                         required
                         autocomplete="new-password" />

                <label for="show_password_confirmation" class="inline-flex items-center mt-2">
                    <x-checkbox id="show_password_confirmation" x-model="show" />
                    <span class="ms-2 text-sm text-gray-600">Şifreyi Göster</span>
                </label>
            </div>

        @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ms-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ms-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
        {{--
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
                <p class="font-bold text-indigo-700">PayPal Payment Link will be Released at the end of Registration! (After Submit)</p>
            </div>

        </div>
        --}}
        <script>
            document.querySelectorAll('.capitalize-input').forEach(input => {
                input.addEventListener('input', function () {
                    let val = input.value;
                    input.value = val.charAt(0).toUpperCase() + val.slice(1);
                });
            });
        </script>

    </x-authentication-card>
</x-guest-layout>
