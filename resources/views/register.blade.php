@include('./layouts/layout')
@if(isset($message))
    <div class="container text-center w-50">
        <h4 class="text-danger">{{$message}}</h4>
    </div>
@endif

<div class="container text-center w-50 border p-4 mt-4 border-primary rounded">
    <form action="{{route('register')}}" method="POST">
        @csrf
        <div class="d-flex justify-content-center flex-column m-4">
            <label for="" class="form-label text-right">ایمیل</label>
            <input type="email" name="email" id="" class="form-control">
        </div>
        <div class="d-flex justify-content-center flex-column m-4">
            <label for="" class="form-label text-right">نام کاربری</label>
            <input type="text" name="username" id="" class="form-control">
        </div>
        <div class="d-flex justify-content-center flex-column m-4">
            <label for="" class="form-label">رمز</label>
            <input type="password" name="password" id="" class="form-control">
        </div>
        <div class="d-flex justify-content-center flex-column m-4">
            <label for="" class="form-label">تکرار رمز</label>
            <input type="password" name="password_confirmation" id="" class="form-control">
        </div>
        <div class="d-flex justify-content-center flex-column m-4">
            <button class="btn btn-primary" type="submit">ثبت نام</button>
        </div>
    </form>
</div>