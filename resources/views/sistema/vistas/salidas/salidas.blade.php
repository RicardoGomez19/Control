@extends('sistema.layout.layout')
@section('contenido')

{{-- <div class="col-lg-12 mb-4"> --}}
    
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            {{-- <h1 class="h3 mb-0 text-gray-800">Simple Tables</h1> --}}
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./">Home</a></li>
                <li class="breadcrumb-item">Tables</li>
                <li class="breadcrumb-item active" aria-current="page">Simple Tables</li>
            </ol>
        </div>
        
        
        
        
        <!-- Simple Tables -->
        <div class="row">
            <salidas-component></salidas-component>
        </div>
    </div>
{{-- </div> --}}
@endsection