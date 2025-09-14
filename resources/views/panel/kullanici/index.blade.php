@extends('panel.layout.app')

@section('content')
    <div class="row mt-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3> Active Paper </h3> {{-- Başlık değiştirildi --}}
                    <a href="{{ route('kullanici.PaperCreate') }}" class="btn btn-primary px-5 mb-0"> {{-- Buton daha belirgin --}}
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
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Author Name Surname</th>
                                    <th>Author Email</th>
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
                                            <a href="{{ route('kullanici.PaperUpdatePage', $p->id) }}" class="btn btn-light btn-sm">Update</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
