@extends('admin.app')
@section('title')
Category
 @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> Category</h1>
            {{-- <h1><i class="fa fa-tags"></i> Add Category</h1> --}}
        </div>
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="tile">
                <h3 class="tile-title">
               Edit Category
                    {{-- <span class="top-form-btn">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Category</button>
                        <a class="btn btn-secondary" href=""><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </span> --}}
                </h3>
                <hr>
                <form action="{{ route('admin.category.update',$category_details->id) }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="name">Name<span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" value="{{ $category_details->name  }}"/>
                            @error('name') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="image">Image<span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('image') is-invalid @enderror" type="file" name="image" id="image" value="{{ old('image') }}"/>
                            @error('image') {{ $message ?? '' }} @enderror
                        </div>
                        @if ($category_details->file_path)
                            <img src="{{ asset($category_details->file_path) }}" alt="" height="100" width="100">
                        @endif
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.category.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection