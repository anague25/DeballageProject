<x-mail::message>
# You have been contacted by a user

- Name :{{ $data['name'] }}
- Address :{{ $data['address'] }}
- Email :{{ $data['email'] }}
- Phone :{{ $data['phone'] }}

**Message :**<br />
{{ $data['message'] }}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
