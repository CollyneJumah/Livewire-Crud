@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-dark text-white">{{ __('Registered Students') }}
                    {{-- <span class="float-right"><input type="text" wire:model="searchStudent" class="form-control" placeholder="search..."></span> --}}
                </div>
                  
                    @if (session()->has('message'))
                        <div class="alert alert-success" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif
                <div class="card-body">
                        @livewire('students')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
