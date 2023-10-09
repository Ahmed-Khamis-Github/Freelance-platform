 @extends('layouts.dashboard')

@section('page-title')
@can('create','App\\Models\Category')
 
Categories  <small><a href="{{ route('categories.create') }}" class="btn btn-sm btn-outline-primary">create</a></small> 
 
@endcan
 
<small><a href="{{ route('trash') }}" class="btn btn-sm btn-outline-danger">trash</a></small> 
@endsection

@section('content')
 <div class="container">
    

    @if (Session::has('success'))
        <div class="alert alert-primary" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif
    
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>id</th>
                    <th>name</th>
                    <th>slug</th>
                    <th>parent_id</th>
                    <th>created_at</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>

                @foreach ( $categories as $category )                   
                <tr>
                    <td>{{ $category->id }}</td>
                    <td><a href={{ route('categories.show',$category->id) }} >{{ $category->name }}</a></td>
                    <td>{{ $category->slug; }}</td>
                    <td>{{ $category->parent->name }}</td>
                    <td>{{ $category->created_at }}</td>

                    @can('update',$category)

                    <td><a href="{{ route('categories.edit',$category->id) }}" class="btn btn-sm btn-dark">edit</a></td>

                    @endcan

                    @can('delete',$category)
                    <td>
                        <form action="{{ route('categories.destroy',$category->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                    @endcan
                </tr>
                @endforeach

            </tbody>
        </table>

    </div>
</div>

{{ $categories->withQueryString()->links() }}
@endsection
 
