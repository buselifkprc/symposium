@extends('panel.layout.app')

@section('content')

    <div class="row mt-3">
        <div class="col-lg-10 mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">Adding Paper</div>
                    <hr>

                    <form action="{{ route('kullanici.PaperAdd') }}" method="POST">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="paper-title">Title:</label>
                            <input type="text" class="form-control" id="paper-title" name="paper_title" value="{{ old('paper_title') }}">
                        </div>

                        <div class="form-group mb-3">
                            <label for="paper-content">Paper:</label>
                            <textarea class="form-control" id="paper-content" name="paper_content" rows="20" style="height: 500px;">{{ old('paper_content') }}</textarea>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-light px-5">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
