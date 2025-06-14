<?php
    if (Auth::user()->type == 4) {
        $vendor_id = Auth::user()->vendor_id;
    } else {
        $vendor_id = Auth::user()->id;
    }
?>
<?php $__env->startSection('content'); ?>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="text-capitalize fw-600 text-dark fs-4"><?php echo e(trans('labels.plan_details')); ?></h5>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(URL::to('admin/transaction')); ?>"><?php echo e(trans('labels.transaction')); ?></a>
                </li>
                <li class="breadcrumb-item active <?php echo e(session()->get('direction') == 2 ? 'breadcrumb-rtl' : ''); ?>"
                    aria-current="page"><?php echo e(trans('labels.plan_details')); ?></li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-4 col-sm-6 mb-3">
            <div class="card border-0 box-shadow">
                <div class="card-header bg-secondary sub-plan text-light">
                    <div class="d-flex justify-content-between">
                        <h5 class="text-light"><?php echo e($plan->plan_name); ?></h5>
                    </div>
                </div>
                <div class="card-body">
                
                    <div class="mb-3">
                        <h2 class="mb-1"><?php echo e(helper::currency_formate($plan->amount, '')); ?>

                            <span class="fs-7 text-muted">/
                                <?php if($plan->duration != null || $plan->duration != ''): ?>
                                    <?php if($plan->duration == 1): ?>
                                        <?php echo e(trans('labels.one_month')); ?>

                                    <?php elseif($plan->duration == 2): ?>
                                        <?php echo e(trans('labels.three_month')); ?>

                                    <?php elseif($plan->duration == 3): ?>
                                        <?php echo e(trans('labels.six_month')); ?>

                                    <?php elseif($plan->duration == 4): ?>
                                        <?php echo e(trans('labels.one_year')); ?>

                                    <?php elseif($plan->duration == 5): ?>
                                        <?php echo e(trans('labels.lifetime')); ?>

                                    <?php endif; ?>
                                <?php else: ?>
                                    <?php echo e($plan->days); ?>

                                    <?php echo e($plan->days > 1 ? trans('labels.days') : trans('labels.day')); ?>

                                <?php endif; ?>


                            </span>
                        </h2>
                        <?php if($plan->tax != null && $plan->tax != ''): ?>
                        <small class="text-danger"><?php echo e(trans('labels.exclusive_taxes')); ?></small><br>
                    <?php else: ?>
                        <small class="text-success"><?php echo e(trans('labels.inclusive_taxes')); ?></small> <br>
                    <?php endif; ?>
                        <small class="text-muted text-center"><?php echo e($plan->description); ?></small>
                    </div>
                    <ul class="pb-5">
                        <?php $features = ($plan->features == null ? null : explode('|', $plan->features));?>
                        <li class="mb-2 d-flex"> <i class="fa-regular fa-circle-check text-secondary "></i>
                            <span class="mx-2">
                                <?php echo e($plan->service_limit == -1 ? trans('labels.unlimited') : $plan->service_limit); ?>

                                <?php echo e($plan->service_limit > 1 || $plan->service_limit == -1 ? trans('labels.products') : trans('labels.product')); ?>

                            </span>
                        </li>
                        <li class="mb-2 d-flex"> <i class="fa-regular fa-circle-check text-secondary "></i>
                            <span class="mx-2">
                                <?php echo e($plan->appoinment_limit == -1 ? trans('labels.unlimited') : $plan->appoinment_limit); ?>

                                <?php echo e($plan->appoinment_limit > 1 || $plan->appoinment_limit == -1 ? trans('labels.orders') : trans('labels.order')); ?>

                            </span>
                        </li>
                        <?php
                            $themes = [];
                            if ($plan->themes_id != '' && $plan->themes_id != null) {
                                $themes = explode('|', $plan->themes_id);
                        } ?>
                        <li class="mb-2 d-flex"> <i class="fa-regular fa-circle-check text-secondary "></i>
                            <span class="mx-2"><?php echo e(count($themes)); ?>

                                <?php echo e(count($themes) > 1 ? trans('labels.themes') : trans('labels.theme')); ?></span>
                                
                                <a onclick="themeinfo('<?php echo e($plan->id); ?>','<?php echo e($plan->themes_id); ?>','<?php echo e($plan->name); ?>')"
                                tooltip="<?php echo e(trans('labels.info')); ?>" class="cursor-pointer"> <i
                                    class="fa-regular fa-circle-info"></i> </a>
                        </li>
                        <?php if($plan->coupons == 1): ?>
                            <li class="mb-2 d-flex"> <i class="fa-regular fa-circle-check text-secondary "></i>
                                <span class="mx-2"><?php echo e(trans('labels.coupons')); ?></span>
                            </li>
                        <?php endif; ?>
                        <?php if($plan->custom_domain == 1): ?>
                            <li class="mb-2 d-flex"> <i class="fa-regular fa-circle-check text-secondary "></i>
                                <span class="mx-2"><?php echo e(trans('labels.custom_domain_available')); ?></span>
                            </li>
                        <?php endif; ?>
                        <?php if($plan->google_analytics == 1): ?>
                            <li class="mb-2 d-flex"> <i class="fa-regular fa-circle-check text-secondary "></i>
                                <span class="mx-2"><?php echo e(trans('labels.google_analytics_available')); ?></span>
                            </li>
                        <?php endif; ?>
                        <?php if($plan->blogs == 1): ?>
                            <li class="mb-2 d-flex"> <i class="fa-regular fa-circle-check text-secondary "></i>
                                <span class="mx-2"><?php echo e(trans('labels.blogs')); ?></span>
                            </li>
                        <?php endif; ?>
                        <?php if($plan->social_logins == 1): ?>
                            <li class="mb-2 d-flex"> <i class="fa-regular fa-circle-check text-secondary "></i>
                                <span class="mx-2"><?php echo e(trans('labels.social_logins')); ?></span>
                            </li>
                        <?php endif; ?>
                        <?php if($plan->sound_notification == 1): ?>
                            <li class="mb-2 d-flex"> <i class="fa-regular fa-circle-check text-secondary "></i>
                                <span class="mx-2"><?php echo e(trans('labels.sound_notification')); ?></span>
                            </li>
                        <?php endif; ?>
                        <?php if($plan->whatsapp_message == 1): ?>
                            <li class="mb-2 d-flex"> <i class="fa-regular fa-circle-check text-secondary "></i>
                                <span class="mx-2"><?php echo e(trans('labels.whatsapp_message')); ?></span>
                            </li>
                        <?php endif; ?>
                        <?php if($plan->telegram_message == 1): ?>
                            <li class="mb-2 d-flex"> <i class="fa-regular fa-circle-check text-secondary "></i>
                                <span class="mx-2"><?php echo e(trans('labels.telegram_message')); ?></span>
                            </li>
                        <?php endif; ?>
                        <?php if($plan->pos == 1): ?>
                            <li class="mb-2 d-flex"> <i class="fa-regular fa-circle-check text-secondary "></i>
                                <span class="mx-2"><?php echo e(trans('labels.pos')); ?></span>
                            </li>
                        <?php endif; ?>
                        <?php if($plan->vendor_app == 1): ?>
                            <li class="mb-2 d-flex"> <i class="fa-regular fa-circle-check text-secondary "></i>
                                <span class="mx-2"><?php echo e(trans('labels.vendor_app_available')); ?></span>
                            </li>
                        <?php endif; ?>
                        <?php if($plan->customer_app == 1): ?>
                            <li class="mb-2 d-flex"> <i class="fa-regular fa-circle-check text-secondary "></i>
                                <span class="mx-2"><?php echo e(trans('labels.customer_app')); ?></span>
                            </li>
                        <?php endif; ?>
                        <?php if($plan->pwa == 1): ?>
                            <li class="mb-2 d-flex"> <i class="fa-regular fa-circle-check text-secondary "></i>
                                <span class="mx-2"><?php echo e(trans('labels.pwa')); ?></span>
                            </li>
                        <?php endif; ?>
                        <?php if($plan->role_management == 1): ?>
                            <li class="mb-2 d-flex"> <i class="fa-regular fa-circle-check text-secondary "></i>
                                <span class="mx-2"><?php echo e(trans('labels.role_management')); ?></span>
                            </li>
                        <?php endif; ?>
                        <?php if($plan->pixel == 1): ?>
                            <li class="mb-2 d-flex"> <i class="fa-regular fa-circle-check text-secondary "></i>
                                <span class="mx-2"><?php echo e(trans('labels.pixel')); ?></span>
                            </li>
                        <?php endif; ?>
                        <?php if($features != null): ?>
                            <?php $__currentLoopData = $features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="mb-2 d-flex"> <i class="fa-regular fa-circle-check text-secondary "></i>
                                    <span class="mx-2"> <?php echo e($feature); ?> </span>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-8 col-sm-6 mb-3 payments">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <a href="<?php echo e(URL::to('/admin/transaction/generatepdf-' . $plan->id)); ?>" class="btn btn-secondary"
                tooltip="<?php echo e(trans('labels.downloadpdf')); ?>"><i class="fa-solid fa-file-pdf"></i></a>
        </div>
        <?php if(Auth::user()->type == 1): ?>
            <div class="card border-0 box-shadow mb-3">
                <div class="card-body">
                    <h5 class="card-title mb-3"><?php echo e(trans('labels.vendor_info')); ?></h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between border-bottom-0">
                            <p><?php echo e(trans('labels.name')); ?></p>
                            <p class="fw-bolder"><?php echo e($plan['vendor_info']->name); ?></p>
                        </li>
                        <li class="list-group-item d-flex justify-content-between border-bottom-0">
                            <p><?php echo e(trans('labels.email')); ?></p>
                            <p class="fw-bolder"><?php echo e($plan['vendor_info']->email); ?></p>
                        </li>
                        <li class="list-group-item d-flex justify-content-between border-bottom-0">
                            <p><?php echo e(trans('labels.mobile')); ?></p>
                            <p class="fw-bolder"><?php echo e($plan['vendor_info']->mobile); ?></p>
                        </li>
                    </ul>
                </div>
            </div>
        <?php endif; ?>
        <div class="card border-0 box-shadow">
            <div class="card-header p-3">
                <h5 class="card-title m-0"><?php echo e(trans('labels.plan_information')); ?></h5>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between">
                        <p>Transaction Number</p>
                        <p class="fw-bolder">#<?php echo e($plan->transaction_number); ?></p>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <p><?php echo e(trans('labels.purchase_date')); ?></p>
                        <p class="fw-bolder"><?php echo e(helper::date_formate($plan->purchase_date,$vendor_id)); ?></p>
                    </li>
                    <li class="list-group-item d-flex justify-content-between border-bottom-0">
                        <p><?php echo e(trans('labels.expire_date')); ?></p>
                        <p class="fw-bolder"><?php echo e(helper::date_formate($plan->expire_date,$vendor_id)); ?></p>
                    </li>
                </ul>
            </div>
        </div>
        <div class="card border-0 box-shadow mt-3">
            <div class="card-header p-3">
                <h5 class="card-title m-0"><?php echo e(trans('labels.Payment_information')); ?></h5>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between">
                        <p><?php echo e(trans('labels.payment_type')); ?></p>
                        <p class="fw-bolder">
                          
                            <?php if($plan->payment_type == 6): ?>
                                <?php echo e(@helper::getpayment($plan->payment_type, 1)->payment_name); ?>

                                : <small><a href="<?php echo e(helper::image_path($transaction->screenshot)); ?>" target="_blank"
                                        class="text-danger"><?php echo e(trans('labels.click_here')); ?></a></small>
                            <?php elseif(in_array($plan->payment_type, [1, 2, 3, 4, 5, 7, 8, 9, 10, 11, 12, 13, 14, 15])): ?>
                                <?php echo e(@helper::getpayment($plan->payment_type, 1)->payment_name); ?>

                                : <?php echo e($plan->payment_id); ?>

                            <?php elseif($plan->payment_type == 0): ?>
                                <?php echo e(trans('labels.manual')); ?>

                            <?php elseif($plan->amount == 0): ?>
                                -
                            <?php else: ?>
                                -
                            <?php endif; ?>
                        </p>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <p><?php echo e(trans('labels.sub_total')); ?></p>
                        <p class="fw-bolder"><?php echo e(helper::currency_formate($plan->amount, '')); ?></p>
                    </li>
                    <?php if($plan->amount != 0): ?>
                    <?php if($plan->tax != null && $plan->tax != ''): ?>
                        <?php
                            $tax = explode('|', $plan->tax);
                            $tax_name = explode('|', $plan->tax_name);
                        ?>
                        <?php $__currentLoopData = $tax; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tax_value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                       
                            <?php if($tax_value != 0): ?>
                                <li class="list-group-item d-flex justify-content-between border-bottom-2">

                                    <p><?php echo e($tax_name[$key]); ?></p>

                                    <p class="fw-bolder"><?php echo e(helper::currency_formate(@$tax[$key], '')); ?>


                                    </p>

                                </li>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>

                <?php endif; ?>
                
                   
                    <?php if($plan->offer_code != null && $plan->offer_amount != null): ?>
                        <li class="list-group-item d-flex justify-content-between border-bottom-2">
                            <p><?php echo e(trans('labels.discount')); ?> (<?php echo e($plan->offer_code); ?>)</p>
                            <p class="fw-bolder">-<?php echo e(helper::currency_formate($plan->offer_amount, '')); ?></p>
                        </li>
                    <?php endif; ?>

                    <li class="list-group-item d-flex justify-content-between">
                        <p><?php echo e(trans('labels.total')); ?> <?php echo e(trans('labels.amount')); ?></p>
                        <p class="fw-bolder text-dark">
                            <?php echo e(helper::currency_formate($plan->grand_total, '')); ?>

                        </p>
                    </li>
                    

                </ul>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script>
        function themeinfo(id, theme_id, plan_name) {
            let string = theme_id;
            let arr = string.split('|');
            $('#themeinfoLabel').text(plan_name);
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                url: "<?php echo e(URL::to('admin/themeimages')); ?>",
                method: 'GET',
                data: {
                    theme_id: arr
                },
                dataType: 'json',
                success: function(data) {
                    $('#theme_modalbody').html(data.output);
                    $('#themeinfo').modal('show');
                }
            })
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/admin/plan/plan_details.blade.php ENDPATH**/ ?>