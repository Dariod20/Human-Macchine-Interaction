@extends('layouts.master')

@section('titolo')
{{ trans('button.contact') }}
@endsection

@section('active_contatti','active')

@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page"><a href="{{ route('home') }}">Home</a></li>
<li class="breadcrumb-item active" aria-current="page">{{ trans('button.contact') }}</li>
@endsection

@section('corpo')
<!-- Intestazione -->
        <!-- Sezione immagine di sfondo con testo -->
        <div class="co-container">
            <div class="carousel-caption">
                <h3>{{ trans('button.contact') }}</h3>
            </div>
        </div>

        <section id="descrizione" class="px-lg-4">
            <div class="container">
                <div class="row mb-4">
                

                    <!-- Sezione Contatti -->
                    <div class="col-md-6">
                        <h2>{{ trans('button.contact') }}:</h2>
                        <div class="contact-item mb-4">
                            <p><i class="bi bi-geo-alt-fill"></i> <span class="contact-text"><strong>{{ trans('messages.position') }}</strong> <a href="https://maps.app.goo.gl/4W9M2on2tefVwz1a7" class="contact-text">Via Mantovana, 58b, 37014 Cavalcaselle, VR, Italia</a></span></p>
                        </div>
                        <div class="contact-item mb-4">
                            <p><i class="bi bi-telephone-fill"></i> <span class="contact-text"><strong>{{ trans('messages.telefono') }}:</strong> <a href="tel:+393334142902" class="contact-text">+ 39 333 414 2902</a></span></p>
                                    
                        </div>
                        <div class="contact-item mb-4">
                            <p><i class="bi bi-envelope-fill"></i> <span class="contact-text"><strong>Email:</strong> <a href="mailto:dina.colpani@gmail.com" class="contact-text">dina.colpani@gmail.com</a></span></p>
                        </div>
                        <div class="contact-item mb-4">
                            <p><i class="bi bi-facebook"></i> <span class="contact-text"><strong>Facebook:</strong> <a href="https://m.facebook.com/people/ZenZero-Holiday/100072790333341/" class="contact-text">Zenzero Holidays</a></span></p>
                        </div>
                    </div>

                    <!-- Sezione Mappa -->
                    <div class="col-md-6">
                        
                        <!--Google Maps Position-->
                        <h2>{{ trans('messages.position') }}:</h2>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d25059.927593339075!2d10.70870480773605!3d45.43549803298717!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4781e9abaa989e9d%3A0x1a81cd6ab0fb3127!2sVia%20Mantovana%2C%2058d%2C%2037014%20Cavalcaselle%20VR!5e0!3m2!1sit!2sit!4v1710252577943!5m2!1sit!2sit" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

                        
                    </div>
                </div>
            </div>
        
    </section>

    <section id="descrizione2" class="px-lg-4">
        <div class="container">
            <div class="row mt-4">
                <!-- Sezione Regolamento -->
                <div class="col-md-12">
                        <h2>{{ trans('messages.regole') }}</h2>
                        <ul class="list-group regole">
                            <li class="list-group-item"><i class="bi bi-check-circle-fill"></i> {{ trans('messages.regola1') }}</li>
                            <li class="list-group-item"><i class="bi bi-check-circle-fill"></i> {{ trans('messages.regola2') }}</li>
                            <li class="list-group-item"><i class="bi bi-check-circle-fill"></i> {{ trans('messages.regola3') }}</li>
                            <li class="list-group-item"><i class="bi bi-check-circle-fill"></i> {{ trans('messages.regola4') }}</li>
                            <li class="list-group-item"><i class="bi bi-check-circle-fill"></i> {{ trans('messages.regola5') }}</li>
                        </ul>
                </div>
            </div>  
        </div>      
    </section>

















       


@endsection