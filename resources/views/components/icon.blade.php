@props(['name', 'class' => 'w-5 h-5'])

@if ($name === 'home')
<svg xmlns="http://www.w3.org/2000/svg" class="{{ $class }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9.75L12 4l9 5.75M4.5 10.5v8.25h15V10.5M9.75 21V13.5h4.5V21" />
</svg>
@endif

@if ($name === 'bus')
<!-- Add SVG for bus -->
@endif