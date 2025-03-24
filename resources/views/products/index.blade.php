@extends('layouts.admin')

@section('title', 'Products Management')
@section('content-header', 'Products Management')
@section('content-actions')
@endsection

@section('content')
<style>
    .card-img-top {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }
    .stars {
        color: #6fd943;
        font-size: 25px;
    }
    .discount {
        color: #6fd943;
        font-weight: bold;
    }
    .original-price {
        text-decoration: line-through;
        color: grey;
    }
    .final-price {
        font-weight: bold;
        font-size: 18px;
    }
    .free-delivery {
        color: blue;
        font-weight: bold;
    }
    .price-container {
        display: flex;
        gap: 10px;
        align-items: center;
    }
    .purchase-btn {
        width: 100%;
        text-align: center;
        background: #007bff;
        color: white;
        border: none;
        padding: 10px;
        cursor: pointer;
    }
</style>

<h3>My Products</h3>

<div class="recharge-balance" style="position: absolute; top: 10px; right: 10px; font-size: 16px; background-color: #f1f1f1; padding: 5px 10px; border-radius: 5px;">
    <strong>{{ __('Available Balance: Rs') }} {{ $purchase_wallet }}</strong>
</div>

<br>

<div class="row">
    @foreach ($products as $product)
    <div class="col-md-3">
        <div class="card">
            <img src="{{ asset('admin/storage/app/public/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
            <div class="card-body">
                <h5 class="card-title">{{ $product->name }}</h5>
                <p class="card-text">{{ $product->description }}</p>
                <p class="stars">&#9733;&#9733;&#9733;&#9733;&#9734;</p>
                <div class="price-container">
                    <p class="discount">&#x2193; {{ round((($product->amount - $product->offer) / $product->amount) * 100) }}% OFF</p>
                    <p class="original-price">₹{{ $product->amount }}</p>
                    <p class="final-price">₹{{ $product->offer }}</p>
                </div>
                <p class="free-delivery">🚚 Free Delivery</p>
                <button class="btn btn-primary purchase-btn" 
                        data-id="{{ $product->id }}" 
                        data-price="{{ $product->offer }}"
                        data-wallet="{{ $purchase_wallet }}"
                        data-referrals="{{ $referral_count }}">
                    Purchase
                </button>
            </div>
        </div>
    </div>
    @endforeach
</div>

<!-- Address Modal -->
<div class="modal fade" id="addressModal" tabindex="-1" aria-labelledby="addressModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addressModalLabel">Enter Your Address</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="purchase-form">
                    @csrf
                    <input type="hidden" id="product_id" name="product_id">
                    <input type="hidden" id="price" name="price">
                    
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="Enter your address" required>
                    </div>
                    
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-success">Place Order</button>
                        <button type="button" class="btn btn-secondary ms-2" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
<script>
document.addEventListener("DOMContentLoaded", () => {
    const modal = new bootstrap.Modal(document.getElementById('addressModal'));

    document.querySelectorAll('.purchase-btn').forEach(button => {
        button.addEventListener('click', function () {
            const productId = this.dataset.id;
            const price = parseFloat(this.dataset.price);
            const wallet = parseFloat(this.dataset.wallet);
            const referrals = parseInt(this.dataset.referrals);

            if (referrals < 3) {
                alert("You need at least 3 referrals in Level 1 to make a purchase.");
                return;
            }

            if (wallet < price) {
                alert("Insufficient balance. Recharge your wallet.");
                return;
            }

            // Set product info in the modal
            document.getElementById('product_id').value = productId;
            document.getElementById('price').value = price;

            // Show the modal
            modal.show();
        });
    });

    // Handle form submission via AJAX
    document.getElementById('purchase-form').addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(this);
        const productId = formData.get('product_id');
        const price = formData.get('price');
        const address = formData.get('address');

        fetch("{{ route('products.purchase') }}", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                product_id: productId,
                price: price,
                address: address
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                window.location.href = "{{ route('products.index') }}";  // Redirect on success
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error("Error:", error);
            alert("Something went wrong. Please try again.");
        });

        // Hide the modal after submitting
        modal.hide();
    });
});
</script>

