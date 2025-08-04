@props(['url'])
<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block;">
            @if (trim($slot) === 'Laravel')
                <img src="https://staging.probilliardcenter.com/images/pbc_logo.png" class="logo" alt="PBC Logo">
            @else
                {{ $slot }}
            @endif
        </a>
    </td>
</tr>
