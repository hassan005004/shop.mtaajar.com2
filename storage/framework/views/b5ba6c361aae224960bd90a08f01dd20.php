<?php
if (Auth::user()->type == 4) {
$vendor_id = Auth::user()->vendor_id;
} else {
$vendor_id = Auth::user()->id;
}
?>
<table class="table table-striped table-bordered py-3 zero-configuration w-100">
    <thead>
        <tr class="text-capitalize fs-15 fw-500">
            <td><?php echo e(trans('labels.srno')); ?></td>
            <td><?php echo e(trans('labels.order_number')); ?></td>
            <td><?php echo e(trans('labels.total')); ?> <?php echo e(trans('labels.amount')); ?></td>
            <td><?php echo e(trans('labels.payment_type')); ?></td>
            <td><?php echo e(trans('labels.order_type')); ?></td>
            <?php if(helper::appdata($vendor_id)->product_type == 1): ?>
            <td><?php echo e(trans('labels.status')); ?></td>
            <?php endif; ?>
            <td><?php echo e(trans('labels.created_date')); ?></td>
            <td><?php echo e(trans('labels.updated_date')); ?></td>
            <td><?php echo e(trans('labels.action')); ?></td>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; ?>
        <?php $__currentLoopData = $getorders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orderdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr id="dataid<?php echo e($orderdata->id); ?>" class="fs-7 align-middle">
                <td><?php echo $i++; ?></td>
                <td>
                    <div class="d-flex justify-content-between align-items-center gap-2">
                    <a href="  <?php echo e(URL::to('admin/orders/invoice/' . $orderdata->order_number)); ?>" target="_blank"><?php echo e($orderdata->order_number); ?></a>
                        <?php if($orderdata->vendor_note != ''): ?>
                            <a href="javascript:void(0)" class="btn hov btn-primary btn-sm"
                                tooltip="<?php echo e($orderdata->vendor_note); ?>">
                                <i class="fa-solid fa-clipboard"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                </td>
              
                <td><?php echo e(helper::currency_formate($orderdata->grand_total, $vendor_id)); ?></td>
                <td>
                    
                    <?php if($orderdata->transaction_type == 0): ?>
                     <?php echo e(trans('labels.online')); ?>

                       <?php else: ?>
                       <?php echo e(@helper::getpayment($orderdata->transaction_type,$vendor_id)->payment_name); ?>  <?php endif; ?><br>
                       <?php if($orderdata->payment_status == 1): ?>
                           <small class="text-danger"><i class="far fa-clock"></i>
                               <?php echo e(trans('labels.unpaid')); ?></small>
                       <?php else: ?>
                           <small class="text-success"><i class="far fa-clock"></i>
                               <?php echo e(trans('labels.paid')); ?></small>
                       <?php endif; ?>
                   
                    
                </td>
                <td>
                    <?php if($orderdata->order_type == 1): ?>
                        <?php echo e(trans('labels.delivery')); ?>

                    <?php elseif($orderdata->order_type == 4): ?>
                        <?php echo e(trans('labels.pos')); ?>

                    <?php elseif($orderdata->order_type == 5): ?>
                        <?php echo e(trans('labels.digital')); ?>

                    <?php endif; ?>
                </td>
                <?php if(helper::appdata($vendor_id)->product_type == 1): ?>
                    <td>
                        <?php if($orderdata->status_type == '1'): ?>
                            <span
                                class="badge bg-warning"><?php echo e(@helper::gettype($orderdata->status, $orderdata->status_type, $orderdata->order_type, $vendor_id)->name == null ? '-' : @helper::gettype($orderdata->status, $orderdata->status_type, $orderdata->order_type, $vendor_id)->name); ?></span>
                        <?php elseif($orderdata->status_type == '2'): ?>
                            <span
                                class="badge bg-info"><?php echo e(@helper::gettype($orderdata->status, $orderdata->status_type, $orderdata->order_type, $vendor_id)->name == null ? '-' : @helper::gettype($orderdata->status, $orderdata->status_type, $orderdata->order_type, $vendor_id)->name); ?></span>
                        <?php elseif($orderdata->status_type == '3'): ?>
                            <span
                                class="badge bg-success"><?php echo e(@helper::gettype($orderdata->status, $orderdata->status_type, $orderdata->order_type, $vendor_id)->name == null ? '-' : @helper::gettype($orderdata->status, $orderdata->status_type, $orderdata->order_type, $vendor_id)->name); ?></span>
                        <?php elseif($orderdata->status_type == '4'): ?>
                            <span
                                class="badge bg-danger"><?php echo e(@helper::gettype($orderdata->status, $orderdata->status_type, $orderdata->order_type, $vendor_id)->name == null ? '-' : @helper::gettype($orderdata->status, $orderdata->status_type, $orderdata->order_type, $vendor_id)->name); ?></span>
                        <?php else: ?>
                            --
                        <?php endif; ?>
                    </td>
                <?php else: ?>
                    
                <?php endif; ?>
                <td><?php echo e(helper::date_formate($orderdata->created_at, $vendor_id)); ?><br>
                    <?php echo e(helper::time_formate($orderdata->created_at, $vendor_id)); ?>

                </td>
                <td><?php echo e(helper::date_formate($orderdata->updated_at, $vendor_id)); ?><br>
                    <?php echo e(helper::time_formate($orderdata->updated_at, $vendor_id)); ?>

                </td>
                <td>
                    <div class="d-flex gap-2">
                        <?php if(Auth::user()->type == 2): ?>
                            <a class="btn btn-sm hov btn-primary" tooltip="<?php echo e(trans('labels.print')); ?>"
                                href="<?php echo e(URL::to('admin/orders/print/' . $orderdata->order_number)); ?>"> <i
                                    class="fa-regular fa-print"></i> </a>
                        <?php endif; ?>
                        <a class="btn btn-sm hov btn-secondary" tooltip="<?php echo e(trans('labels.view')); ?>"
                            href="<?php echo e(URL::to('admin/orders/invoice/' . $orderdata->order_number)); ?>"> <i
                                class="fa-regular fa-eye"></i></a>
                                <?php if(Auth::user()->type == 2 || Auth::user()->type == 4): ?>
                            <?php if(($orderdata->transaction_type == 1 || $orderdata->transaction_type == 6) && $orderdata->payment_status == 1 && $orderdata->status_type == 3 &&  $orderdata->status_type !=4): ?>
                                <a class="btn btn-sm hov btn-secondary"
                                    onclick="codpayment('<?php echo e($orderdata->order_number); ?>','<?php echo e($orderdata->grand_total); ?>')"
                                    tooltip="<?php echo e(trans('labels.payment')); ?>"><i class="fa-solid fa-file-invoice-dollar"></i>
                                </a>
                            <?php endif; ?>
                        <?php endif; ?>

                        <a href="<?php echo e(URL::to('/admin/orders/generatepdf/' . $orderdata->order_number)); ?>"
                            tooltip="<?php echo e(trans('labels.downloadpdf')); ?>" class="btn btn-sm btn-info hov"><i
                                class="fa-solid fa-file-pdf"></i></a>
                    </div>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/admin/orders/orderstable.blade.php ENDPATH**/ ?>