@extends('layouts.app')

@section('title', 'List')

@section('content')

<div class="card mt-2">

    <div class="card-header">
      Create Category
    </div>

    @if (session('statusCategory'))
        <div class="alert alert-success">
            {{ session('statusCategory') }}
        </div>
    @endif

    <div class="card-body">
        <form action="{{ route('category.create') }}" method="POST">
            @csrf
    
            <div class="form-group col-md-6">
                <label for="category_name">Category Name</label>
                <input type="text" class="form-control" id="category_name" name="category_name">

                <button type="submit" class="btn btn-primary mt-2">Create</button>
            </div>
        </form>
    </div>

</div>

<div class="card mt-2">

    <div class="card-header">
      List all categories, subcategories and products
    </div>

    @if (session('statusSubcategory'))
        <div class="alert alert-success">
            {{ session('statusSubcategory') }}
        </div>
    @endif

    @if (session('statusProduct'))
        <div class="alert alert-success">
            {{ session('statusProduct') }}
        </div>
    @endif

    @if (session('update'))
        <div class="alert alert-success">
            {{ session('update') }}
        </div>
    @endif
    
    <div class="card-body">
        <ul class="list-group mt-2">
            @isset($categories)
        
                @foreach($categories as $category)
                <div class="form-group row">
                    <div class="col-md-6 mt-2">
                        <label for="subcategory_name">Category:</label>
                        <li class="list-group-item"><span class="badge badge-secondary">{{ $category->category_name }}</span> : {{ $category->category_url }} <a href="/category/edit/{{ $category->id }}" class="btn btn-primary btn-sm">Edit</a></li>
                    </div>
        
                    <div class="col-md-6">
                        <label for="subcategory_name">Subcategory Name</label>
                        <form class="form-inline" action="{{ route('subcategory.create') }}" method="POST">
                            @csrf

                            <div class="form-group mx-sm-3 mb-2">
                              <input type="hidden" name="categoryId" value="{{ $category->id }}">
                              <input type="text" class="form-control" id="subcategory_name" name="subcategory_name">
                            </div>

                            <button type="submit" class="btn btn-primary mb-2">Create</button>
                        </form>
                    </div>
                </div>

                <!--- Subcategories list -->
                <div class="card">
                    
                    <div class="card-body">
                        <div class="col-md-12 mt-2">
                            <ul class="list-group mt-2">
                                @foreach($category->subcategories as $subcategory)
                                <h6 class="h6"><strong>Subcategory:</strong></h6>
                                <div class="form-group row">
                                    <div class="col-md-6 mt-2">
                                        <li class="list-group-item"><span class="badge badge-secondary">{{ $subcategory->subcategory_name }}</span> : {{ $subcategory->subcategory_url }}</li>
                                    </div>
        
                                    <div class="col-md-6">
                                        <label for="product_name">Product Name</label>
                                        <form class="form-inline" action="{{ route('product.create') }}" method="POST">
                                            @csrf
                
                                            <div class="form-group mx-sm-3 mb-2">
                                              <input type="hidden" name="subcategoryId" value="{{ $subcategory->id }}">
                                              <input type="text" class="form-control" id="product_name" name="product_name">
                                            </div>
                
                                            <button type="submit" class="btn btn-primary mb-2">Create</button>
                                        </form>
                                    </div>
                                </div>

                                
                                <div class="card-body">
                                    <h6 class="h6"><strong>Product:</strong></h6>
                                    <div class="col-md-12 mt-2">
                                        <ul class="list-group mt-2">
                                            @foreach($subcategory->products as $product)
                                            <div class="col-md-6 mt-2">
                                                <li class="list-group-item"><span class="badge badge-secondary">{{ $product->product_name }}</span> : {{ $product->product_url }}</li>
                                            </div>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>    
                                
                                    
                                @endforeach
                            </ul>
                        </div>
                    </div>
                  </div>
                

                &nbsp;
                    
                @endforeach
        
            @endisset
            
        </ul>
    </div>

</div>


@endsection
