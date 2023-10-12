<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;
    protected $fillable = [ 'product_id', 'order_id','quantity','estado'];

    

    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function scopeOrderId($query, $cod_factura)
    {
             //return $query->where('order_id','LIKE', "%$order%")->where('estado','=', true);
             return $query->whereHas('order', function (Builder $subQuery) use ($cod_factura) {
                $subQuery->where('cod_factura', 'LIKE', "$cod_factura");    
            });
    }

}
