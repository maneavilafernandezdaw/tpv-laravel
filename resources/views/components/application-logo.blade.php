@php
    $img="imagen/logoMinibar.png";
@endphp
<img src="{{ asset($img) }}"
  alt="imagen logo"
{{ $attributes->merge([ 'class' => 'w-24' ]) }}>