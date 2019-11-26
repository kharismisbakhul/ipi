<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>404 Not Found</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Montserrat:400,600,700&display=swap');

        .masthead {
            height: 100vh;
            min-height: 500px;
            background-image: url("http://localhost/IpiApps/assets/img/background.png");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            font-family: 'Montserrat', sans-serif;
        }

        .text-404 {
            font-size: 10rem;
            text-shadow: 0px 5px 20px rgba(0, 0, 0, 0.16);

        }

        .vr {
            border-left: 3px solid white;
            height: 300px;
        }

        .text-white {
            color: white;
            text-shadow: 0px 5px 20px rgba(0, 0, 0, 0.16);
        }
    </style>
</head>

<body>
    <!-- Full Page Image Header with Vertically Centered Content -->
    <header class="masthead">
        <div class="container h-100" style="padding-left: 0rem;">
            <div class="row h-100 align-items-center pl-5">
                <div class="col-4 text-center">
                    <h1 class="font-weight-bold text-white text-404">404</h1>
                </div>
                <div class="col-1 ml-5">
                    <div class="vr"></div>
                </div>
                <div class="col-6">
                    <h1 class="h1 font-weight-bold text-white pb-1">Halaman tidak ditemukan</h1>
                    <h3 class="h3 font-weight-normal text-white pb-3">Maaf, halaman yang anda cari tidak ditemukan.</h3>
                    <a class="btn btn-light" href="<?= base_url('admin'); ?>" style="text">
                        Kembali ke Halaman Utama
                    </a>
                </div>
            </div>
        </div>
    </header>
</body>

</html>