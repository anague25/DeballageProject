<x-mail::message>
# Deballage : New Order Notification.

## Order Details
- **Order Number :** {{ $order->number }}
- **Total Amount:** {{ $order->totalAmount }}
### Customer's informations
- **Customer Email :** {{ $delivery->email }}
- **Customer Name :** {{ $delivery->firstName }}
- **Customer City :** {{ $delivery->city }}
- **Customer Neighborhood :** {{ $delivery->neighborhood }}

<hr>

{{-- @foreach ($orderItem as $item )
- Product Name : {{ $item->product->name }}
- Quantity : {{ $item->quantity }}
- Price : {{ $item->price }}
@endforeach --}}

@foreach($orderItemsGroupedBySeller as $sellerEmail => $items)
    @php
        $seller = $items->first()->product->shop->user;
        $shop = $items->first()->product->shop;
    @endphp

## Seller: {{ $seller->firstName }} {{$seller->lastName}}
- **Shop Name:** {{ $shop->name }}
- **Seller Email:** {{ $sellerEmail }}
- **Seller Phone:** {{ $seller->phone }}

### Products
@foreach($items as $item)
- **Product Name:** {{ $item->product->name }}
- **Quantity:** {{ $item->quantity }}
- **Price:** {{ $item->price }}
@endforeach
@endforeach

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
