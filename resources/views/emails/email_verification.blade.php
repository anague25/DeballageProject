<x-mail::message>
# Email Verification

please click on this button to verify your email.

<x-mail::button :url="$url">
    Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
