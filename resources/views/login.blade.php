@include('./layouts/layout')

<div class="container text-center w-50 border p-4 mt-4 border-primary rounded">
    <form action="/login" method="POST">
        @csrf
        <div class="d-flex justify-content-center flex-column m-4">
            <label for="" class="form-label text-right">ایمیل</label>
            <input type="email" name="email" id="" class="form-control">
        </div>
        <div class="d-flex justify-content-center flex-column m-4">
            <label for="" class="form-label">رمز</label>
            <input type="password" name="password" id="" class="form-control">
        </div>
        <div class="d-flex justify-content-center flex-column m-4">
            <button class="btn btn-primary" type="submit">ورود</button>
        </div>
    </form>
    <a href="/register">ثبت نام کنید</a>
</div>

@if(isset($message))
    <div class="container text-center w-50 mt-4">
        <h4 class="text-danger">{{$message}}</h4>
    </div>
@endif