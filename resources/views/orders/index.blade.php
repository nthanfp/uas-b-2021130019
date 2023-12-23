@extends('layouts.master')

@section('title', 'Order')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header bg-success text-white"><i class="fa fa-shopping-cart"></i> Add New Order</div>
                <div class="card-body" id="OrderForm">

                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('orders.store') }}" method="POST" id="newOrderForm">
                        @csrf

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="Menunggu Pembayaran">Menunggu Pembayaran</option>
                                <option value="Selesai">Selesai</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="items">Select Items</label>
                            <select name="items[]" id="items" class="form-control" multiple>
                                @foreach ($availableItems as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }} - Stok {{ $item->stok }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group" id="cartItems">
                            <!-- Cart items will be dynamically added here -->
                        </div>

                        <button type="submit" class="btn btn-success">Submit Order</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header bg-success text-white"><i class="fa fa-list"></i> List Item</div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Stock</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($availableItems as $item)
                                <tr>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->stok }}</td>
                                    <td>{{ $item->harga }}</td>
                                    <td>
                                        <button type="button" class="btn btn-success btn-add-to-cart"
                                            data-item-id="{{ $item->id }}" data-item-name="{{ $item->nama }}"
                                            data-item-price="{{ $item->harga }}">
                                            Add to Cart
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script type="module">
        $(document).ready(function() {
            // Counter for unique cart item IDs
            let cartItemIdCounter = 0;

            // Function to add a new cart item row
            function addCartItemRow(itemId, itemName, itemPrice) {
                const cartItemsContainer = $("#cartItems");
                const cartItemId = `cartItem_${cartItemIdCounter++}`;

                const cartItemRow = `
                    <div class="row mb-2" id="${cartItemId}">
                        <div class="col-md-6">
                            <input type="hidden" name="cart_items[${cartItemId}][item_id]" value="${itemId}">
                            <label>${itemName}</label>
                        </div>
                        <div class="col-md-3">
                            <label>Quantity</label>
                            <input type="number" name="cart_items[${cartItemId}][quantity]" class="form-control" required>
                        </div>
                        <div class="col-md-3">
                            <label>Price</label>
                            <input type="text" class="form-control" value="${itemPrice}" readonly>
                        </div>
                        <div class="col-md-12">
                            <button type="button" class="btn btn-danger btn-remove-cart-item" data-target="${cartItemId}">
                                Remove
                            </button>
                        </div>
                    </div>
                `;

                cartItemsContainer.append(cartItemRow);
            }

            // Function to handle the "Add to Cart" button click
            $(".btn-add-to-cart").on("click", function() {
                const itemId = $(this).data("item-id");
                const itemName = $(this).data("item-name");
                const itemPrice = $(this).data("item-price");

                // Add the item to the cart
                addCartItemRow(itemId, itemName, itemPrice);
            });

            // Function to handle the "Remove" button click for cart items
            $("#cartItems").on("click", ".btn-remove-cart-item", function() {
                const targetId = $(this).data("target");
                $("#" + targetId).remove();
            });
        });
    </script>
@endsection
