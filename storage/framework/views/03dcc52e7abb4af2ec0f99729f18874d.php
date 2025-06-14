<?php
    if (Auth::user()->type == 4) {
        $vendor_id = Auth::user()->vendor_id;
    } else {
        $vendor_id = Auth::user()->id;
    }
?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="d-flex flex-wrap gap-2 justify-content-between align-items-center">
            <h5 class="text-capitalize fw-600 text-dark fs-4"><?php echo e(trans('labels.transactions')); ?></h5>
            <form action="<?php echo e(URL::to('/admin/transaction')); ?> " class="col-xl-7 col-md-9 col-12" method="get">
                <div class="row">
                    <div class="input-group gap-2 justify-content-end">
                        <?php if(Auth::user()->type == 1): ?>
                            <select class="form-select transaction-select col-sm-auto col-12 rounded" name="vendor">
                                <option value=""
                                    data-value="<?php echo e(URL::to('/admin/transaction?vendor=' . '&startdate=' . request()->get('startdate') . '&enddate=' . request()->get('enddate'))); ?>"
                                    selected><?php echo e(trans('labels.select')); ?></option>
                                <?php $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($vendor->id); ?>"
                                        data-value="<?php echo e(URL::to('/admin/transaction?vendor=' . $vendor->id . '&startdate=' . request()->get('startdate') . '&enddate=' . request()->get('enddate'))); ?>"
                                        <?php echo e(request()->get('vendor') == $vendor->id ? 'selected' : ''); ?>>
                                        <?php echo e($vendor->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        <?php endif; ?>
                        <div class="input-group-append col-sm-auto col-12">
                            <input type="date" class="form-control p-2 w-100 rounded" name="startdate"
                                value="<?php echo e(request()->get('startdate')); ?>">
                        </div>
                        <div class="input-group-append col-sm-auto col-12">
                            <input type="date" class="form-control p-2 w-100 rounded" name="enddate"
                                value="<?php echo e(request()->get('enddate')); ?>">
                        </div>
                        <div class="input-group-append col-sm-auto col-12">
                            <button class="btn btn-primary px-sm-4 rounded w-100" type="submit"><?php echo e(trans('labels.fetch')); ?></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-12">
            <div class="card border-0 my-3">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered py-3 zero-configuration w-100">
                            <thead>
                                <tr class="text-capitalize fs-15 fw-500">
                                    <td><?php echo e(trans('labels.srno')); ?></td>
                                    <td><?php echo e(trans('labels.transaction_number')); ?></td>
                                    <td><?php echo e(trans('labels.plan_name')); ?></td>
                                    <td><?php echo e(trans('labels.total')); ?> <?php echo e(trans('labels.amount')); ?></td>
                                    <td><?php echo e(trans('labels.payment_type')); ?></td>
                                    <td><?php echo e(trans('labels.purchase_date')); ?></td>
                                    <td><?php echo e(trans('labels.expire_date')); ?></td>
                                    <td><?php echo e(trans('labels.status')); ?></td>
                                    <td><?php echo e(trans('labels.created_date')); ?></td>
                                    <td><?php echo e(trans('labels.updated_date')); ?></td>
                                    <td><?php echo e(trans('labels.action')); ?></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    
                                    $i = 1;
                                    
                                ?>
                                <?php $__currentLoopData = $transaction; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="fs-7 align-middle">
                                        <td><?php echo $i++; ?></td>
                                        <td>#<?php echo e($transaction->transaction_number); ?></td>
                                        <td><?php echo e(@$transaction['plan_info']->name); ?></td>
                                        <td><?php echo e(helper::currency_formate($transaction->grand_total, '')); ?></td>
                                        <td>
                                            <?php if($transaction->payment_type != ''): ?>
                                                <?php if($transaction->payment_type == 0): ?>
                                                    <?php echo e(trans('labels.manual')); ?>

                                                <?php else: ?>
                                                    <?php echo e(@helper::getpayment($transaction->payment_type, 1)->payment_name); ?>

                                                <?php endif; ?>
                                            <?php elseif($transaction->amount == 0): ?>
                                                -
                                            <?php else: ?>
                                                -
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($transaction->payment_type == 6 || $transaction->payment_type == 1): ?>
                                                <?php if($transaction->status == 2): ?>
                                                    <span
                                                        class="badge bg-success"><?php echo e(helper::date_formate($transaction->purchase_date,$transaction->vendor_id)); ?></span>
                                                <?php else: ?>
                                                    -
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <span
                                                    class="badge bg-success"><?php echo e(helper::date_formate($transaction->purchase_date,$transaction->vendor_id)); ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($transaction->payment_type == 6 || $transaction->payment_type == 1): ?>
                                                <?php if($transaction->status == 2): ?>
                                                    <span
                                                        class="badge bg-danger"><?php echo e($transaction->expire_date != '' ? helper::date_formate($transaction->expire_date,$transaction->vendor_id) : '-'); ?></span>
                                                <?php else: ?>
                                                    -
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <span
                                                    class="badge bg-danger"><?php echo e($transaction->expire_date != '' ? helper::date_formate($transaction->expire_date,$transaction->vendor_id) : '-'); ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($transaction->payment_type == 6 || $transaction->payment_type == 1): ?>
                                                <?php if($transaction->status == 1): ?>
                                                    <span class="badge bg-warning"><?php echo e(trans('labels.pending')); ?></span>
                                                <?php elseif($transaction->status == 2): ?>
                                                    <span class="badge bg-success"><?php echo e(trans('labels.accepted')); ?></span>
                                                <?php elseif($transaction->status == 3): ?>
                                                    <span class="badge bg-danger"><?php echo e(trans('labels.rejected')); ?></span>
                                                <?php else: ?>
                                                    -
                                                <?php endif; ?>
                                            <?php else: ?>
                                                -
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e(helper::date_formate($transaction->created_at, $transaction->vendor_id)); ?><br>
                                            <?php echo e(helper::time_formate($transaction->created_at, $transaction->vendor_id)); ?>

                                   </td>
                                    <td><?php echo e(helper::date_formate($transaction->updated_at, $transaction->vendor_id)); ?><br>
                                          <?php echo e(helper::time_formate($transaction->updated_at, $transaction->vendor_id)); ?>

                                   </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <?php if(Auth::user()->type == '1'): ?>
                                                    <?php if($transaction->payment_type == 6 || $transaction->payment_type == 1): ?>
                                                        <?php if($transaction->status == 1): ?>
                                                            <a class="btn btn-sm btn-success hov"
                                                                tooltip="<?php echo e(trans('labels.active')); ?>"
                                                                <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?>  onclick="statusupdate('<?php echo e(URL::to('admin/transaction-' . $transaction->id . '-2')); ?>')" <?php endif; ?>><i
                                                                    class="fas fa-check"></i></a>
                                                            <a class="btn btn-sm btn-danger hov"
                                                                tooltip="<?php echo e(trans('labels.inactive')); ?>"  <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?> 
                                                                onclick="statusupdate('<?php echo e(URL::to('admin/transaction-' . $transaction->id . '-3')); ?>')" <?php endif; ?>><i
                                                                    class="fas fa-close"></i></a>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                                <a class="btn btn-sm hov btn-secondary hov"
                                                    tooltip="<?php echo e(trans('labels.view')); ?>"
                                                    href="<?php echo e(URL::to('admin/transaction/plandetails-' . $transaction->id)); ?>"><i
                                                        class="fa-regular fa-eye"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/admin/transaction/transaction.blade.php ENDPATH**/ ?>