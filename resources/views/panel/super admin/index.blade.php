@extends('panel.layout.app')

@section('content')
    <!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Yönetimi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h1 class="mb-4">Super Admin Paneli - Admin Management</h1>

            <!-- Hata ve Başarı Mesajları -->
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Admin Olarak Atanabilecek Kullanıcılar Listesi -->
            <div class="card mb-5">
                <div class="card-header">
                    <h4>Assign as Admin</h4>
                </div>
                <div class="card-body">
                    <p class="text-muted">You can assign an existing user from the list below as an admin to the system.</p>
                    <table id="potentialAdminsTable" class="table table-striped" style="width:100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name Surname</th>
                            <th>E-mail</th>
                            <th class="text-center">Process</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($potentialAdmins as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }} {{ $user->surname }}</td>
                                <td>{{ $user->email }}</td>
                                <td class="text-center">
                                    <form action="{{ route('superadmin.admins.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                                        <button type="submit" class="btn btn-success btn-sm">Make Admin</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Mevcut Adminler Listesi -->
            <div class="card">
                <div class="card-header">
                    <h4>Current Admins</h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name Surname</th>
                            <th>E-mail</th>
                            <th class="text-center">Process</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($admins as $admin)
                            <tr>
                                <td>{{ $admin->id }}</td>
                                <td>{{ $admin->name }} {{ $admin->surname }}</td>
                                <td>{{ $admin->email }}</td>
                                <td class="text-center">
                                    <form action="{{ route('superadmin.admins.destroy', $admin->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to remove the admin role from this user? The user will not be deleted.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Remove Admin Role</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">There are no admins yet.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
    // DataTable'ı başlat
    $(document).ready(function() {
        $('#potentialAdminsTable').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/tr.json"
            }
        });
    });
</script>
</body>
</html>
@endsection
