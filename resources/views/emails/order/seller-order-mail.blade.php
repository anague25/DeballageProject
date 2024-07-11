<x-mail::message>
# Deballage Order

Your received this command for a user.

- Order Number : {{ $items[0]->order->number }}
### Customer's informations
- Customer Email : {{ $validatedData['email'] }}
- Customer Name : {{ $validatedData['firstName'] }}
- Customer City : {{ $validatedData['city'] }}
- Customer Neighborhood : {{ $validatedData['neighborhood'] }}
{{-- - Customer Neighborhood : {{ $validatedData['neighborhood'] }} --}}
{{-- - Customer Neighborhood : {{ $validatedData['neighborhood'] }} --}}

<hr>

@foreach ($items as $item )
- Product Name : {{ $item->product->name }}
- Quantity : {{ $item['quantity'] }}
- Price : {{ $item['price'] }}
@endforeach

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
