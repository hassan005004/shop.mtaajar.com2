<table class="table table-striped table-bordered py-3 zero-configuration w-100">

    <thead>

        <tr class="text-capitalize fs-15 fw-500">
            <td></td>
            <td><?php echo e(trans('labels.srno')); ?></td>

            <td><?php echo e(trans('labels.image')); ?></td>

            <td><?php echo e(trans('labels.category')); ?></td>

            <td><?php echo e(trans('labels.product')); ?></td>

            <td><?php echo e(trans('labels.status')); ?></td>
            <td><?php echo e(trans('labels.created_date')); ?></td>
            <td><?php echo e(trans('labels.updated_date')); ?></td>
            <td><?php echo e(trans('labels.action')); ?></td>

        </tr>

    </thead>

    <tbody id="tabledetails" data-url="<?php echo e(url('admin/'.$url.'/reorder_banner')); ?>">

        <?php $i = 1; ?>

        <?php $__currentLoopData = $getbannerlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <?php if($banner->section == $section): ?>

            <tr class="fs-7 align-middle row1"  id="dataid<?php echo e($banner->id); ?>" data-id="<?php echo e($banner->id); ?>">
                    <td><a tooltip="<?php echo e(trans('labels.move')); ?>"><i class="fa-light fa-up-down-left-right mx-2"></i></a></td>
                    <td><?php echo $i++; ?></td>

                    <td><img src="<?php echo e(helper::image_path($banner->image )); ?>" class="img-fluid rounded hight-50" alt=""></td>

                    <td><?php echo e($banner->type == '1' ? @$banner['category_info']->name : "--"); ?></td>

                    <td><?php echo e($banner->type == '2' ? @$banner['product_info']->name : "--"); ?></td>
                    <td>

                        <?php if($banner->is_available == 1): ?>

                            <a href="javascript:void(0)" tooltip="<?php echo e(trans('labels.active')); ?>"  <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?> onclick="statusupdate('<?php echo e(URL::to('admin/'.$url.'/status_change-'.$banner->id.'/2')); ?>')" <?php endif; ?> class="btn btn-sm btn-outline-success hov <?php echo e(Auth::user()->type == 4 ? (helper::check_access($title == trans('labels.sliders')  ? 'role_sliders' : 'role_banners', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>"> <i class="fa-regular fa-check"></i></a> 

                        <?php else: ?>

                            <a href="javascript:void(0)" tooltip="<?php echo e(trans('labels.inactive')); ?>"  <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?>  onclick="statusupdate('<?php echo e(URL::to('admin/'.$url.'/status_change-'.$banner->id.'/1')); ?>')" <?php endif; ?> class="btn btn-sm btn-outline-danger hov <?php echo e(Auth::user()->type == 4 ? (helper::check_access($title == trans('labels.sliders')  ? 'role_sliders' : 'role_banners', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>"> <i class="fa-regular fa-xmark"></i> </a> 

                        <?php endif; ?>

                    </td>
                    <td><?php echo e(helper::date_formate($banner->created_at, $banner->vendor_id)); ?><br>
                        <?php echo e(helper::time_formate($banner->created_at, $banner->vendor_id)); ?>

                    </td>
                    <td><?php echo e(helper::date_formate($banner->updated_at, $banner->vendor_id)); ?><br>
                        <?php echo e(helper::time_formate($banner->updated_at, $banner->vendor_id)); ?>

                    </td>
                    <td>
                        <div class="d-flex gap-2">
                            <a tooltip="<?php echo e(trans('labels.edit')); ?>" href="<?php echo e(URL::to('admin/'.$url.'/edit-'.$banner->id)); ?>" class="btn btn-info hov btn-sm <?php echo e(Auth::user()->type == 4 ? (helper::check_access($title == trans('labels.sliders')  ? 'role_sliders' : 'role_banners', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>"> <i class="fa-regular fa-pen-to-square"></i></a>
    
                            <a tooltip="<?php echo e(trans('labels.delete')); ?>" href="javascript:void(0)"  <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?>  onclick="deletedata('<?php echo e(URL::to('admin/'.$url.'/delete-'.$banner->id)); ?>')" <?php endif; ?> class="btn btn-danger hov btn-sm <?php echo e(Auth::user()->type == 4 ? (helper::check_access($title == trans('labels.sliders')  ? 'role_sliders' : 'role_banners', Auth::user()->role_id, Auth::user()->vendor_id, 'delete') == 1 ? '' : 'd-none') : ''); ?>"> <i class="fa-regular fa-trash"></i></a> 
                        </div>

                    </td>

                </tr>

                <?php endif; ?>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </tbody>

</table>

<?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/admin/banner/table.blade.php ENDPATH**/ ?>