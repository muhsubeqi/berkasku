<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Berkasku</title>
    <!-- Bootstrap 5 CDN Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Custom CSS Link -->
    <link rel="stylesheet" href="{{ asset('/mytemplate/css/login.css') }}" />
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="card rounded-3 text-black shadow">
                    <div class="row g-0">
                        <div class="col-md-12">
                            <div class="card-body p-md-5 mx-md-4 radius-lg">
                                <div class="text-center">
                                    <h2>BERKASKU</h2>
                                </div>

                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="form-floating my-4">
                                        <input type="text" name="username"
                                            class="form-control @error('username') is-invalid @enderror"
                                            id="floatingInput" placeholder="username" value="{{ old('username') }}"
                                            required />
                                        <label for="floatingInput">Username</label>
                                    </div>
                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <div class="form-floating">
                                        <input type="password" name="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            id="floatingPassword" placeholder="Password" required
                                            autocomplete="current-password" />
                                        <label for="floatingPassword">Password</label>
                                    </div>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <div class="form-check mt-2">
                                        <input class="form-check-input" type="checkbox" onclick="myFunction()"
                                            id="flexCheckDefault" />
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Show Password
                                        </label>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-lg w-100 my-4">
                                        Masuk
                                    </button>
                                    <a href="{{ route('root') }}" style="text-decoration: none">Kembali ke halaman
                                        utama</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function myFunction() {
            var x = document.getElementById("floatingPassword");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
</body>

</html>
