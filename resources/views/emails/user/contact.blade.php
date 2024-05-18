<x-mail::message>
    # You have been contacted by a user

    -Fisrt Name :{{ $data['firstName'] }}
    -Last Name :{{ $data['lastName'] }}
    -Email :{{ $data['email'] }}
    -Phone :{{ $data['phone'] }}

    **Message :**<br />
    {{ $data['message'] }}
   
    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
