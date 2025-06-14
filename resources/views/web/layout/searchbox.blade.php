<form class="" action="{{ URL::to(@$vendordata->slug . '/products') }}" method="GET">

    <div class="input-group input-group-sm">

        <input type="text" class="form-control px-3 py-2 {{ session()->get('direction') == 2 ? 'rounded-start-0 rounded-end' : 'ltr' }}" name="name" placeholder="{{ trans('labels.search_here') }}" value="{{ request()->get('name') }}" required>

        <button type="submit" class="input-group-text btn btn-secondary text-capitalize {{ session()->get('direction') == 2 ? 'rounded-end-0 rounded-start' : 'ltr' }} px-4 min-search">Search here</button>

    </div>

</form>