@include('./layouts/layout')

@if(isset($email))
    <div class="container text-center w-50 mt-4">
        <h4 class="text-success">{{$email}}</h4>
    </div>
@endif

<div class="container text-center w-50">
    <form action="{{route('verify')}}" method="POST">
        @csrf
        <div class="d-flex justify-content-center flex-column m-4">
            <label for="" class="form-label text-right">کد تایید</label>
            <input type=text" name="verification_code" id="" class="form-control">
        </div>
        <div class="d-flex justify-content-center flex-column m-4">
            <button class="btn btn-primary" type="submit">ورود</button>
        </div>
    </form>
    <h5><a href="/login">ایمیلی دریافت نکردید؟ مجدد تلاش کنید</a></h5>
</div>
@if(isset($message))
    <div class="container text-center w-50 mt-4">
        <h4 class="text-danger">{{$message}}</h4>
    </div>
@endif