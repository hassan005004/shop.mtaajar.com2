<table class="table table-striped table-bordered py-3 zero-configuration w-100">

    <thead>

        <tr class="text-capitalize fs-15 fw-500">
            <td></td>
            <td><?php echo e(trans('labels.srno')); ?></td>

            <td><?php echo e(trans('labels.image')); ?></td>

            <td><?php echo e(trans('labels.title')); ?></td>

            <!-- <td><?php echo e(trans('labels.description')); ?></td> -->
            <td><?php echo e(trans('labels.created_date')); ?></td>
            <td><?php echo e(trans('labels.updated_date')); ?></td>
            <td><?php echo e(trans('labels.action')); ?></td>

        </tr>

    </thead>

    <tbody id="tabledetails" data-url="<?php echo e(url('admin/blogs/reorder_blogs')); ?>">


        <?php

        $i = 1;

        ?>

        <?php $__currentLoopData = $blog; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <tr class="fs-7 align-middle row1" id="dataid<?php echo e($item->id); ?>" data-id="<?php echo e($item->id); ?>">
            <td><a tooltip="<?php echo e(trans('labels.move')); ?>"><i class="fa-light fa-up-down-left-right mx-2"></i></a></td>
            <td><?php

                echo $i++;

                ?></td>

            <td><img src="<?php echo e(helper::image_path($item->image)); ?>" class="img-fluid rounded hight-50" alt=""></td>

            <td><?php echo e($item->title); ?></td>

            <!-- <td><?php echo Str::limit($item->description, 450); ?></td> -->
            <td><?php echo e(helper::date_formate($item->created_at, $item->vendor_id)); ?><br>
                <?php echo e(helper::time_formate($item->created_at, $item->vendor_id)); ?>

            </td>
            <td><?php echo e(helper::date_formate($item->updated_at, $item->vendor_id)); ?><br>
                <?php echo e(helper::time_formate($item->updated_at, $item->vendor_id)); ?>

            </td>
            <td>
                <div class="d-flex gap-2">
                    <a href="<?php echo e(URL::to('admin/blogs/edit-'.$item->slug)); ?>" tooltip="<?php echo e(trans('labels.edit')); ?>" class="btn btn-info hov btn-sm <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_blogs', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>"> <i class="fa-regular fa-pen-to-square"></i></a>
    
                    <a href="javascript:void(0)" tooltip="<?php echo e(trans('labels.delete')); ?>" <?php if(env('Environment')=='sendbox' ): ?> onclick="myFunction()" <?php else: ?> onclick="statusupdate('<?php echo e(URL::to('admin/blogs/delete-'.$item->slug)); ?>')" <?php endif; ?> class="btn btn-danger hov btn-sm <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_blogs', Auth::user()->role_id, Auth::user()->vendor_id, 'delete') == 1 ? '' : 'd-none') : ''); ?>">
    
                        <i class="fa-regular fa-trash"></i></a>
                </div>

            </td>

        </tr>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </tbody>

</table><?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/admin/included/blog/table.blade.php ENDPATH**/ ?>