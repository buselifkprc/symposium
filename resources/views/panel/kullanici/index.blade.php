@extends('panel.layout.app')

@section('content')
    <div class="row mt-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3>Paper List</h3>
                    <a href="{{ route('kullanici.PaperCreate') }}" class="btn btn-light px-5 mb-0">
                        <i class="icon-plus"></i> Create New Paper
                    </a>
                </div>
                <div class="card-body">
                    <form id="paper-select-form" action="{{ route('payment.page') }}" method="POST">
                        @csrf
                        <div class="table-responsive table-striped table-hover">
                            <table class="table align-middle">
                                <thead>
                                <tr>
                                    <th>Select</th>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Author Name Surname</th>
                                    <th>Author Email</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($papers as $p)
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="selected_papers[]" value="{{ $p->id }}" class="select-paper">
                                        </td>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $p->paper_title }}</td>
                                        <td>{{ ($p->registration->user->name ?? '-') . ' ' . ($p->registration->user->surname ?? '') }}</td>
                                        <td>{{ $p->registration->user->email ?? '-' }}</td>
                                        <td>
                                            <a href="{{ route('kullanici.PaperUpdatePage', $p->id) }}" class="btn btn-light btn-sm">Update</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Proceed to Payment Button -->
                        <div class="mt-4 text-center">
                            <button type="submit" id="proceed-btn" class="btn btn-success px-5" disabled>Proceed to Payment</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('paper-select-form');
            const checkboxes = document.querySelectorAll('.select-paper');
            const proceedBtn = document.getElementById('proceed-btn');

            function toggleButton() {
                // Checkbox'lardan en az birisi seçili mi kontrol et
                const anyChecked = Array.from(checkboxes).some(cb => cb.checked);
                proceedBtn.disabled = !anyChecked;
            }

            // Checkbox değişikliklerini dinle
            checkboxes.forEach(cb => cb.addEventListener('change', toggleButton));

            // Sayfa yüklendiğinde buton durumunu kontrol et
            toggleButton();

            // Submit sırasında yine kontrol et
            form.addEventListener('submit', function(e) {
                const selected = Array.from(checkboxes).filter(cb => cb.checked);
                if(selected.length === 0){
                    e.preventDefault();
                    alert("Please select at least one paper to proceed.");
                }
            });
        });

    </script>
@endpush
