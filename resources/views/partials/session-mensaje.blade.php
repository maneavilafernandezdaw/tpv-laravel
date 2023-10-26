@if (session('mensaje'))
<div class="card mt-3 text-xl text-center bg-warning">
    {{ session('mensaje') }}
</div>
@endif
