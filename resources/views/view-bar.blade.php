@extends('layouts.master')

@section('title', 'Zigzag Bar')

@section('content')
<div class="row">
    <div class="col-sm-6">
        <div class="card" style="margin-bottom:30px;">
            <div class="card-header">
                CARD TITLE HEADING
            </div>
            <div class="card-body">
				<div class="alert alert-success">
					<strong>Enkripsi kata</strong><br>
					Dengan cara menggeser sebanyak <strong>n</strong> dari huruf awal
				</div>
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <h4>Error occured!</h4>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form method="POST" action="{{ url('zigzag/bar') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="plaintext">Plain Text:</label>
                        <input type="text" class="form-control" placeholder="Enter plaintext" name="plaintext" id="plaintext">
                    </div>
                    <div class="form-group">
                        <label for="sliding_key">Key:</label>
                        <input type="number" class="form-control" placeholder="Enter sliding key with number" name="sliding_key" id="sliding_key">
                    </div>
                    <button type="submit" id="btn-submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="card-footer">Card Footer</div>
        </div>
    </div>
</div>
@endsection
