@extends('admin.app')
@section('title')
Governor
 @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> Governor</h1>
            {{-- <h1><i class="fa fa-tags"></i> Add Category</h1> --}}
        </div>
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="tile">
                <h3 class="tile-title">
               Edit Governor Details
                    {{-- <span class="top-form-btn">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Category</button>
                        <a class="btn btn-secondary" href=""><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </span> --}}
                </h3>
                <hr>
                <form action="{{ route('admin.governor.update',$governor_details->id) }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="name">Name<span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" value="{{ $governor_details->name ?? old('name') }}"/>
                            @error('name') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="designation">Designation<span class="m-l-5 text-danger"> *</span></label>
                            <input type="text" name="designation" id="designation" class="form-control @error('designation') is-invalid @enderror" value="{{ $governor_details->designation ?? old('designation') }}">
                            @error('designation') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="email">Email<span class="m-l-5 text-danger"> *</span></label>
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ $governor_details->email }}">
                            @error('email') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="mobile_no">Mobile no<span class="m-l-5 text-danger"> *</span></label>
                            <input type="number" name="mobile_no" id="mobile_no" class="form-control @error('mobile_no') is-invalid @enderror" value="{{ $governor_details->mobile_no }}">
                            @error('mobile_no') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="start_year">Terms Start Year</label>
                            <select name="start_year" id="start_year" class="form-control @error('start_year') is-invalid @enderror">
                                @if ($governor_details->tearms_start_year)
                                    <option value="{{ $governor_details->tearms_start_year }}">{{ $governor_details->tearms_start_year }}</option>
                                @else
                                    <option value="">Select start year</option>
                                @endif
                               
                            </select>
                            <input type="hidden" id="selected_start_year" value="{{ $governor_details->tearms_start_year }}">
                            @error('start_year') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="end_year">Terms End Year</label>
                            <select name="end_year" id="end_year" class="form-control @error('end_year') is-invalid @enderror">
                                @if ($governor_details->tearms_end_year)
                                    <option value="{{ $governor_details->tearms_end_year }}">{{ $governor_details->tearms_end_year }}</option>
                                @else
                                    <option value="">Select end year</option>
                                @endif
                            </select>
                            <input type="hidden" id="selected_start_year" value="{{ $governor_details->tearms_end_year }}">
                            @error('end_year') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="image">Image<span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('image') is-invalid @enderror" type="file" name="image" id="image" value="{{ old('image') }}"/>
                            @if ($governor_details->file_path)
                                <img src="{{ asset($governor_details->file_path) }}" alt="" height="80" width="100">
                            @endif
                            @error('image') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.event.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script>
        for (i = new Date().getFullYear(); i > 1970; i--)
        {
            var selected_start_year = $('#selected_start_year').val();
            var selected_end_year = $('#selected_end_year').val();
            if (i != selected_start_year) {
                $('#start_year').append($('<option />').val(i).html(i));
            }
            if (i != selected_end_year) {
                $('#end_year').append($('<option />').val(i).html(i));
            }
            
        }
    </script>
@endpush