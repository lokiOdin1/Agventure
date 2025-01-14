<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request){

        $orders = Purchase::latest()->get();

        return view('orders.index',['title'=>'Orders page','orders'=>$orders]);        

    }
    public function show($id){

        $order = Purchase::findOrFail($id);

        return view('orders.show',['title' => 'Order page','order'=> $order]);

    }
    public function packed($id){

        $order = Purchase::findOrFail($id);

        $order->orderStatus = "packed";

        $order->save();

        return redirect('/admin/orders/{$id}');

    }
    public function shipped($id){

        $order = Purchase::findOrFail($id);

        $order->orderStatus = "shipped";

        $order->save();

        return redirect('/admin/orders/{$id}');

    }
    public function delivered($id){

        $order = Purchase::findOrFail($id);

        $order->orderStatus = "delivered";

        $order->save();

        return redirect('/admin/orders/{$id}');
    }
    public function display(Request $request){
        
        $id = $request->session()->get('loggedUser');    
        
        $orders = Purchase::latest()
            ->where('user_id',$id)
                ->get();

                return view('orders.display',['title' => 'Orders page','orders'=> $orders]);

    }
    public function displayOne($id){
 
        $order = Purchase::findOrFail($id);

        return view('orders.displayOne',['title' => 'Order page','order'=> $order]);
    }
    public function cancel($id){

        $order = Purchase::findOrFail($id);

        $order->orderStatus = "cancelled";

        $order->save();

        return redirect('/orders/{$id}');
    }

}
