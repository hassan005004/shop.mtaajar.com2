<?php $__env->startSection('contents'); ?>
    <!------ breadcrumb ------>

    <section class="py-4 bg-light">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="<?php echo e(session()->get('direction') == 2 ? 'breadcrumb-item-rtl' : 'breadcrumb-item'); ?>"><a
                            class="text-dark fw-600"
                            href="<?php echo e(URL::to(@$vendordata->slug . '/')); ?>"><?php echo e(trans('labels.home')); ?></a>
                    </li>
                    <li class="text-muted <?php echo e(session()->get('direction') == 2 ? 'breadcrumb-item-rtl' : 'breadcrumb-item'); ?> active"
                        aria-current="page"><?php echo e(trans('labels.add_money')); ?></li>
                </ol>
            </nav>
        </div>
    </section>
    <section class="product-prev-sec product-list-sec">
        <div class="container my-5">
            <div class="user-bg-color mb-4">
                <div class="row g-3">
                    <?php echo $__env->make('web.user.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <div class="col-lg-8 col-xxl-9">
                        <div class="card p-3 border rounded user-form">
                            <div class="settings-box">
                                <h5 class="text-dark mb-3 border-bottom pb-3 profile-title">
                                    <?php echo e(trans('labels.add_money')); ?>

                                </h5>
                                <div class="settings-box-body dashboard-section">
                                    <p class="mb-2 fw-500"><?php echo e(trans('labels.add_amount')); ?></p>
                                    <div class="mb-3">
                                        <div class="input-group">
                                            <span
                                                class="input-group-text fw-500 fs-15"><?php echo e(helper::appdata($vendordata->id)->currency); ?></span>
                                            <input type="number" name="amount" id="amount" class="form-control fs-15"
                                                aria-label="Amount (to the nearest dollar)">
                                        </div>
                                    </div>
                                    <div class="row justify-content-between border-bottom">
                                        <div class="col-xl-6 col-12">
                                            <p class="mb-0 fw-500"><?php echo e(trans('labels.notes')); ?> :</p>
                                            <ul class="p-0 pb-3 mt-1">
                                                <li class="text-muted fs-7 d-flex gap-2 align-items-center">
                                                    <i class="fa-regular fa-circle-check text-success"></i>
                                                    <?php echo e(trans('labels.wallet_note_1')); ?>

                                                </li>
                                                <li class="text-muted fs-7 d-flex gap-2 align-items-center">
                                                    <i class="fa-regular fa-circle-check text-success"></i>
                                                    <?php echo e(trans('labels.wallet_note_2')); ?>

                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-xl-6 col-12">
                                            <?php echo $__env->make('web.service-trusted', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        </div>
                                    </div>
                                    <p class="mb-2 fw-500"><?php echo e(trans('labels.payment_option')); ?></p>
                                    <div class="recharge_payment_option row g-3">
                                        <?php $key =0; ?>
                                        <?php $__currentLoopData = $getpaymentmethods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                // Check if the current $payment is a system addon and activated
                                                $systemAddonActivated = false;

                                                $addon = App\Models\SystemAddons::where(
                                                    'unique_identifier',
                                                    $payment->unique_identifier,
                                                )->first();
                                                if ($addon != null && $addon->activated == 1) {
                                                    $systemAddonActivated = true;
                                                }
                                            ?>
                                            <?php if($systemAddonActivated): ?>
                                                <label class="form-check-label col-md-6 cp"
                                                    for="<?php echo e($payment->payment_type); ?>">
                                                    <div class="payment-check w-100">
                                                        <img src="<?php echo e(helper::image_path($payment->image)); ?>"
                                                            class="img-fluid" alt="" width="40px" />
                                                        <?php if(strtolower($payment->payment_type) == '2'): ?>
                                                            <input type="hidden" name="razorpay" id="razorpay"
                                                                value="<?php echo e($payment->public_key); ?>">
                                                        <?php endif; ?>
                                                        <?php if(strtolower($payment->payment_type) == '3'): ?>
                                                            <input type="hidden" name="stripe" id="stripe"
                                                                value="<?php echo e($payment->public_key); ?>">
                                                        <?php endif; ?>
                                                        <?php if(strtolower($payment->payment_type) == '4'): ?>
                                                            <input type="hidden" name="flutterwavekey" id="flutterwavekey"
                                                                value="<?php echo e($payment->public_key); ?>">
                                                        <?php endif; ?>
                                                        <?php if(strtolower($payment->payment_type) == '5'): ?>
                                                            <input type="hidden" name="paystackkey" id="paystackkey"
                                                                value="<?php echo e($payment->public_key); ?>">
                                                        <?php endif; ?>

                                                        <p class="m-0"><?php echo e($payment->payment_name); ?></p>
                                                        <input
                                                            class="form-check-input payment_radio payment-input <?php echo e(session()->get('direction') == '2' ? 'me-auto' : 'ms-auto'); ?>"
                                                            type="radio" name="transaction_type"
                                                            value="<?php echo e($payment->payment_type); ?>"
                                                            data-currency="<?php echo e($payment->currency); ?>"
                                                            <?php echo e($key++ == 0 ? 'checked' : ''); ?>

                                                            id="<?php echo e($payment->payment_type); ?>"
                                                            data-payment_type="<?php echo e(strtolower($payment->payment_type)); ?>"
                                                            style="">

                                                        <?php if(strtolower($payment->payment_type) == '6'): ?>
                                                            <input type="hidden"
                                                                value="<?php echo e($payment->payment_description); ?>"
                                                                id="bank_payment">
                                                        <?php endif; ?>
                                                    </div>
                                                </label>
                                                <?php if($payment->payment_type == 3): ?>
                                                    <div class="my-3 d-none" id="card-element"></div>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>

                                    <div class="col-12 d-flex gap-2 mt-3 justify-content-end">
                                        <button class="btn btn-secondary btn-submit rounded-0 wallet_recharge"
                                            onclick="addmoney()"><?php echo e(trans('labels.proceed_pay')); ?></button>
                                    </div>

                                    <input type="hidden" name="walleturl" id="walleturl"
                                        value="<?php echo e(URL::to($vendordata->slug . '/wallet/recharge')); ?>">
                                    <input type="hidden" name="successurl" id="successurl"
                                        value="<?php echo e(URL::to($vendordata->slug . '/wallet')); ?>">
                                    <input type="hidden" name="user_name" id="user_name" value="<?php echo e(Auth::user()->name); ?>">
                                    <input type="hidden" name="user_email" id="user_email"
                                        value="<?php echo e(Auth::user()->email); ?>">
                                    <input type="hidden" name="user_mobile" id="user_mobile"
                                        value="<?php echo e(Auth::user()->mobile); ?>">
                                    <input type="hidden" name="vendor_id" id="vendor_id" value="<?php echo e($vendordata->id); ?>">
                                    <input type="hidden" name="title" id="title"
                                        value="<?php echo e(helper::appdata($vendordata->id)->website_title); ?>">
                                    <input type="hidden" name="logo" id="logo"
                                        value="<?php echo e(helper::appdata(@$vendordata->id)->image); ?>">

                                    <input type="hidden" name="addsuccessurl" id="addsuccessurl"
                                        value="<?php echo e(URL::to($vendordata->slug . '/addwalletsuccess')); ?>">
                                    <input type="hidden" name="addfailurl" id="addfailurl"
                                        value="<?php echo e(URL::to($vendordata->slug . '/addfail')); ?>">

                                    <input type="hidden" name="myfatoorahurl" id="myfatoorahurl"
                                        value="<?php echo e(URL::to($vendordata->slug . '/placeorder/myfatoorahrequest')); ?>">
                                    <input type="hidden" name="mercadopagourl" id="mercadopagourl"
                                        value="<?php echo e(URL::to($vendordata->slug . '/placeorder/mercadopagorequest')); ?>">
                                    <input type="hidden" name="paypalurl" id="paypalurl"
                                        value="<?php echo e(URL::to($vendordata->slug . '/placeorder/paypalrequest')); ?>">
                                    <input type="hidden" name="toyyibpayurl" id="toyyibpayurl"
                                        value="<?php echo e(URL::to($vendordata->slug . '/placeorder/toyyibpayrequest')); ?>">
                                    <input type="hidden" name="paytaburl" id="paytaburl"
                                        value="<?php echo e(URL::to($vendordata->slug . '/placeorder/paytabrequest')); ?>">
                                    <input type="hidden" name="phonepeurl" id="phonepeurl"
                                        value="<?php echo e(URL::to($vendordata->slug . '/placeorder/phoneperequest')); ?>">
                                    <input type="hidden" name="mollieurl" id="mollieurl"
                                        value="<?php echo e(URL::to($vendordata->slug . '/placeorder/mollierequest')); ?>">
                                    <input type="hidden" name="khaltiurl" id="khaltiurl"
                                        value="<?php echo e(URL::to($vendordata->slug . '/placeorder/khaltirequest')); ?>">
                                    <input type="hidden" name="xenditurl" id="xenditurl"
                                        value="<?php echo e(URL::to($vendordata->slug . '/placeorder/xenditrequest')); ?>">

                                    <input type="hidden" name="slug" id="slug"
                                        value="<?php echo e($vendordata->slug); ?>">

                                    <input type="hidden" value="<?php echo e(trans('messages.payment_selection_required')); ?>"
                                        name="payment_type_message" id="payment_type_message">

                                    <input type="hidden" value="<?php echo e(trans('messages.amount_required')); ?>"
                                        name="amount_message" id="amount_message">

                                    <form action="<?php echo e(url($vendordata->slug . '/placeorder/paypalrequest')); ?>"
                                        method="post" class="d-none">
                                        <?php echo e(csrf_field()); ?>

                                        <input type="hidden" name="return" value="2">
                                        <input type="submit" class="callpaypal" name="submit">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script src="https://checkout.stripe.com/v2/checkout.js"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script src="https://checkout.flutterwave.com/v3.js"></script>
    <script src="https://js.paystack.co/v1/inline.js"></script>
    <script src="<?php echo e(url(env('ASSETPATHURL') . 'web-assets/js/wallet.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/web/user/addmoney.blade.php ENDPATH**/ ?>