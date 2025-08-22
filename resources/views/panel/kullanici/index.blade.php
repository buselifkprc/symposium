@extends('panel.layout.app')

@section('content')
    <div class="row mt-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3>Paper List</h3>
                </div>
                <div class="card-body">
                    <a href="{{ route('kullanici.PaperCreate') }}" class="btn btn-light px-5 mb-4">
                        <i class="icon-plus"></i>Create New Paper
                    </a>
                    <div class="table-responsive table-striped table-hover">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Author Name Surname</th>
                                <th scope="col">Author Email</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($papers as $p)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $p->paper_title }}</td>
                                    <td>{{ ($p->registration->user->name ?? '-') . ' ' . ($p->registration->user->surname ?? '') }}</td>
                                    <td>{{ $p->registration->user->email ?? '-' }}</td>
                                    <td>
                                        <a href="{{ route('kullanici.PaperUpdatePage', $p->id) }}" class="btn btn-light">Update</a>
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
@endsection
