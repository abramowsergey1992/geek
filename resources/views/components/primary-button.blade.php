<button  class="btn" {{ $attributes->merge(['type' => 'submit']) }}>
    {{ $slot }}
</button>
