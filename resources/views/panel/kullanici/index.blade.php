@extends('panel.layout.app')

@section('content')
    <div class="row mt-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3> Active Paper </h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-striped table-hover">
                        <table class="table align-middle">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Author Name Surname</th>
                                <th>Author Email</th>
                                <th>Payment</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($papers as $p)
                                <tr>
                                    <th scope="row">{{ $p->id }}</th>
                                    <td>{{ $p->paper_title }}</td>
                                    <td>{{ ($p->registration->user->name ?? '-') . ' ' . ($p->registration->user->surname ?? '') }}</td>
                                    <td>{{ $p->registration->user->email ?? '-' }}</td>
                                    <td>
                                        <a href="{{ route('payment.page', $p->id) }}" class="btn btn-outline-primary btn-sm d-flex flex-column align-items-center py-2">
                                            <span>Pay</span>
                                            <span>${{ $p->amount ?? '0.00' }}</span>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('kullanici.PaperUpdatePage', $p->id) }}" class="btn btn-light btn-sm">Update</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: "{{ session('success') }}",
                    timer: 2500,
                    timerProgressBar: true,
                    showConfirmButton: false
                });
            });
        </script>
    @endif
@endsection
