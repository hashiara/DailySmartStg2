@extends('layouts.head')
@section('title', 'ログイン画面')
@section('link')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css"/>
<script src="{{ asset('/js/passwordEye.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
@endsection

@extends('layouts.auth')
@section('form')
<form method="POST" action="{{ route('register.store') }}" class="mx-5 py-4 bg-white border border-secondary-subtle rounded-3">
    @csrf

    <div class="form-content">
        <label for="mail" class="form-label">メールアドレス</label><span class="text-danger fw-bold">*</span>
        <input type="email" id="mail" name="mail" placeholder="info@example.com" class="form-control" />
    </div>

    <div class="text-center">または</div>

    <div class="form-content">
        <label for="user_name" class="form-label">ユーザー名</label><span class="text-danger fw-bold">*</span>
        <input type="text" id="user_name" name="user_name" placeholder="ニックネーム等" class="form-control" />
    </div>

    <div class="form-content">
        <label for="password" class="form-label">パスワード</label><span class="text-danger fw-bold">*</span>
        <div class="position-relative">
            <input type="password" id="password" name="password" placeholder="全角半角英数字(記号は任意)の8～12桁" class="form-control" />
            <i id="eyeIcon" class="bi bi-eye translate-middle position-absolute top-50 end-0"></i>
        </div>
    </div>

    <div class="text-center my-3">
        <div>
            <button class="btn btn-danger text-white me-5" type="button" data-toggle="modal" data-target="#deleteAcountModal">削　除</button>
            <button class="btn btn-info text-white" type="submit" name="action" value="login">ログイン</button>
        </div>
        
        <a href="{{ route('register') }}" class="link-offset-2 link-underline link-underline-opacity-0 d-block mt-3">アカウントをお持ちでない方はこちら</a>
        <a href="{{ route('addData') }}" class="link-offset-2 link-underline link-underline-opacity-0 d-block mt-3">アカウントをお持ちでない方はこちら</a>
    </div>
    
    
    <error :messages="$errors->get('name')" class="mt-2" />

</form>
@endsection

<div class="modal fade" id="deleteAcountModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">アカウント削除</h4>
            </div>
            <div class="modal-body">
                <label>アカウントが削除されますが本当によろしいですか？</label>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                <button type="button" class="btn btn-danger">削除</button>
            </div>
        </div>
    </div>
</div>