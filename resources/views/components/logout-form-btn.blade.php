{{-- linked to this named route --}}
{{-- Route::post('/logout', [LoginController::class, 'logout'])->name('logout'); --}}
<form method="POST" action="{{route('logout')}}">
    @csrf
    <button type="submit" class="text-white">
        <i class="fa fa-sign-out"> logout</i>
    </button>
</form>

{{--
This way, the actual URL path /logout is only defined in one place (your routes file).
If you ever need to change the URL path, you'd only need to update it in the routes file,
and all references to route('logout') throughout your application will automatically
point to the new path.
--}}