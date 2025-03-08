{{ Form::model($payment_screenshot, ['route' => ['payment_screenshots.update', $payment_screenshot->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-12">
            {{ Form::label('payment_screenshot', __('Payment Screenshot'), ['class' => 'form-label']) }}
            <a href="{{ ('https://enlightapp.in/storage/app/public/' . $payment_screenshot->screenshots) }}" data-lightbox="image-{{ $payment_screenshot->id }}">
                                                <img class="user-img img-thumbnail img-fluid" 
                                                    src="{{('https://enlightapp.in/storage/app/public/' . $payment_screenshot->screenshots) }}" 
                                                    alt="Image" 
                                                    style="max-width: 100px; max-height: 100px;">
                                            </a>
        </div>
        <div class="form-group col-md-12">
            {{ Form::label('recharge', __('Recharge'), ['class' => 'form-label']) }}
            {{ Form::number('recharge', null, ['class' => 'form-control', 'required']) }}
        </div>
        <div class="form-group col-md-12">
            {{ Form::label('status', __('Status'), ['class' => 'form-label']) }}
            {{ Form::select('status', [0 => 'Pending', 1 => 'Verified', 2 => 'Cancelled'], null, ['class' => 'form-control', 'required']) }}
        </div>
    </div>
</div>
<div class="modal-footer">
    <input type="button" value="{{ __('Cancel') }}" class="btn btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{ __('Update Payment Screenshot') }}" class="btn btn-primary">
</div>
{{ Form::close() }}
