@extends('layouts.main')

@section('content')
        <div class="d-flex flex-column">
            <div class="d-flex justify-content-between w-100 mb-3">
                @include('table.total-ruangan')
            </div>
        </div>
@endsection
