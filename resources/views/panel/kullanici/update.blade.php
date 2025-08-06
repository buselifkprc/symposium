@extends('panel.layout.app')

@section('content')
    <div class="row mt-3">
        <div class="col-lg-6 mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">Paper Update</div>
                    <hr>
                    @if($errors->any())
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif
                    <form action="{{ route('kullanici.PaperUpdate') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="input-title">Title:</label>
                            <input type="text" class="form-control" id="input-title" name="paper_title" value="{{ old('paper_title', $paper->paper_title) }}">
                        </div>
                        <div class="form-group">
                            <label for="input-content">Paper:</label>
                            <textarea class="form-control" id="input-content" name="paper_content" rows="5">{{ old('paper_content', $paper->paper_content) }}</textarea>
                        </div>

                        <input type="hidden" value="{{ $paper->id }}" name="paperId">

                        <div class="form-group">
                            <button type="submit" class="btn btn-light px-5">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
