@if (helper::appdata($vendordata->id)->fake_sales_notification == 1)
<div id="sales-booster-popup" class="animation-slide_right {{ helper::appdata($vendordata->id)->sales_notification_position == '2' ? 'rtl' : '' }} rounded-3  d-lg-block d-none" style="display:none">
    <span class="close pos-absolute top {{ session()->get('direction') == '2' ? 'left' : 'right' }}">
        <i class="fa-light fa-xmark"></i>
    </span>
    <div class="sales-booster-popup-inner gap-3" id="notification_body">
        
    </div>
</div>
@endif