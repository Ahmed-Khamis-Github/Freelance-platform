@extends('layouts.dashboard')

@section('page-title')
    Deleted Categories <small><a href="{{ route('categories.index') }}"
            class="btn btn-sm btn-outline-primary">Index</a></small>
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
                        <th>deleted_at</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>

                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td><a href={{ route('categories.show', $category->id) }}>{{ $category->name }}</a></td>
                            <td>{{ $category->slug }}</td>
                            <td>{{ $category->parent->name }}</td>
                            <td>{{ $category->deleted_at }}</td>
                            <td>
                                <form action="{{ route('restore', $category->id) }}" method="post">
                                    @csrf
                                    @method('put')
                                    <button type="submit" class="btn btn-sm btn-info">Restore</button>
                                </form>
                            </td>
                            <td>
                                <form action="{{ route('forceDelete', $category->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Perma Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>

        </div>
    </div>

    {{ $categories->withQueryString()->links() }}
@endsection
