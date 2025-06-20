
<form method="POST" action="{{ URL::to('admin/products/get-product-variants-possibilities') }}">
    @csrf
    <div class="form-group">

        <label for="variant_name">{{ __('Variant Name') }}</label>
        <input class="form-control" name="variant_name" type="text" id="variant_name" placeholder="{{ __('Variant Name, i.e Size, Color etc') }}" onkeyup="this.value = this.value.replace(/[`\/\\|~_$&+,:;=?[\]@#{}'<>.^*()%!-/]/, '')">
    </div>
    <div class="form-group">
        <label for="variant_options">{{ __('Variant Options') }}</label>
        <input class="form-control" name="variant_options" type="text" id="variant_options" placeholder="{{ __('Variant Options separated by|pipe symbol, i.e Black|Blue|Red') }}">
    </div>
    <div class="form-group col-12 d-flex justify-content-end col-form-label">
        <input type="button" value="{{__('Cancel')}}" class="btn btn-danger px-sm-4" data-bs-dismiss="modal">
        <input type="button" value="{{__('Add Variants')}}" class="btn btn-primary add-variants px-sm-4">
    </div>
</form>
