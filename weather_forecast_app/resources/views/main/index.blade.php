@extends('layouts.head')
@section('title', 'Daily Smart')
@section('link')
<link rel="stylesheet" href="{{ asset('/css/addData.css') }}">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="{{ asset('/js/hamburger.js') }}"></script>
@endsection

<html>
    <body class="bg-info-subtle">
        <video id="video" poster="{{ asset('/images/bgimg.jpg') }}" webkit-playsinline playsinline muted autoplay loop>
            <source src="{{ asset('/movie/bgmovie.mp4') }}" type="video/mp4">
        </video>

        <header class="row text-center bg-white opacity-75 align-items-center position-relative z-2">
            <div class="col header-logo">
                <a href="#">
                    <img src="{{ asset('/images/logo.png') }}">
                </a>
            </div>

            <h1 class="col">天気予報</h1>

            <button id="hamburger" class="btn col" type="button"
                data-toggle="collapse"
                data-target=".hamburger-content"
                aria-expanded="false"
                aria-controls="hamburger1 hamburger2 hamburger3">
                <img id="hamburgerIcon" src="{{ asset('/images/hamburger.png') }}" />
                <img id="hamburgerIcon2" src="{{ asset('/images/hamburger2.png') }}" hidden />
            </button>
            <div class="text-center bg-white">
                <div class="collapse hamburger-content">
                    <h1 class="hamburger" id="hamburger1">
                        <a href="#" class="">
                            星占い
                        </a>
                    </h1>
                </div>
                <div class="collapse hamburger-content">
                    <h1 class="hamburger" id="hamburger2">
                        <a href="#" class="">
                            路線情報
                        </a>
                    </h1>
                </div>
                <div class="collapse hamburger-content">
                    <h1 class="hamburger" id="hamburger3">
                        <a href="#" class="">
                            ログアウト
                        </a>
                    </h1>
                </div>
            </div>
        </header>

        <div class="container position-relative z-1">
            <h2 class="text-light">ユーザー名さん</h2>
            <form class="form-content" method="POST" action="{{ route('register.store') }}" >
                <div class="form-content">
                    <label for="prefecture" class="form-label">都道府県</label>
                    <select id="prefecture" name="prefecture" class="form-select">
                        <option value="">選択されていません</option>
                        <option value="1">北海道</option>
                        <option value="2">大阪府</option>
                    </select>
                </div>
                <div class="form-content">
                    <label for="city" class="form-label">市区町村</label>
                    <select id="city" name="city" class="form-select">
                        <option value="">選択しない</option>
                        <option value="1">函館市</option>
                        <option value="2">茨木市</option>
                    </select>
                </div>
                <div class="text-center my-5">
                    <button class="btn btn-info text-white" type="submit">登　録</button>
                </div>
            </form>
        </div>
    </body>
</html>