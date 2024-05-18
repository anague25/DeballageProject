namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Resources\OrderResource;
use App\Http\Resources\OrderItemResource;

class OrderController extends Controller
{
public function show($id)
{
$order = Order::with('orderItems.product')->findOrFail($id);
return new OrderResource($order);
}

public function store(Request $request)
{
$validatedData = $request->validate([
'user_id' => 'required|exists:users,id',
'number' => 'required|string',
'total_amount' => 'required|numeric',
'state' => 'required|string',
'order_items' => 'required|array',
'order_items.*.product_id' => 'required|exists:products,id',
'order_items.*.price' => 'required|numeric',
'order_items.*.quantity' => 'required|numeric',
]);

$order = Order::create($validatedData);

foreach ($validatedData['order_items'] as $itemData) {
$orderItem = new OrderItem($itemData);
$order->orderItems()->save($orderItem);
}

return new OrderResource($order->load('orderItems.product'));
}

public function update(Request $request, $id)
{
$order = Order::findOrFail($id);
$validatedData = $request->validate([
'user_id' => 'sometimes|exists:users,id',
'number' => 'sometimes|string',
'total_amount' => 'sometimes|numeric',
'state' => 'sometimes|string',
'order_items' => 'sometimes|array',
'order_items.*.id' => 'sometimes|exists:order_items,id',
'order_items.*.product_id' => 'sometimes|exists:products,id',
'order_items.*.price' => 'sometimes|numeric',
'order_items.*.quantity' => 'sometimes|numeric',
]);

$order->update($validatedData);

if (isset($validatedData['order_items'])) {
foreach ($validatedData['order_items'] as $itemData) {
if (isset($itemData['id'])) {
$orderItem = OrderItem::findOrFail($itemData['id']);
$orderItem->update($itemData);
} else {
$orderItem = new OrderItem($itemData);
$order->orderItems()->save($orderItem);
}
}
}

return new OrderResource($order->load('orderItems.product'));
}

public function destroy($id)
{
$order = Order::findOrFail($id);
$order->delete();
return response()->noContent();
}

public function destroyOrderItem($id)
{
$orderItem = OrderItem::findOrFail($id);
$orderItem->delete();
return response()->noContent();
}
}
Routes API
Ajoutez les routes nécessaires dans routes/api.php.

php
Copier le code
use App\Http\Controllers\OrderController;

Route::get('/orders', [OrderController::class, 'index']);
Route::get('/orders/{id}', [OrderController::class, 'show']);
Route::post('/orders', [OrderController::class, 'store']);
Route::put('/orders/{id}', [OrderController::class, 'update']);
Route::delete('/orders/{id}', [OrderController::class, 'destroy']);
Route::delete('/order-items/{id}', [OrderController::class, 'destroyOrderItem']);
Resources
Créez des resources pour formater les réponses JSON.

app/Http/Resources/OrderResource.php

php
Copier le code
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
public function toArray($request)
{
return [
'id' => $this->id,
'user_id' => $this->user_id,
'number' => $this->number,
'total_amount' => $this->