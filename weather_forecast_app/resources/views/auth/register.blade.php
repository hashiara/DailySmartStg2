<html>
    <head>
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
        <link rel="stylesheet" href="{{ asset('/css/common.css') }}">
        <link rel="stylesheet" href="{{ asset('/css/register.css') }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css"/>
        <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
        <title>登録画面</title>
    </head>

    <body class="bg-info-subtle">
        <div class="text-center my-4">
            <img src="{{ asset('/images/logo.png') }}" class="logo">
        </div>

        <form method="POST" action="{{ route('register') }}" class="mx-5 py-4 bg-white border border-secondary-subtle rounded-3">
            @csrf

            <div class="form-content">
                <label for="mail" class="form-label">メールアドレス</label><span class="text-danger fw-bold">*</span>
                <input type="email" id="mail" placeholder="info@example.com" class="form-control form-control-lg" />
            </div>

            <div class="form-content">
                <label for="user_name" class="form-label">ユーザー名</label><span class="text-danger fw-bold">*</span>
                <input type="text" id="user_name" placeholder="ニックネーム等" class="form-control form-control-lg" />
            </div>

            <div class="form-content">
                <label for="otk" class="form-label">ワンタイム認証キー</label><span class="text-danger fw-bold">*</span>
                <input type="text" id="otk" placeholder="Lineに送信された12桁のキー" class="form-control form-control-lg" />
            </div>

            <div class="form-content">
                <label for="password" class="form-label">新しいパスワード</label><span class="text-danger fw-bold">*</span>
                <div class="position-relative">
                    <input type="password" id="password" placeholder="全角半角英数字(記号は任意)の8～12桁" class="form-control form-control-lg" />
                    <i id="eyeIcon" class="bi bi-eye translate-middle position-absolute top-50 end-0"></i>
                </div>
            </div>

            <div class="text-center my-3">
                <button class="btn btn-info text-white px-3 py-2" type="submit">登　録</button>
                <a href="#" class="link-offset-2 link-underline link-underline-opacity-0 d-block mt-3">アカウントをお持ちの方はこちら</a>
            </div>
            
            
            <error :messages="$errors->get('name')" class="mt-2" />

        </form>

        <script>
            // passwordの表示切替
            $("#eyeIcon").on("click", () => {
                // eyeIconのclass切り替え
                $("#eyeIcon").toggleClass("bi-eye-slash bi-eye");

                // inputのtype切り替え
                if ($("#password").attr("type") == "password") {
                $("#password").attr("type", "text");
                } else {
                $("#password").attr("type", "password");
                }
            });
        </script>
    </body>
</html>
