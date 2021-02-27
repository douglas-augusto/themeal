<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/css/materialize.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/icons/css/all.min.css') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
    <script type="text/javascript" src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/materialize.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/scripts.js') }}"></script>
    <title>TheMeal</title>
</head>

<body>
    <div class="navbar-fixed">
        <nav class="red" style="padding:0px 10px; position: fixed;">
            <div class="nav-wrapper">
                <a href="{{ route('home') }}" class="brand-logo"><img id="logo" src="{{ asset('assets/img/logo.png') }}"
                        alt="logo"></a>
                <form action="{{ route('search') }}" method="get">
                    @csrf
                    <div class="search-center">
                        <i class="material-icons" id="search-icon">search</i>
                        <input type="text" name="search" id="search-input" placeholder="Search for a Meal...">
                        <button type="submit" id="submit-button">Search</button>
                    </div>
                </form>
            </div>
        </nav>
    </div>

    <div class="main">
        @if ($results == null && $warning == null)
            <div class="home-background" style="background-image: url('{{ asset('assets/img/teste.jpg') }}');">
                <div class="home-text">
                    <h1 id="welcome-text">Welcome!</h1>
                    <h3 id="welcome-text-secondary">You are hungry?</h3>
                </div>
            </div>
        @elseif($results == null && $warning != "")
            <div class="container">
                <h5 style="text-align: center">{{ $warning }}</h5>
            </div>
        @else
            <div class="container">
                <div class="row">
                    @foreach ($results as $r)
                        <div class="col s12 m4">
                            <div class="card">
                                <div class="card-image">
                                    <img src="{{ $r->strMealThumb }}" class="thumbnail">
                                    <a id="ingredient-btn{{ $r->idMeal }}"
                                        class="btn-floating halfway-fab waves-effect waves-light red"
                                        style="right: 50px;"><i class="material-icons">local_dining</i></a>
                                    <a id="instructions-btn{{ $r->idMeal }}"
                                        class="btn-floating halfway-fab waves-effect waves-light blue"
                                        style="right: 5px;"><i class="material-icons">description</i></a>
                                </div>
                                <div class="card-content">
                                    <h5 class="meal-title">{{ $r->strMeal }}</h5>
                                    <p class="meal-category">{{ $r->strCategory }} &#9670; {{ $r->strArea }}</p>
                                    <div class="cooking" id="cooking{{ $r->idMeal }}">
                                        <p class="title-secondary">Cooking Instructions</p>
                                        <p align="justify">{{ $r->strInstructions }}</p>
                                    </div>
                                    <div class="ingredients" id="ingredients{{ $r->idMeal }}">
                                        <p class="title-secondary">Ingredients</p>
                                        @for ($i = 1; $i <= 20; $i++)
                                            <p class="ingredient">{{ $r->{'strMeasure' . $i} }}
                                                {{ $r->{'strIngredient' . $i} }}</p>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                            <script>
                                $("#instructions-btn{{ $r->idMeal }}").click(function() {
                                    $('#ingredients{{ $r->idMeal }}').hide(400);
                                    if ($("#cooking{{ $r->idMeal }}").is(":visible")) {
                                        $('#cooking{{ $r->idMeal }}').hide(400);
                                    } else {
                                        $('#cooking{{ $r->idMeal }}').show(400);
                                    }
                                });

                                $("#ingredient-btn{{ $r->idMeal }}").click(function() {
                                    $('#cooking{{ $r->idMeal }}').hide(400);
                                    if ($("#ingredients{{ $r->idMeal }}").is(":visible")) {
                                        $('#ingredients{{ $r->idMeal }}').hide(400);
                                    } else {
                                        $('#ingredients{{ $r->idMeal }}').show(400);
                                    }
                                });

                            </script>
                        </div>
                    @endforeach
                </div>
                {{ $results->links('vendor.pagination.materializecss') }}
            </div>
        @endif
    </div>

    <footer class="page-footer red" style="padding: 0px">
        <div class="footer-copyright">
            <div class="container" style="padding-top: 0px;">
                © 2021 Developed by Douglas Augusto
                <a class="grey-text text-lighten-4 right" href="#!">GitHub Project</a>
            </div>
        </div>
    </footer>
</body>

</html>
