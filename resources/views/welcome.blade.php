@include('./layouts/layout')

<div class="container text-center w-50">
    <h2>خوش آمدید</h2>
    <h4>{{auth()->user()->username}}</h4>
    <h4>{{auth()->user()->email}}</h4>
    <div>
        <form action="/logout" method="get">
            <button type="submit" class="btn btn-danger">خروج</button>
        </form>
    </div>
</div>