@if (session('mensaje'))
<div class=" container card my-3 p-2 text-2xl text-center text-dark bg-warning">
    {{ session('mensaje') }}
</div>
@endif
