<table class="table table-striped table-bordered py-3 zero-configuration w-100">

    <thead>

        <tr class="text-uppercase fw-500">
            <td></td>
            <td><?php echo e(trans('labels.srno')); ?></td>

            <td><?php echo e(trans('labels.area_name')); ?></td>

            <td><?php echo e(trans('labels.delivery_charge')); ?></td>

            <td><?php echo e(trans('labels.status')); ?></td>
            <td><?php echo e(trans('labels.created_date')); ?></td>
                                    <td><?php echo e(trans('labels.updated_date')); ?></td>
            <td><?php echo e(trans('labels.action')); ?></td>

        </tr>

    </thead>

    <tbody id="tabledetails" data-url="<?php echo e(url('admin/shipping-area/reorder_shipping_area')); ?>">

       <?php $i=1; ?>

        <?php $__currentLoopData = $getshippingarealist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shippingarea): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <tr class="fs-7 align-middle row1" id="dataid<?php echo e($shippingarea->id); ?>" data-id="<?php echo e($shippingarea->id); ?>">
            <td><a tooltip="<?php echo e(trans('labels.move')); ?>"><i class="fa-light fa-up-down-left-right mx-2"></i></a></td>

            <td><?php echo $i++ ?></td>

            <td><?php echo e($shippingarea->name); ?></td>

            <td><?php echo e(helper::currency_formate($shippingarea->delivery_charge,$shippingarea->vendor_id)); ?></td>

            <td>

                <?php if($shippingarea->is_available == 1): ?>
                
                    <a tooltip="<?php echo e(trans('labels.active')); ?>" <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?> onclick="statusupdate('<?php echo e(URL::to('admin/shipping-area/status-'.$shippingarea->id.'-2')); ?>')" <?php endif; ?> class="btn btn-outline-success btn-sm <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_shipping_area', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>"><i class="fa-regular fa-check"></i> </a>

                <?php else: ?>

                    <a tooltip="<?php echo e(trans('labels.inactive')); ?>" <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?> onclick="statusupdate('<?php echo e(URL::to('admin/shipping-area/status-'.$shippingarea->id.'-1')); ?>')" <?php endif; ?> class="btn btn-outline-danger btn-sm <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_shipping_area', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>"> <i class="fa-regular fa-xmark"></i> </a>

                <?php endif; ?>

            </td>
            <td><?php echo e(helper::date_formate($shippingarea->created_at, $shippingarea->vendor_id)); ?><br>
                                            <?php echo e(helper::time_formate($shippingarea->created_at, $shippingarea->vendor_id)); ?>

                                   </td>
                                    <td><?php echo e(helper::date_formate($shippingarea->updated_at, $shippingarea->vendor_id)); ?><br>
                                          <?php echo e(helper::time_formate($shippingarea->updated_at, $shippingarea->vendor_id)); ?>

                                   </td>
            <td>
                <div class="d-flex gap-2">
                    <a tooltip="<?php echo e(trans('labels.edit')); ?>" href="<?php echo e(URL::to('admin/shipping-area/show-'.$shippingarea->id)); ?>" class="btn btn-info hov btn-sm <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_shipping_area', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>"> <i class="fa-regular fa-pen-to-square"></i></a>
    
                    <a tooltip="<?php echo e(trans('labels.delete')); ?>"  <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?> onclick="deletedata('<?php echo e(URL::to('admin/shipping-area/delete-'.$shippingarea->id)); ?>')" <?php endif; ?> class="btn btn-danger hov btn-sm <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_shipping_area', Auth::user()->role_id, Auth::user()->vendor_id, 'delete') == 1 ? '' : 'd-none') : ''); ?>"> <i class="fa-regular fa-trash"></i></a>
                </div>
            </td>

        </tr>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </tbody>

</table><?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/admin/shippingarea/table.blade.php ENDPATH**/ ?>