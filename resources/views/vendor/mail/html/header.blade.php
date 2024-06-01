@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://ipucdistrito13.org/img/logo_email.png" class="logo" alt="IPUC Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
