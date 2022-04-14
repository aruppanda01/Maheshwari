@extends('admin.app')
@section('title') Dashboard @endsection
@section('content')

<style type="text/css">
    .row-md-body.no-nav {
        margin-top: 70px;
    } 
    .section-mg a{
        text-decoration: none;
    }  

</style>
<div class="fixed-row">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
        </div>
    </div>
</div>
    <div class="row section-mg row-md-body no-nav">
        <div class="col-md-3 dash-card-col">
            <a href="{{route('admin.user.index')}}">
                <div class="card card-body mb-0">
                    <h5 class="mb-2">Total User</h5>
                    <p class="small mb-0">
                        {{ $data->totalUsers }}
                    </p>
                    {{-- <i class="fas fa-list-alt app-menu__icon fa fa-group"></i> --}}
                </div>
            </a>
        </div>
        <div class="col-md-3 dash-card-col">
            <a href="{{route('admin.category.index')}}">
                <div class="card card-body mb-0">
                    <h5 class="mb-2">Categories</h5>
                    <p class="small mb-0">
                        {{ $data->category }}
                    </p>
                    {{-- <i class="fas fa-list-alt app-menu__icon fa fa-group"></i> --}}
                </div>
            </a>
        </div>
        <div class="col-md-3 dash-card-col">
            <a href="{{route('admin.event.index')}}">
                <div class="card card-body mb-0">
                    <h5 class="mb-2">Events</h5>
                    <p class="small mb-0">
                        {{ $data->events }}
                    </p>
                    {{-- <i class="fas fa-list-alt app-menu__icon fa fa-group"></i> --}}
                </div>
            </a>
        </div>
        <div class="col-md-3 dash-card-col">
            <a href="{{route('admin.update.index')}}">
                <div class="card card-body mb-0">
                    <h5 class="mb-2">Updates</h5>
                    <p class="small mb-0">
                        {{ $data->updates }}
                    </p>
                    {{-- <i class="fas fa-list-alt app-menu__icon fa fa-group"></i> --}}
                </div>
            </a>
        </div>
    </div>
@endsection