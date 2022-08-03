<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Liste des maladies</title>
    {{-- <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('assets/css/global-style.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/icons/font/bootstrap-icons.css') }}">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-3">Laravel HTML to PDF Example</h2>
        <div>
            <button class="btn btn-success" onclick="impression()">Imprimer</button>
        </div>
        <div class="row px-5" id="table">
            <table class="table table-bordered mb-5 mt-3" style="background-color: white;">
                <thead>
                    <tr class="table-secondary">
                        <th scope="col">#</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Nombre</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($maladies as $maladie)
                    <tr>
                        <th scope="row">{{ $maladie->id }}</th>
                        <th>{{ $maladie->nom }}</td>
                        <th>{{ $maladie->nombre }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script src="{{ asset('assets/html2pdf/dist/html2pdf.bundle.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script>
        function impression(){
            const element = document.getElementById('table');
            element.style.display = 'block';
            // $('#table').removeClass('d-none');
            // const element = document.querySelector('body');
            html2pdf(element);
            // $('#table').addClass('d-none');
        }
    </script>
</body>
</html>