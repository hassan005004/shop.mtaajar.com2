<?php $__env->startSection('content'); ?>
    <div class="d-flex justify-content-between align-items-center">
        <h5 class="text-capitalize fw-600 text-dark fs-4"><?php echo e(trans('labels.sub_categories')); ?></h5>
        <a href="<?php echo e(URL::to('admin/sub-categories/add')); ?>"
            class="btn btn-secondary px-sm-4 text-capitalize d-flex <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_sub_categories', Auth::user()->role_id, Auth::user()->vendor_id, 'add') == 1 ? '' : 'd-none') : ''); ?>">
            <i class="fa-regular fa-plus mx-1"></i><?php echo e(trans('labels.add')); ?>

        </a>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card border-0 my-3">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered py-3 zero-configuration w-100">
                            <thead>
                                <tr class="text-capitalize fs-15 fw-500">
                                    <td></td>
                                    <td><?php echo e(trans('labels.srno')); ?></td>
                                    <td><?php echo e(trans('labels.name')); ?></td>
                                    <td><?php echo e(trans('labels.category')); ?></td>
                                    <td><?php echo e(trans('labels.status')); ?></td>
                                    <td><?php echo e(trans('labels.created_date')); ?></td>
                                    <td><?php echo e(trans('labels.updated_date')); ?></td>
                                    <td><?php echo e(trans('labels.action')); ?></td>
                                </tr>
                            </thead>
                            <tbody id="tabledetails" data-url="<?php echo e(url('admin/sub-categories/reorder_category')); ?>">
                                <?php
                                    $i = 1;
                                ?>
                                <?php $__currentLoopData = $sub_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="fs-7 align-middle row1" id="dataid<?php echo e($sub_category->id); ?>"
                                        data-id="<?php echo e($sub_category->id); ?>">
                                        <td><a tooltip="<?php echo e(trans('labels.move')); ?>"><i class="fa-light fa-up-down-left-right mx-2"></i></a></td>
                                        <td><?php
                                            echo $i++;
                                        ?></td>
                                        <td><?php echo e($sub_category->name); ?></td>
                                        <td><?php echo e(@$sub_category['category_info']->name); ?></td>
                                        <td>
                                            <?php if($sub_category->is_available == '1'): ?>
                                                <a tooltip="<?php echo e(trans('labels.active')); ?>"
                                                    <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?> onclick="statusupdate('<?php echo e(URL::to('admin/sub-categories/change_status-' . $sub_category->slug . '/2')); ?>')" <?php endif; ?>
                                                    class="btn btn-sm btn-outline-success hov <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_sub_categories', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>"><i
                                                        class="fa-regular fa-check"></i></a>
                                            <?php else: ?>
                                                <a tooltip="<?php echo e(trans('labels.inactive')); ?>"
                                                    <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?> onclick="statusupdate('<?php echo e(URL::to('admin/sub-categories/change_status-' . $sub_category->slug . '/1')); ?>')" <?php endif; ?>
                                                    class="btn btn-sm btn-outline-danger hov <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_sub_categories', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>"><i
                                                        class="fa-regular fa-xmark"></i></a>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e(helper::date_formate($sub_category->created_at, $sub_category->vendor_id)); ?><br>
                                            <?php echo e(helper::time_formate($sub_category->created_at, $sub_category->vendor_id)); ?>

                                        </td>
                                        <td><?php echo e(helper::date_formate($sub_category->updated_at, $sub_category->vendor_id)); ?><br>
                                            <?php echo e(helper::time_formate($sub_category->updated_at, $sub_category->vendor_id)); ?>

                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a tooltip="<?php echo e(trans('labels.edit')); ?>"
                                                    href="<?php echo e(URL::to('admin/sub-categories/edit-' . $sub_category->slug)); ?>"
                                                    class="btn btn-info hov btn-sm <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_sub_categories', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>"><i
                                                        class="fa-regular fa-pen-to-square"></i></a>
    
                                                <a tooltip="<?php echo e(trans('labels.delete')); ?>"
                                                    <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?> onclick="deletedata('<?php echo e(URL::to('admin/sub-categories/delete-' . $sub_category->slug)); ?>')" <?php endif; ?>
                                                    class="btn btn-danger hov btn-sm <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_sub_categories', Auth::user()->role_id, Auth::user()->vendor_id, 'delete') == 1 ? '' : 'd-none') : ''); ?>">
                                                    <i class="fa-regular fa-trash"></i></a>
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

<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/admin/sub_category/sub_category.blade.php ENDPATH**/ ?>