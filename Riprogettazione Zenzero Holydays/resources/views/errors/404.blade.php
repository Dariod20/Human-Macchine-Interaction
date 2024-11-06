@extends('layouts.master') <!-- title - active_home - active_MyLibrary - breadcrumb - body -->

@section('titolo','Errore')

@section('active_home','active')

@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page"><a href="{{ route('home') }}">Home</a></li>
@endsection

@section('corpo')

<div class="container-fluid text-center">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-danger">
                <div class='card-header'>
                    <b>{{trans('errors.accesso_errato')}}</b>
                </div>
                <div class='card-body'>
                    <p>{!! $message !!}</p>
                    <p><a class="btn btn-danger" href="{{ route('home') }}"><i class="bi bi-box-arrow-left"></i> {{trans('errors.torna_home')}}</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
