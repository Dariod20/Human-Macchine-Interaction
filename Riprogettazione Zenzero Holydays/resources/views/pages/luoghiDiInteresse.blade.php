@extends('layouts.master')

@section('titolo')
{{ trans('button.luoghi') }}
@endsection

@section('active_luoghi','active')

@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page"><a href="{{ route('home') }}">Home</a></li>
<li class="breadcrumb-item active" aria-current="page">{{ trans('button.luoghi') }}</li>
@endsection

@section('corpo')

        
        <div class="li-container">
            <div class="carousel-caption">
                <h3>{{ trans('button.luoghi') }}</h3>
            </div>
        </div>

        <section id="descrizione" class="px-lg-4">
            <div class="container">
                <h1 class="text-center mb-3">{{ trans('button.luoghi') }}</h1>
                <div class="row">
                    <div class="col-md-6">
                        <h2>{{ trans('messages.parchi') }}</h2>
                        <ul>
                            <li>Gardaland - {{ trans('messages.distanza') }}: 3 km</li>
                            <li>Caneva Aquapark - {{ trans('messages.distanza') }}: 5 km</li>
                            <li>Movieland - {{ trans('messages.distanza') }}: 5 km</li>
                            <li>Medieval Times (ristorante con spetttacolo) - {{ trans('messages.distanza') }}: 5 km</li>
                            <li>Parco Giardino Sigurtà - {{ trans('messages.distanza') }}: 10 km</li>
                            <li>Parco Natura Viva (zoo e safari) - {{ trans('messages.distanza') }}: 10 km</li>


                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h2>{{ trans('messages.citta') }}</h2>
                        <ul>
                            <li>Peschiera del Garda - {{ trans('messages.distanza') }}: 2 km</li>
                            <li>Lazise - {{ trans('messages.distanza') }}: 6 km</li>
                            <li>Sirmione - {{ trans('messages.distanza') }}: 8 km</li>
                            <li>Bardolino - {{ trans('messages.distanza') }}: 16 km</li>
                            <li>Garda - {{ trans('messages.distanza') }}: 20 km</li>
                            <li>Borghetto - {{ trans('messages.distanza') }}: 11 km</li>
                            <li>Desenzano del Garda - {{ trans('messages.distanza') }}: 18 km</li>
                            <li>Verona - {{ trans('messages.distanza') }}: 22 km</li>
                            <li>Mantova - {{ trans('messages.distanza') }}: 38 km</li>



                        </ul>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-6">
                        <h2>{{ trans('messages.terme') }}</h2>
                        <ul>
                            <li>Terme di Sirmione - {{ trans('messages.distanza') }}: 7 km</li>
                            <li>Parco termale del Garda - {{ trans('messages.distanza') }}: 4 km</li>
                            <li>Aquardens - {{ trans('messages.distanza') }}: 19 km</li>


                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h2>Sport</h2>
                        <ul>
                            <li>{{ trans('messages.pesca') }} - {{ trans('messages.distanza') }}: 1 km</li>
                            <li>Golf Club Paradiso - {{ trans('messages.distanza') }}: 4 km</li>
                            <li>Sup Experience Garda Lake - {{ trans('messages.distanza') }}: 2 km</li>
                            <li>{{ trans('messages.funivia') }}- {{ trans('messages.distanza') }}: 45 km</li>
                            <li>{{ trans('messages.ferrata') }} - {{ trans('messages.distanza') }}: 60 km</li>



                        </ul>
                    </div>
                </div>
            </div>
        </section>
@endsection