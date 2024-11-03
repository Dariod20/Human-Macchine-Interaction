<!DOCTYPE html>
<html lang="en">
    <head>
        <title> Autenticazione utente </title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!--css-->
        <link href="{{ url('/') }}/css/style.css" rel="stylesheet"> <!-- nell'head va messo il collegamento al foglio di stile-->
        <link rel="stylesheet" href="{{ url('/') }}/css/bootstrap.min.css">


        <!-- jQuery e plugin JavaScript  -->
        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>

        <script src="{{ url('/') }}/js/bootstrap.bundle.min.js"></script>




        <!-- Bootstrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

        <!-- Custom jQuery and Javascript scripts -->
        @yield('script')

    </head>

    <body id="login-body">
        <script>
            $(document).ready(function(){

                const togglePassword = document.querySelectorAll(".toggle-pwd");
                const password = document.querySelectorAll(".pwd");

                togglePassword[0].addEventListener("click", function () {
                    const type = password[0].getAttribute("type") === "password" ? "text" : "password";
                    password[0].setAttribute("type", type);
                    this.classList.toggle("bi-eye");
                });

                togglePassword[1].addEventListener("click", function () {
                    const type = password[1].getAttribute("type") === "password" ? "text" : "password";
                    password[1].setAttribute("type", type);
                    this.classList.toggle("bi-eye");
                });

                togglePassword[2].addEventListener("click", function () {
                    const type = password[2].getAttribute("type") === "password" ? "text" : "password";
                    password[2].setAttribute("type", type);
                    this.classList.toggle("bi-eye");
                });

                $("#login-form").submit(function(event) {
                    // Ottenere i valori dei campi email e password
                    var email = $("input[name='email']").val();
                    var password = $("input[name='password']").val();
                    var error = false;
                    // Verifica se il campo "password" è vuoto
                    if (password.trim() === "") {
                        error = true;
                        $("#invalid-password").text("{{ trans('errors.password') }}");
                        event.preventDefault(); // Impedisce l'invio del modulo
                        $("input[name='password']").focus();
                    } else {
                        $("#invalid-password").text("");
                    }

                    // Verifica se il campo "email" è vuoto
                    if (email.trim() === "") {
                        error = true;
                        $("#invalid-email").text("{{ trans('errors.email') }}");
                        event.preventDefault(); // Impedisce l'invio del modulo
                        $("input[name='email']").focus();
                    } else {
                        $("#invalid-email").text("");
                    }

                    if(!error) {
                        event.preventDefault();
                        $.ajax('/loginEmailCheck', {
                            method: 'GET',
                            data: {email: email.trim()},
                            success: function (result) {
                                if (result.found) {
                                    $.ajax('/loginPasswordCheck', {
                                        method: 'GET',
                                        data: {email: email.trim(),
                                                password: password.trim()},
                                        success: function (result) {
                                            if (result.found) {
                                                $("form")[0].submit();
                                            } else {
                                                $("#invalid-password").text("{{ trans('errors.passwordSbagliata') }}");;
                                            }
                                        }
                                    });
                                } else {
                                    $("#invalid-email").text("{{ trans('errors.emailInesistente') }}");
                                }
                            }
                        });
                    }
                });

                $("#register-form").submit(function(event) {
                    // Ottenere i valori dei campi per la registrazione
                    var name = $("input[name='name']").val();
                    var email = $("input[name='registration-email']").val();
                    var password = $("input[name='registration-password']").val();
                    //L'email è composta del seguente formato:
                    //lettera/numero + . (opzionale) + ettera/numero + @ + lettera/numero + (. + lettera/numero)->opzionale + . + 2/3 lettere
                    var emailRegex = /^[A-Za-z][A-Za-z0-9]*(\.[A-Za-z0-9]+)*@[A-Za-z0-9]+(\.)*([A-Za-z0-9]+)*\.[A-Za-z]{2,3}$/;
                    // Espressione regolare per la password (almeno 8 caratteri, almeno una cifra, almeno
                    // un carattere speciale tra ! - * [ ] $ & /)
                    var passwordRegex = /^(?=.*[A-Z])(?=.*[0-9])(?=.*[!-\*\[\]\$&\/]).{8,}$/;
                    var confirmPassword = $("input[name='confirm-password']").val();
                    var error = false;

                    // Verifica se il campo "name" è vuoto
                    if (name.trim() === "") {
                        error = true;
                        $("#invalid-name").text("{{ trans('errors.nome') }}");
                        event.preventDefault(); // Impedisce l'invio del modulo
                        $("input[name='name']").focus();
                    } else {
                        $("#invalid-name").text("");
                    }

                    // Verifica se il campo "email" è vuoto
                    if (email.trim() === "") {
                        error = true;
                        $("#invalid-registrationEmail").text("{!! trans('errors.email') !!}");
                        event.preventDefault(); // Impedisce l'invio del modulo
                        $("input[name='registration-email']").focus();
                    } else if(!emailRegex.test(email)) {
                        $("#invalid-registrationEmail").text("{!! trans('errors.formatoEmail') !!}");
                        error = true;
                        event.preventDefault(); // Impedisce l'invio del modulo
                    } else{
                        $("#invalid-registrationEmail").text("");
                    }

                    // Verifica se il campo "password" è vuoto
                    if (password.trim() === "") {
                        error = true;
                        $("#invalid-registrationPassword").text("{{ trans('errors.password') }}");
                        event.preventDefault(); // Impedisce l'invio del modulo
                        $("input[name='registration-password']").focus();
                    } else if(!passwordRegex.test(password)) {
                        error = true;
                        $("#invalid-registrationPassword").text("{{ trans('errors.formatoPassword') }}");
                        event.preventDefault(); // Impedisce l'invio del modulo
                        $("input[name='registration-password']").focus();
                    } else {
                        $("#invalid-registrationPassword").text("");
                    }

                    // Verifica se il campo "confirm-password" è vuoto
                    if (confirmPassword.trim() === "") {
                        error = true;
                        $("#invalid-confirmPassword").text("{{ trans('errors.confermaPassword') }}");
                        event.preventDefault(); // Impedisce l'invio del modulo
                        $("input[name='confirm-password']").focus();
                    // Verifica che la password sia state editata due volte correttamente
                    } else if(confirmPassword.trim() !== password.trim()) {
                        $("#invalid-confirmPassword").text("{{ trans('errors.stessaPassword') }}");
                        event.preventDefault(); // Impedisce l'invio del modulo
                        $("input[name='confirm-password']").focus();
                    } else {
                        $("#invalid-confirmPassword").text("");
                    }

                    if(!error) {
                        // effettua chiamata AJAX per verificare che l'email dell'utente non sia già presente nel DB
                        event.preventDefault(); // Impedisce preventivamente l'invio del modulo prima del controllo
                        $.ajax({

                            type: 'GET',

                            url: '/ajaxUser',

                            data: {email: email.trim()},

                            success: function (data) {

                                if (data.found)
                                {
                                    //error = true;
                                    $("#invalid-registrationEmail").text("{!! trans('errors.emailEsistente') !!}");
                                } else {
                                    $("form")[1].submit();
                                }
                            }
                        });
                    }
                });
            });
        </script>

        @if (session('registration_success'))
            <div class="d-flex justify-content-center"> <!-- Contenitore per centrare -->
                <div class="alert alert-success alert-dismissible fade show" role="alert" id="registration_success">
                    {{ session('registration_success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        <div class="container col-lg-4" id="login-container">
            <div class="row">
                <h1 id="zenzero-login"> Zenzero Holidays <i class="bi bi-house-door-fill"></i> </h1>
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-login-tab" data-bs-toggle="pill" data-bs-target="#pills-login" type="button" role="tab" aria-controls="pills-login" aria-selected="true"> {{ trans('button.login') }} </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-register-tab" data-bs-toggle="pill" data-bs-target="#pills-register" type="button" role="tab" aria-controls="pills-register" aria-selected="false"> {{ trans('button.registrati') }} </button>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="pills-login-tab" tabindex="0">
                        <form id="login-form" action="{{ route('user.login') }}" method="post" style="margin-top: 0.3em">
                            @csrf
                            <div class="form-group">
                                <label for="email" class="login-label">Email</label>
                                <input type="text" name="email" placeholder="Email" class="form-control"/>
                                <span class="invalid-input" id="invalid-email"></span>
                            </div>
                            <div class="form-group">
                            <label for="password" class="login-label">Password</label>
                                <input type="password" name="password" placeholder="Password" class="form-control  pwd"/>
                                <i class="bi bi-eye-slash toggle-pwd"></i>
                                <span class="invalid-input" id="invalid-password"></span>
                            </div>

                            <div>
                                <a href="{{ route('home') }}" class="btn btn-secondary btn-login"><i class="bi-box-arrow-left"></i> {{ trans('button.annulla') }} </a>
                                <label for="Login" class="btn btn-primary btn-login"><i class="bi bi-door-open"></i> {{ trans('button.login') }} </label>
                                <input id="Login" type="submit" value="Login" class="d-none"/>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="pills-register" role="tabpanel" aria-labelledby="pills-register-tab" tabindex="0">
                        <form id="register-form" action="{{ route('user.register') }}" method="post" style="margin-top: 0.3em">
                            @csrf
                            <div class="form-group">
                            <label for="email" class="login-label">{{ trans('button.nome') }}</label>
                                <input type="text" name="name" placeholder="{{ trans('button.nome') }}" class="form-control" value=""/>
                                <span class="invalid-input" id="invalid-name"></span>
                            </div>

                            <div class="form-group">
                            <label for="email" class="login-label">Email</label>
                                <input type="text" name="registration-email" placeholder="Email" class="form-control" value=""/>
                                <span class="invalid-input" id="invalid-registrationEmail"></span>
                            </div>

                            <div class="form-group" id="password-space">
                            <label for="password" class="login-label">Password</label>
                                <input type="password" name="registration-password" placeholder="Password" class="form-control pwd" value=""/>
                                <i class="bi bi-eye-slash toggle-pwd"></i>
                                <p id="info-pwd"><i class="bi-info-circle-fill"></i> {{ trans('messages.infoPassword') }} </p>
                                <p class="invalid-input" id="invalid-registrationPassword"></p>
                            </div>

                            <div class="form-group">
                            <label for="conform-password" class="login-label">{{ trans('button.conferma') }}</label>
                                <input type="password" name="confirm-password" placeholder="{{ trans('button.conferma') }}" class="form-control pwd" value=""/>
                                <i class="bi bi-eye-slash toggle-pwd"></i>
                                <span class="invalid-input" id="invalid-confirmPassword"></span>
                            </div>
                            <div>
                                <a href="{{ route('home') }}" class="btn btn-secondary btn-login"><i class="bi-box-arrow-left"></i> {{ trans('button.annulla') }} </a>
                                <label for="Register" class="btn btn-primary btn-login"><i class="bi bi-person-plus"></i> {{ trans('button.registrati') }} </label>
                                <input id="Register" type="submit" value="Register" class="d-none"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <br>
        </div>

    </body>

</html>
