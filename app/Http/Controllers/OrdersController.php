<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Service;
use App\Order;
use App\ServiceCode;
use App\Bundle;
use App\Transaction;
use App\DataTables\OrdersDataTable;
class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $user_id = $user->id;
        $orders = DB::table('orders')->where('user_id', $user_id)->latest()->paginate(5);
        // dd($orders);
        return view('index.userorderslist', ['orders' => $orders]);
    }

    public function admin_show(OrdersDataTable $datatable) {
        return $datatable->render('orders.index');
        // $orders = Order::all();
        // return view('orders.index', ['orders' => $orders]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $user_id =$user->id;
        $wallet =$user->wallet;
        $user_balance = $wallet->balance;
        $bundle_id = $request->bundle_id;
        $service_id = $request->service_id;
        $service = Service::find($service_id);
        $service_price =$service->price;
        $order_info = $request->info;
        $order =$request->all();
        $order['user_id'] = $user_id;
        if($bundle_id) { // if order is bundle do the code below
            $bundle = Bundle::find($bundle_id);
            $bundle_price = $bundle->price;
            if ($bundle_price > $user_balance) { // check user balance if is lower than bundle price
                session()->flash('error', 'you don\'t have money to do this operator');
                return redirect()->route('index.service.show', $service_id);
            }
            if ($bundle->bundletype->name != 'instant') { // if the service ordered is a bundle but not instant type do the code below
                return 'this bundle is not instant';
            }
            elseif($bundle->bundle_codes->count()) { //if bundle type is instant and it's have codes, record the order with the code and return the buyer to the order details page and display the code inside it.
                $order['price'] = $bundle->price;
                $order['title'] = $bundle->service->title . '<br>' . $bundle->name;
                $bundle_code = DB::table('service_codes')->where(['bundle_id' => $bundle->id, 'status' => 'unpaid'])->first();
                if($bundle_code) { //check if there is code in this bundle and it's unpaid yet
                    $order['response'] = 'Your code is: ' . $bundle_code->code;
                    $order['status'] = true;
                    $transaction =new Transaction([
                        'transaction' => '-' . $bundle_price,
                        'balance_after' => ($user_balance - $bundle_price),
                        'info'          => $order['title']
                        ]);
                    $wallet->balance = $user_balance - $bundle_price;
                    $wallet->save();
                    $wallet->transactions()->save($transaction);
                    $bundle_code=ServiceCode::find($bundle_code->id);
                    $bundle_code->status = 'paid';
                    $bundle_code->save();
                    Order::create($order)->bundles()->attach($bundle_id);
                    return redirect()->route('orders.index');
                }
                else{ // if there's no codes available with status unpaid do this
                    return 'no codes availabe';
                }
            }
            else{ // return the instant code is empty and send mail to admin to add more codes
                return 'this bundle codes is empty';
            }
        }
        elseif($order_info){ // if order type is delay and not a bundle
            if ($service_price > $user_balance) { // check user balance if is lower than bundle price
                session()->flash('error', 'you don\'t have money to do this operator');
                return redirect()->route('index.service.show', $service_id);
            }
            $order['title'] = $service->title;
            $order['price'] = $service_price;
            $transaction =new Transaction([
                'transaction' => '-' . $service_price,
                'balance_after' => ($user_balance - $service_price),
                'info'          => $order['title']
                ]);
            $wallet->balance = $user_balance - $service_price;
            $wallet->save();
            $wallet->transactions()->save($transaction);
            Order::create($order)->services()->attach($service_id);
            session()->flash('success', 'your order is successfully');
            return redirect()->route('orders.index');
        }
        else{ //request is not valid
            echo 'hello';
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
