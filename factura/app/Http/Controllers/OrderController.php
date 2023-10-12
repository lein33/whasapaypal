<?php

namespace App\Http\Controllers;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Resources\OrderProductResource;
use App\Http\Resources\OrderResource;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class OrderController extends Controller
{
    public function index()
    {
        $orders = OrderResource::collection(Order:: all()) ;

        return $orders;
    }
    public function create()
    {
        $products = Product::all();

        $customers = Customer::all();

        return [$products,$customers];
    }
    public function store(Request $request,Order $order)
    {   
        $order->cod_factura=Uuid::uuid1(1);
       $order->order_date=$request->order_date;
       $order->save();
       return response()->json($order);
    }
}