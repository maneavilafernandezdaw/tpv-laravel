@php
    $img="imagen/logoMinibar.jpeg";
@endphp
<img src="{{ asset($img) }}"
  alt="imagen logo"
{{ $attributes->merge([ 'class' => 'w-24' ]) }}>