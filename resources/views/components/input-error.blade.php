@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => '']) }} style="list-style: none; padding: 0; margin: 4px 0 0 0;">
        @foreach ((array) $messages as $message)
            <li class="form-error">{{ $message }}</li>
        @endforeach
    </ul>
@endif
