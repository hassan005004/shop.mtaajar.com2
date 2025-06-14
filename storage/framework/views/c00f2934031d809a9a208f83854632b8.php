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
                        aria-current="page"><?php echo e(trans('labels.wallet')); ?></li>
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
                                <div class="settings-box-header gap-3 pb-3 border-bottom flex-wrap mb-3">
                                    <div class="mb-0 d-flex align-items-center gap-3">
                                        <div>
                                            <h5 class="text-dark mb-2 profile-title">
                                                <?php echo e(trans('labels.wallet_balance')); ?>

                                            </h5>
                                            <p class="text-success fs-6 fw-600">
                                                <?php echo e(helper::currency_formate(Auth::user()->wallet, $vendordata->id)); ?>

                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-sm-auto col-12">
                                        <a href="<?php echo e(URL::to($vendordata->slug . '/addmoneywallet')); ?>"
                                            class="w-100 btn-primary btn-submit rounded-0 btn align-items-center fs-7 fw-600 justify-content-center d-flex gap-2">
                                            <i class="fa-regular fa-plus"></i>
                                            <?php echo e(trans('labels.add_money')); ?>

                                        </a>
                                    </div>
                                </div>
                                <div class="settings-box-body dashboard-section">
                                    <div class="table-responsive">
                                        <table class="table table-striped align-middle table-hover">
                                            <thead class="table-light">
                                                <tr class="fs-7 fw-600">
                                                    <th scope="col"><?php echo e(trans('labels.date')); ?></th>
                                                    <th scope="col"> <?php echo e(trans('labels.amount')); ?> </th>
                                                    <th scope="col"><?php echo e(trans('labels.remark')); ?></th>
                                                    <th scope="col"><?php echo e(trans('labels.status')); ?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $__currentLoopData = $gettransactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr class="fs-7">
                                                        <td><?php echo e(helper::date_formate($row->created_at, $vendordata->id)); ?><br>
                                                            <?php echo e(helper::time_formate($row->created_at, $vendordata->id)); ?>

                                                        </td>
                                                        <td><?php echo e(helper::currency_formate($row->amount, $vendordata->id)); ?>

                                                        </td>
                                                        <td>
                                                            <?php if($row->transaction_type == 2): ?>
                                                                <?php echo e(trans('labels.order_placed')); ?>

                                                                <span><?php echo e($row->order_number); ?> </span>
                                                            <?php elseif($row->transaction_type == 3): ?>
                                                                <?php echo e(trans('labels.order_cancel')); ?>

                                                                <span><?php echo e($row->order_number); ?> </span>
                                                            <?php elseif($row->transaction_type == 4): ?>
                                                                <?php echo e(trans('labels.referral_earning')); ?>

                                                                <span><?php echo e($row->username); ?> </span>
                                                            <?php else: ?>
                                                                <?php echo e(trans('labels.wallet_recharge')); ?>

                                                                <span><?php echo e(@helper::getpayment($row->payment_type, $vendordata->id)->payment_name); ?></span>
                                                                <span><?php echo e($row->payment_id); ?></span>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <?php if($row->transaction_type == 2): ?>
                                                                <div
                                                                    class="badge bg-debit custom-badge bg-cancelled rounded-0">
                                                                    <span> <?php echo e(trans('labels.debit')); ?></span>
                                                                </div>
                                                            <?php else: ?>
                                                                <div
                                                                    class="badge bg-debit custom-badge rounded-0 bg-completed">
                                                                    <span> <?php echo e(trans('labels.credit')); ?></span>
                                                                </div>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tbody>
                                        </table>
                                        <?php echo e($gettransactions->links()); ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/web/user/wallet.blade.php ENDPATH**/ ?>