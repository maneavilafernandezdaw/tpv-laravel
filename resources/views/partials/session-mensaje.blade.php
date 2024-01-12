@if (session('mensaje'))
<div class=" container card mt-3 p-2 text-2xl text-center bg-warning">
    {{ session('mensaje') }}
</div>
@endif
