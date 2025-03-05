{{ Form::model($payment_screenshots, ['route' => ['payment_screenshots.update', $payment_screenshots->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
<div class="modal-body">
    <div class="row">
        <!-- Avatar Image Upload -->
        <div class="form-group col-md-12">
            {{ Form::label('payment_screenshot', __('Payment Screenshot'), ['class' => 'form-label']) }}
            <div class="mb-2">
                <img src="{{ asset('storage/app/public/' . $payment_screenshots->screenshot) }}" class="img-thumbnail" width="100" alt="Gift Icon">
            </div>
            <input type="file" name="payment_screenshot" class="form-control">
        </div>
        <div class="form-group col-md-12">
            {{ Form::label('coins', __('Coins'), ['class' => 'form-label']) }}
            {{ Form::number('coins', null, ['class' => 'form-control', 'required']) }}
        </div>
    </div>
</div>
<div class="modal-footer">
    <input type="button" value="{{ __('Cancel') }}" class="btn btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{ __('Update Payment Screenshot') }}" class="btn btn-primary">
</div>
{{ Form::close() }}
