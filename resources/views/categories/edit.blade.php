 
 @extends('layouts.dashboard')
 @section('page-title','Edit Category')
 
 @section('content')
    <div class="container">
      <form action="{{ route('categories.update',$category->id) }}" method="post">
        @method('PUT')
        @csrf
        
        @include('categories._form')
      </form>
</div>
 @endsection