<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Item;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $availableItems = Item::where('stok', '>', 1)->get(); // Ambil semua item yang tersedia
        $itemStocks = Item::all(); // Ambil semua item yang tersedia

        return view('orders.index', compact('availableItems', 'itemStocks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            // dd($request);

            // Start the database transaction
            DB::beginTransaction();

            // Validate the request data
            $request->validate([
                'status' => 'required|in:Menunggu Pembayaran,Selesai',
                'items' => 'required|array',
                'quantities' => 'required|array',
            ]);

            // Create a new order
            $order = new Order([
                'status' => $request->input('status'),
            ]);
            $order->save();

            // Process order items
            $items = $request->input('items');
            $quantities = $request->input('quantities');

            foreach ($items as $key => $itemId) {
                $item = Item::find($itemId);

                // Check if the item is available in the database
                if (!$item) {
                    // Rollback the transaction and return a response
                    DB::rollBack();
                    return redirect()->back()->with('error', 'Invalid item selected.');
                }

                // Check if the requested quantity is available
                if ($quantities[$key] > $item->stok) {
                    // Rollback the transaction and return a response
                    DB::rollBack();
                    return redirect()->back()->with('error', 'Not enough stock for ' . $item->nama);
                }

                // Save the order item
                $order->orderItems()->attach($itemId, ['quantity' => $quantities[$key]]);

                // Update the item stock
                $item->stok -= $quantities[$key];
                $item->save();
            }

            // Commit the transaction
            DB::commit();

            // Redirect the user to the home page with a success message
            return redirect()->route('orders.index')->with('success', 'Order has been placed successfully.');
        } catch (\Exception $e) {
            // An error occurred, rollback the transaction
            DB::rollBack();

            // Log the exception for debugging purposes
            \Log::error($e);
            // dd($e->getMessage());

            // Handle the exception, log it, or return an error response
            return redirect()->back()->with('error', 'An error occurred while processing the order.');
        }
    }

    /**
     * Display all resource.
     */
    public function list(Order $order)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
