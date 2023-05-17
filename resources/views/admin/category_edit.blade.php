@extends('admin.layout.app')

@section('heading', 'Edit Category')

@section('button')
    <a href="{{ route('admin_category_show') }}" class="btn btn-primary"><i class="fas fa-eye"></i> Back To View Page</a>
@endsection

@section('main_content')
    <div class="section-body">
        <form action="{{ route('admin_category_update', $categories->id) }}" method="post">
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label>Category Name *</label>
                                <input type="text" class="form-control" name="category_name" value="{{ $categories->category_name }}">
                            </div>
                            <div class="form-group mb-3">
                                <label>Show on menu?</label>
                                <select name="show_on_menu" class="form-control">
                                    <option value="Show" @if($categories->show_on_menu == 'Show') selected @endif>Show</option>
                                    <option value="Hide" @if($categories->show_on_menu == 'Hide') selected @endif>Hide</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label>Category Order *</label>
                                <input type="text" class="form-control" name="category_order" value="{{ $categories->category_order }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

@endsection
