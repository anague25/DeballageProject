<x-mail::message>
# Deballage Order

Your received this command for a user.

- Order Number : {{ $order->number }}
### Customer's informations
- Customer Email : {{ $delivery->email }}
- Customer Name : {{ $delivery->firstName }}
- Customer City : {{ $delivery->city }}
- Customer Neighborhood : {{ $delivery->neighborhood }}

<hr>

@foreach ($orderItem as $item )
- Product Name : {{ $item->product->name }}
- Quantity : {{ $item->quantity }}
- Price : {{ $item->price }}
@endforeach

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
