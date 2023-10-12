<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderProductRequest;
use App\Http\Resources\OrderProductResource;
use App\Models\Order;
use App\Models\OrderProduct;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\Seller;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use LaravelDaily\Invoices\Classes\InvoiceItem;
class OrderProductController extends Controller
{
    static $lastId;

    public function index()
    {
        $orders = OrderProductResource::collection(OrderProduct:: all());

        return $orders;
    }
    public function store(StoreOrderProductRequest $request)
    {
        
        return (new (OrderProduct::create($request->all())));
       
    }

    public function parcial($ord_pro)
    {                   $total=0;
        $invoice=[];

        $order=OrderProductResource::collection(OrderProduct::OrderId($ord_pro)->get());
        $seller = new Buyer([
           // 'name'          => $order[0]->id,
           
            'invoicer' => [
                'name' => [
                    'given_name'=>'luis',
                    "surname"=> "Meyers"
                ],
                'address'=>[
                    "address_line_1"=>"1234 Main Street",
                    "admin_area_2"=>"Anytown",
                    "admin_area_1"=>"CA",
                    "postal_code"=>"98765",
                    "country_code"=>"US"
                ],
                "email_address"=>"sb-mtwtz27297041@business.example.com",
                'phones'=>[[
                    "country_code"=>"593",
                    "national_number"=>"990137716",
                    "phone_type"=>"HOME"
                ]],
                "website"=>"www.test.com",
                "tax_id"=> "ABcNkWSfb5ICTt73nD3QON1fnnpgNKBy- Jb5SeuGj185MNNw6g",
                "logo_url"=> "https://example.com/logo.PNG",
                "additional_notes"=> "2-4"
            ],
        ]);
        $buyer = new Buyer([
            'billing_info' => [
                'name' => [
                    'given_name'=>'estefany',
                    "surname"=> "Meyers"
                ],
                'address'=>[
                    "address_line_1"=>"1234 Main Street",
                    "admin_area_2"=>"Anytown",
                    "admin_area_1"=>"CA",
                    "postal_code"=>"98765",
                    "country_code"=>"US"
                ],
                "email_address"=>"sleandrojoel@hotmail.com",
                'phones'=>[[
                    "country_code"=>"593",
                    "national_number"=>"990137716",
                    "phone_type"=>"HOME"
                ]],
                "additional_info_value"=>"add-info"
            ],
        ]);
        if(count($order)>0)
        {
            
            foreach($order as $product){
                $total=$total+($product->product->price*$product->quantity);
                $items[] = (new InvoiceItem())->title($product->id)
                ->description($product->product->name)
                ->quantity($product->quantity)
                ->units(2)
                ->sub($product->product->price)
                ->tax($product->product->name,0)
                ->discount(5)
                ->unit_of_mesure($product->product->name)
    
                ;
            }
            $invoice = Invoice::make()
                ->buyer($buyer)
                ->seller($seller)
                ->taxRate(15)
                ->total_amount($total)
                ->addItems($items);
           ; 
        }
        
    return response()->json($invoice);
    }
    public function delete(OrderProduct $id)

    {

        $id->estado=false;
        $id->save();
        return response()->json(['res'=>'rs']);
    }
    public function delete_all()

    {
        OrderProduct::truncate();
        return response()->json(['res'=>'rs']);
    }
    
}
