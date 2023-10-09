@extends('layouts.dashboard')
@section('page-title','Create A New Category')

@section('content')
    <div class="container">
 

        <form action="{{ route('categories.store') }}" method="post">
            @csrf
           
            @include('categories._form')
        </form>
    </div>
 
@endsection