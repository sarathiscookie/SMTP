@extends('layouts.app')

@section('title', 'List')

@section('content')

<div class="card mt-2">

    <div class="card-header">
      Edit Category
    </div>

    <div class="card-body">
        @isset($category)
        <form action="{{ route('category.update', ['id' => $category->id]) }}" method="POST">
            @csrf
    
            <div class="form-group col-md-6">
                <label for="category_name">Category Name</label>
                <input type="text" class="form-control" id="category_name" name="category_name" value="{{ $category->category_name }}">

                <button type="submit" class="btn btn-primary mt-2">Update</button>
            </div>
        </form>
        @endisset
    </div>

</div>


@endsection
