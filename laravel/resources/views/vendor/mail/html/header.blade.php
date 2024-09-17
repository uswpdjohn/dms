<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/GOA_logo_fixed_email_template.png'))) }}"  alt="{{ $slot }}">
{{--@if (trim($slot) === 'Laravel')--}}
{{--<img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Laravel Logo">--}}
{{--@else--}}
{{ $slot }}
{{--@endif--}}
</a>
</td>
</tr>
