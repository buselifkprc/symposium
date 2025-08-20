@extends('panel.layout.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Data Management</h3>
        </div>
        <div class="card-body">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="users-tab" data-bs-toggle="tab" data-bs-target="#users" type="button" role="tab" aria-controls="users" aria-selected="true">Users</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="registrations-tab" data-bs-toggle="tab" data-bs-target="#registrations" type="button" role="tab" aria-controls="registrations" aria-selected="false">Records</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="papers-tab" data-bs-toggle="tab" data-bs-target="#papers" type="button" role="tab" aria-controls="papers" aria-selected="false">Proceedings</button>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <!-- Kullanıcılar Sekmesi -->
                <div class="tab-pane active" id="users" role="tabpanel" aria-labelledby="users-tab">
                    <div class="table-responsive mt-3">
                        <table id="usersTable" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name Surname</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Institution</th>
                                <th>Degree</th>
                                <th>Role</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }} {{ $user->surname }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone_number }}</td>
                                    <td>{{ $user->institution }}</td>
                                    <td>{{ $user->degree }}</td>
                                    <td>{{ $user->getRoleNames()->first() }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Kayıtlar Sekmesi -->
                <div class="tab-pane" id="registrations" role="tabpanel" aria-labelledby="registrations-tab">
                    <div class="table-responsive mt-3">
                        <table id="registrationsTable" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>User Name</th>
                                <th>Participation Type</th>
                                <th>Membership Type</th>
                                <th>Presentation Type</th>
                                <th>Extra Paper Count</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($registrations as $reg)
                                <tr>
                                    <td>{{ $reg->id }}</td>
                                    <td>{{ $reg->user->name ?? 'User Not Found' }} {{ $reg->user->surname ?? '' }}</td>
                                    <td>{{ $reg->participation_type }}</td>
                                    <td>{{ $reg->membership_type }}</td>
                                    <td>{{ $reg->presentation_type ?? 'Yok' }}</td>
                                    <td>{{ $reg->extra_paper_count }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Bildiriler Sekmesi -->
                <div class="tab-pane" id="papers" role="tabpanel" aria-labelledby="papers-tab">
                    <div class="table-responsive mt-3">
                        <table id="papersTable" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Paper Title</th>
                                <th>Writer</th>
                                <th>Registration ID</th>
                                <th>Added Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($papers as $paper)
                                <tr>
                                    <td>{{ $paper->id }}</td>
                                    <td>{{ $paper->paper_title }}</td>
                                    <td>{{ $paper->registration->user->name ?? 'User Not Found' }} {{ $paper->registration->user->surname ?? '' }}</td>
                                    <td>{{ $paper->registration_id }}</td>
                                    <td>{{ $paper->created_at->format('d/m/Y H:i') }}</td>
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

@section('scripts')
    <script>
        $(document).ready(function() {
            // Her bir tabloyu DataTable olarak başlatıyoruz
            $('#usersTable').DataTable();
            $('#registrationsTable').DataTable();
            $('#papersTable').DataTable();
        });

        // Sekmeler arasında geçiş yapıldığında DataTable başlıklarının düzgün hizalanması için
        $('button[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
            $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
        });
    </script>
@endsection
