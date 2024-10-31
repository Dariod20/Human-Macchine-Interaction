<!DOCTYPE html>
<html lang="it">
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
                        $("#invalid-password").text("La password è obbligatoria.");
                        event.preventDefault(); // Impedisce l'invio del modulo
                        $("input[name='password']").focus();
                    } else {
                        $("#invalid-password").text("");
                    }

                    // Verifica se il campo "email" è vuoto
                    if (email.trim() === "") {
                        error = true;
                        $("#invalid-email").text("L'indirizzo email è obbligatorio.");
                        event.preventDefault(); // Impedisce l'invio del modulo
                        $("input[name='email']").focus();
                    } else {
                        $("#invalid-email").text("");
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
                        $("#invalid-name").text("Il nome è obbligatorio.");
                        event.preventDefault(); // Impedisce l'invio del modulo
                        $("input[name='name']").focus();
                    } else {
                        $("#invalid-name").text("");
                    }

                    // Verifica se il campo "email" è vuoto
                    if (email.trim() === "") {
                        error = true;
                        $("#invalid-registrationEmail").text("L'indirizzo email è obbligatorio.");
                        event.preventDefault(); // Impedisce l'invio del modulo
                        $("input[name='registration-email']").focus();
                    } else if(!emailRegex.test(email)) {
                        $("#invalid-registrationEmail").text("Il formato dell'email è sbagliato.");
                        error = true;
                        event.preventDefault(); // Impedisce l'invio del modulo
                    } else{
                        $("#invalid-registrationEmail").text("");
                    }

                    // Verifica se il campo "password" è vuoto
                    if (password.trim() === "") {
                        error = true;
                        $("#invalid-registrationPassword").text("La password è obbligatoria.");
                        event.preventDefault(); // Impedisce l'invio del modulo
                        $("input[name='registration-password']").focus();
                    } else if(!passwordRegex.test(password)) {
                        error = true;
                        $("#invalid-registrationPassword").text("Il formato della password è sbagliato.");
                        event.preventDefault(); // Impedisce l'invio del modulo
                        $("input[name='registration-password']").focus();
                    } else {
                        $("#invalid-registrationPassword").text("");
                    }

                    // Verifica se il campo "confirm-password" è vuoto
                    if (confirmPassword.trim() === "") {
                        error = true;
                        $("#invalid-confirmPassword").text("La conferma della password è obbligatoria.");
                        event.preventDefault(); // Impedisce l'invio del modulo
                        $("input[name='confirm-password']").focus();
                    // Verifica che la password sia state editata due volte correttamente
                    } else if(confirmPassword.trim() !== password.trim()) {
                        $("#invalid-confirmPassword").text("Immettere la stessa password due volte.");
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
                                    error = true;
                                    $("#invalid-registrationEmail").text("L'email esiste già nel database.");
                                } else {
                                    $("form")[1].submit();
                                }
                            }
                        });
                    }
                });
            });
        </script>

        <div class="container col-lg-4" id="login-container">
            @if (session('login_feedback'))
                <div class="alert alert-info mt-4" role="alert">
                    <i class="fas fa-info-circle"></i> 
                    {{ session('login_feedback') }}
                </div>
            @endif
            <div class="row">
                <h1 id="zenzero-login"> Zenzero Holidays <i class="bi bi-house-door-fill"></i> </h1>
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-login-tab" data-bs-toggle="pill" data-bs-target="#pills-login" type="button" role="tab" aria-controls="pills-login" aria-selected="true">Login</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-register-tab" data-bs-toggle="pill" data-bs-target="#pills-register" type="button" role="tab" aria-controls="pills-register" aria-selected="false">Register</button>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="pills-login-tab" tabindex="0">
                        <form id="login-form" action="{{ route('user.login') }}" method="post" style="margin-top: 0.3em">
                            @csrf
                            <div class="form-group">
                                <label for="email" class="login-label">Email</label>
                                <input type="text" name="email" class="form-control"/>
                                <span class="invalid-input" id="invalid-email"></span>
                            </div>
                            <div class="form-group">
                            <label for="password" class="login-label">Password</label>
                                <input type="password" name="password" class="form-control pwd"/>
                                <i class="bi bi-eye-slash toggle-pwd"></i>
                                <span class="invalid-input" id="invalid-password"></span>
                            </div>

                            <div>
                                <a href="{{ route('home') }}" class="btn btn-secondary btn-login"><i class="bi-box-arrow-left"></i> Back</a>
                                <label for="Login" class="btn btn-primary btn-login"><i class="bi bi-door-open"></i> Login</label>
                                <input id="Login" type="submit" value="Login" class="d-none"/>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="pills-register" role="tabpanel" aria-labelledby="pills-register-tab" tabindex="0">
                        <form id="register-form" action="{{ route('user.register') }}" method="post" style="margin-top: 0.3em">
                            @csrf
                            <div class="form-group">
                            <label for="email" class="login-label">Name</label>
                                <input type="text" name="name" class="form-control" value=""/>
                                <span class="invalid-input" id="invalid-name"></span>
                            </div>

                            <div class="form-group">
                            <label for="email" class="login-label">Email</label>
                                <input type="text" name="registration-email" class="form-control" value=""/>
                                <span class="invalid-input" id="invalid-registrationEmail"></span>
                            </div>

                            <div class="form-group" id="password-space">
                            <label for="password" class="login-label">Password</label>
                                <input type="password" name="registration-password" class="form-control pwd" value=""/>
                                <i class="bi bi-eye-slash toggle-pwd"></i>
                                <p id="info-pwd"><i class="bi-info-circle-fill"></i> La password deve essere lunga minimo 8 caratteri
                                    e contenere almeno una maiuscola, una cifra e un carattere tra ! - * [ ] $ & / </p>
                                <p class="invalid-input" id="invalid-registrationPassword"></p>
                            </div>

                            <div class="form-group">
                            <label for="conform-password" class="login-label">Confirm Password</label>
                                <input type="password" name="confirm-password" class="form-control pwd" value=""/>
                                <i class="bi bi-eye-slash toggle-pwd"></i>
                                <span class="invalid-input" id="invalid-confirmPassword"></span>
                            </div>
                            <div>
                                <a href="{{ route('home') }}" class="btn btn-secondary btn-login"><i class="bi-box-arrow-left"></i> Back</a>
                                <label for="Register" class="btn btn-primary btn-login"><i class="bi bi-person-plus"></i> Register</label>
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
