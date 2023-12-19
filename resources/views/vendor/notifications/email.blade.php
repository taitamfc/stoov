@component('mail::message')
{{-- Intro Lines --}}
@foreach ($introLines as $line)
{{ $line }}

@endforeach

{{-- Action Button --}}
@isset($actionText)
<?php
    switch ($level) {
        case 'success':
        case 'error':
            $color = $level;
            break;
        default:
            $color = 'primary';
    }
?>
@component('mail::button', ['url' => $actionUrl, 'color' => $color])
{{ $actionText }}
@endcomponent
@endisset

{{-- Outro Lines --}}
@foreach ($outroLines as $line)
{{ $line }}

@endforeach

<p>Cor Wittekoek <br> STOOV </p>
<p>Dit is een automatisch gegenereerd e-mail bericht.</p>

{{-- Subcopy --}}
@isset($actionText)
@slot('subcopy')
@lang(
    "Als je problemen hebt met het klikken op de \":actionText\" knop, kopieer en plak dan de onderstaande URL \n".
    'in je webbrowser:',
    [
        'actionText' => $actionText,
    ]
) <span class="break-all">[{{ $displayableActionUrl }}]({{ $actionUrl }})</span>
@endslot
@endisset
@endcomponent
