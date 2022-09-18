@extends('shop.layouts.backend')

@section('title', 'Thay đổi mật khẩu')

@section('header_title', 'Thay đổi mật khẩu')

@section('body_content')
@if (session('status'))
<div class="alert alert-success text-center">
    {{session('status')}}
</div>
@endif
@if (session('error'))
<div class="alert alert-danger text-center">
{{session('error')}}
</div>
@endif
<div class="card">
    <div class="card-body">
        <form action="{{route('seller.change_password')}}" method="POST">
            {!! csrf_field() !!}
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <label for="name">Mật khẩu tài khoản đang đăng nhập<span class="text-danger">*</span></label>
                        <input class="form-control" type="password" name="password_curent" id="" value="">
                        @if($errors->has('password_curent'))
                        <small class="text-danger">{{$errors->first('password_curent')}}</small>
                        @endif
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <label for="intro">Số điện thoại<span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="" id="" value="09888666765" disabled>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <label for="name">Mật khẩu mới<span class="text-danger">*</span></label>
                        <input class="form-control" type="password" name="password" id="password" value="">
                        @if($errors->has('password'))
                        <small class="text-danger">{{$errors->first('password')}}</small>
                        @endif
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <label for="intro">Nhập lại mật khẩu mới<span class="text-danger">*</span></label>
                        <input class="form-control" type="password" name="password_confirmation" id="password-confirm" value="">
                        @if($errors->has('password_confirmation'))
                        <small class="text-danger">{{$errors->first('password_confirmation')}}</small>
                        @endif
                    </div>
                </div>
            </div>

            <div>
                <p><span class="text-danger">Lưu ý:</span> Mật khẩu cần thỏa mãn các điều kiện sau</p>
                <p>- Có độ dài ít nhất 6 ký tự</p>
                <p>- Chứa ít nhất 01 ký tự số, 01 ký tự chữ và 01 ký tự đặc biệt.</p>
                <p>- Không được trùng với 4 mật khẩu gần nhất</p>
            </div>
            <div class="text-center"><button name="btnupdate-password" id="" value="1" type="submit" class="btn btn-primary">Cập nhật</button></div>
        </form>
    </div>
</div>
@endsection