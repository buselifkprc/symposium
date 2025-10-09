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
                    <button class="nav-link active" id="listener-tab" data-bs-toggle="tab" data-bs-target="#listener" type="button" role="tab" aria-controls="listener" aria-selected="true">Listener</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="register-tab" data-bs-toggle="tab" data-bs-target="#register" type="button" role="tab" aria-controls="register" aria-selected="false">Register</button>
                </li>
            </ul>

            <!-- Tab panes -->
             <div class="tab-content">
                <!-- Listener Sekmesi -->
                <div class="tab-pane active" id="listener" role="tabpanel" aria-labelledby="listener-tab">
                    <div class="table-responsive mt-3">
                        <table id="listenerTable" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Surname</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Institution</th>
                                <th>Degree</th>
                                <th>Participation</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($listeners as $listener)
                                <tr>
                                    <td>{{ $listener->id }}</td>
                                    <td>{{ $listener->name }}</td>
                                    <td>{{ $listener->surname }}</td>
                                    <td>{{ $listener->email }}</td>
                                    <td>{{ $listener->phone_number }}</td>
                                    <td>{{ $listener->institution }}</td>
                                    <td>{{ $listener->degree }}</td>
                                    <td>{{ $listener->participation_type }}</td> {{-- formdaki alanla eşleşti --}}
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                 <!-- Register Sekmesi -->
                 <div class="tab-pane" id="register" role="tabpanel" aria-labelledby="register-tab">
                     <div class="table-responsive mt-3">
                         <table id="registerTable" class="table table-striped table-bordered" style="width:100%">
                             <thead>
                             <tr>
                                 <th>ID</th>
                                 <th>Name Surname</th>
                                 <th>Email</th>
                                 <th>Phone Number</th>
                                 <th>Institution</th>
                                 <th>Degree</th>
                                 <th>Type of Participation</th>
                                 <th>ASCS Member?</th>
                                 <th>Presentation Type</th>
                                 <th>Extra Papers</th>
                                 <th>Note</th>
                             </tr>
                             </thead>
                             <tbody>
                             @foreach($registrations as $reg)
                                 <tr>
                                     <td>{{ $reg->id }}</td>
                                     <td>{{ $reg->user->name ?? '-' }} {{ $reg->user->surname ?? '' }}</td>
                                     <td>{{ $reg->user->email ?? '-' }}</td>
                                     <td>{{ $reg->user->phone_number ?? '-' }}</td>
                                     <td>{{ $reg->user->institution ?? '-' }}</td>
                                     <td>{{ $reg->user->degree ?? '-' }}</td>
                                     <td>{{ $reg->participation_type }}</td>
                                     <td>{{ $reg->is_ascs_member ? 'Yes' : 'No' }}</td>
                                     <td>{{ $reg->presentation_type ?? 'Yok' }}</td>
                                     <td>{{ $reg->extra_paper_count }}</td>
                                     <td>{{ $reg->note ?? '-' }}</td>
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
            $('#listenerTable').DataTable();
            $('#registerTable').DataTable();
        });

        $('button[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
            $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
        });
    </script>
@endsection
