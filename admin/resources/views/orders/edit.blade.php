{{ Form::model($order, ['route' => ['orders.update', $order->id], 'method' => 'PUT']) }}

<div class="modal-body">
    <div class="row">
       
        <!-- Product -->
        <div class="form-group col-md-12">
            {{ Form::label('product_id', __('Product'), ['class' => 'form-label']) }}
            <select name="product_id" class="form-control" required>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}" {{ $order->product_id == $product->id ? 'selected' : '' }}>{{ $product->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Price -->

        <div class="form-group col-md-12">
            {{ Form::label('price', __('Price'), ['class' => 'form-label']) }}
            {{ Form::text('price', $order->price, ['class' => 'form-control', 'required' => 'required']) }}
        </div>

        <!-- User -->

        <div class="form-group col-md-12">
            {{ Form::label('user_id', __('User'), ['class' => 'form-label']) }}
            <select name="user_id" class="form-control" required>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ $order->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Address -->

        <div class="form-group col-md-12">
            {{ Form::label('address', __('Address'), ['class' => 'form-label']) }}
            {{ Form::text('address', $order->address, ['class' => 'form-control', 'required' => 'required']) }}
        </div>

        <!-- Status -->
        <div class="form-group col-md-12">
            {{ Form::label('status', __('Status'), ['class' => 'form-label']) }}
            <select name="status" class="form-control" required>
                <option value="0" {{ $order->status == 0 ? 'selected' : '' }}>{{ __('Ordered') }}</option>
                <option value="1" {{ $order->status == 1 ? 'selected' : '' }}>{{ __('Dispatched') }}</option>
                <option value="2" {{ $order->status == 2 ? 'selected' : '' }}>{{ __('Delivered') }}</option>
                <option value="3" {{ $order->status == 3 ? 'selected' : '' }}>{{ __('Cancelled') }}</option>
            </select>
        </div>

        <!-- Live Tracking -->
        <div class="form-group col-md-12">
            {{ Form::label('live_tracking', __('Live Tracking'), ['class' => 'form-label']) }}
            {{ Form::text('live_tracking', $order->live_tracking, ['class' => 'form-control', 'required' => 'required']) }}
        </div>   

    </div>
</div>

<div class="modal-footer">
    <input type="button" value="{{ __('Cancel') }}" class="btn btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{ __('Update  Orders') }}" class="btn btn-primary">
</div>

{{ Form::close() }}

<script>
    let logoutTimer;

    function resetTimer() {
        clearTimeout(logoutTimer);
        logoutTimer = setTimeout(() => {
            window.location.href = "{{ route('login') }}";
        }, 300000); // 5 minutes
    }

    document.onload = resetTimer();
    document.onmousemove = resetTimer;
    document.onkeypress = resetTimer;
</script>