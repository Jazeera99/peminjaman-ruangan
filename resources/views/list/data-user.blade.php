@extends('layouts.main')

@section('content')
    {{-- @if (Auth::user()->role == 'admin') --}}
        <div class="d-flex flex-column">
            <div class="d-flex justify-content-between w-100 mb-3">
                @include('table.total-user')
            </div>
        </div>
    {{-- @endif --}}
    
    {{-- @if (Auth::user()->role == 'baak')
        <div class="d-flex flex-column">
            <div class="d-flex justify-content-between w-100 mb-3">s
                @include('table.user-baak')
            </div>
        </div>
    @endif

    @if (Auth::user()->role == 'sarpras')
        <div class="d-flex flex-column">
            <div class="d-flex justify-content-between w-100 mb-3">
                @include('table.user-sarpras')
            </div>
        </div>
    @endif --}}
@endsection
