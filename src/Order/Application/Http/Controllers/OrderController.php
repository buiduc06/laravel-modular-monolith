<?php

declare(strict_types=1);

namespace Laracon\Order\Application\Http\Controllers;

use Laracon\Order\Application\Http\Requests\StoreOrderRequest;
use Laracon\Order\Application\Http\Resources\Order as OrderResource;
use Laracon\Order\Domain\Models\Order;
use Laracon\Payment\Contracts\PaymentService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Laracon\Inventory\Contracts\ProductService;
use Laracon\Order\Domain\Models\CartItem;
use Laracon\Order\Domain\Models\Cart;

class OrderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param  \Laracon\Inventory\Contracts\ProductService  $productService
     * @param  \Laracon\Payment\Contracts\PaymentService  $paymentService
     * @return void
     */
    public function __construct(
        private ProductService $productService,
        private PaymentService $paymentService
    ) {}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Laracon\Order\Application\Http\Requests\StoreOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderRequest $request)
    {
        $order = null;
        $cart = Cart::findOrFail($request->cart_id);

        try {
            DB::transaction(function () use (&$order, $cart, $request) {
                $order = new Order([
                    'user_id' => $request->user()->id,
                    'shipping_address_id' => $request->shipping_address_id,
                ]);

                $cart->cartItems()->each(function (CartItem $cartItem) use ($order) {
                    $this->productService->decrementStock($cartItem->product_id, $cartItem->quantity);
                    $product = $this->productService->getProductById($cartItem->product_id);
                    $order->addOrderLine($product, $cartItem->quantity);
                });

                $order->checkout();

                $this->paymentService->pay(
                    $order->id,
                    $order->total_amount,
                    $request->payment_method
                );
            });
        } catch (\Throwable $th) {
            Log::debug($th->getMessage());
            return response()->json([
                'message' => 'An error occurred while processing your order.',
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return new OrderResource($order);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Laracon\Order\Domain\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return new OrderResource($order);
    }
}
