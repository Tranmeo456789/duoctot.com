@if (session('app_notify'))
<div class="alert alert-success export-noti">{{session('app_notify')}}</div>
@php Session::forget('app_notify'); @endphp
@endif
@if (session('app_notify_error'))
<div class="alert alert-danger export-noti">{{session('app_notify_error')}}</div>
@php Session::forget('app_notify_error'); @endphp
@endif