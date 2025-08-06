<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Registration Summary
        </h2>
    </x-slot>

    <div class="py-12 max-w-4xl mx-auto">
        <div class="bg-white shadow-xl rounded-lg p-6 space-y-4">
            <h3 class="text-xl font-semibold">Thank you for registering!</h3>

            <ul class="list-disc list-inside text-gray-700 space-y-2">
                <li><strong>Participation Type:</strong> {{ $data['participation_type'] }}</li>
                @if(isset($data['paper_ids']))
                    <li><strong>Paper ID(s):</strong> {{ $data['paper_ids'] }}</li>
                @endif
                <li><strong>Membership Type:</strong> {{ $data['membership_type'] }}</li>
                <li><strong>ASCS Member:</strong> {{ $data['is_ascs_member'] == '1' ? 'Yes' : 'No' }}</li>
                <li><strong>Extra Paper Count:</strong> {{ $data['extra_paper_count'] }}</li>
                <li><strong>Note:</strong> {{ $data['note'] ?? '-' }}</li>
            </ul>

            {{-- <div class="mt-6">
                <a href="{{ route('dashboard') }}" class="text-indigo-600 hover:underline">Back to Home</a>
            </div>--}}
        </div>
    </div>
</x-app-layout>
