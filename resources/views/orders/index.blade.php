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

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        {{ dd($errors) }}
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

                        <div class="form-group mb-3">
                            <label for="status">Status <span class="text-danger">*</span></label>
                            <select name="status" id="status" class="form-control">
                                <option value="">-- Choose Status --</option>
                                <option value="Menunggu Pembayaran">Menunggu Pembayaran</option>
                                <option value="Selesai">Selesai</option>
                            </select>
                        </div>

                        <div id="cartElement" class="mb-3">
                            <!-- Add more form fields as needed -->
                        </div>

                        <div id="totalPriceContainer" class="mb-3">
                            <label>Total Price (incl. PPN 11%)</label>
                            <input type="text" id="totalPrice" class="form-control" readonly>
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
                                        <button type="button" id="addToCartBtn" class="btn btn-success btn-add-to-cart"
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
            let cartItemIdCounter = 0;

            function updateTotalPrice() {
                let totalPrice = 0;

                // Loop through all cart items and calculate the total price
                $(".btn-add-to-cart").each(function() {
                    const itemId = $(this).attr('data-item-id');
                    const itemPrice = parseFloat($(this).attr('data-item-price'));
                    const itemQuantity = parseInt($("#quantities_cartItem_" + itemId).val());

                    totalPrice += itemPrice * itemQuantity;
                });

                // Apply PPN (11%)
                const ppnRate = 0.11;
                const ppn = totalPrice * ppnRate;
                totalPrice += ppn;

                // Update the total price input field
                $("#totalPrice").val(totalPrice.toFixed(2));
            }

            $(".btn-add-to-cart").on("click", function() {
                // alert('OK!');
                // alert($(this).attr('data-item-id'));

                const itemName = $(this).attr('data-item-name');
                const itemId = $(this).attr('data-item-id');
                const itemQuantity = 1;
                const itemsCart = $("#cartElement").html();

                // if (itemName && itemQuantity) {
                const cartItemId = `cartItem_${itemId}`;
                const cartItemRow = `
                        <div class="col-md-6">
                            <input type="text" name="items[]" class="form-control" value="${itemId}" readonly hidden>
                        </div>
                        <div class="row mb-2" id="${cartItemId}">
                            <div class="col-md-6">
                                <input type="text" class="form-control" value="${itemName}" readonly>
                            </div>
                            <div class="col-md-3">
                                <input type="number" id="quantities_${cartItemId}" name="quantities[]" class="form-control" value="${itemQuantity}" readonly>
                            </div>
                            <div class="col-md-3 float-end">
                                <button type="button" class="btn btn-danger btn-remove-cart-item" data-target="${cartItemId}">
                                    Remove
                                </button>
                            </div>
                        </div>
                    `;

                if ($('#' + cartItemId).length) {
                    // alert('ADA!');
                    var xquantities = $('#quantities_' + cartItemId).val();
                    $('#quantities_' + cartItemId).val(parseInt(xquantities) + 1);
                } else {
                    // alert('TIMPA');
                    $("#cartElement").html(cartItemRow + '' + itemsCart);
                }
                // }

                // Update the total price whenever a new item is added to the cart
                updateTotalPrice();
            });

            $("#OrderForm").on("click", ".btn-remove-cart-item", function() {
                const targetId = $(this).data("target");
                $("#" + targetId).remove();

                // Update the total price whenever an item is removed from the cart
                updateTotalPrice();
            });
        });
    </script>
@endsection
