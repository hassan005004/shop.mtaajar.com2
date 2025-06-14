<?php $__env->startSection('content'); ?>
    <?php

        $module = 'roles';

    ?>

    <div class="d-flex justify-content-between align-items-center">

        <h5 class="text-capitalize fw-600 text-dark fs-4"><?php echo e(trans('labels.roles')); ?></h5>

        <a href="<?php echo e(URL::to('admin/roles/add')); ?>"
            class="btn btn-secondary px-sm-4 text-capitalize d-flex  <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_roles', Auth::user()->role_id, Auth::user()->vendor_id, 'add') == 1 ? '' : 'd-none') : ''); ?>">

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



                                    <td><?php echo e(trans('labels.srno')); ?></td>

                                    <td><?php echo e(trans('labels.role')); ?></td>

                                    <td><?php echo e(trans('labels.system_modules')); ?></td>

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



                                <?php $__currentLoopData = $getroles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="fs-7 align-middle">



                                        <td><?php

                                            echo $i++;

                                        ?></td>

                                        <td><?php echo e($role->role); ?></td>

                                        <?php

                                            $modules = explode(',', $role->module);

                                        ?>

                                        <td>

                                            <?php $__currentLoopData = $modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <span
                                                    class="badge rounded-pill bg-light text-dark"><?php echo e($module); ?></span>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        </td>

                                        <td>

                                            <?php if($role->is_available == '1'): ?>
                                                <a href="javascript:void(0)" tooltip="<?php echo e(trans('labels.active')); ?>"
                                                    <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?> onclick="statusupdate('<?php echo e(URL::to('/admin/roles/change_status-' . $role->id . '/2')); ?>')" <?php endif; ?>
                                                    class="btn btn-sm btn-outline-success hov <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_roles', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>"><i
                                                        class="fa-regular fa-check"></i></a>
                                            <?php else: ?>
                                                <a href="javascript:void(0)" tooltip="<?php echo e(trans('labels.inactive')); ?>"
                                                    <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?> onclick="statusupdate('<?php echo e(URL::to('/admin/roles/change_status-' . $role->id . '/1')); ?>')" <?php endif; ?>
                                                    class="btn btn-sm btn-outline-danger hov <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_roles', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>"><i
                                                        class="fa-regular fa-xmark"></i></a>
                                            <?php endif; ?>

                                        </td>
                                        
                                        <td><?php echo e(helper::date_formate($role->created_at, $role->vendor_id)); ?><br>
                                            <?php echo e(helper::time_formate($role->created_at, $role->vendor_id)); ?>

                                        </td>
                                        <td><?php echo e(helper::date_formate($role->updated_at, $role->vendor_id)); ?><br>
                                            <?php echo e(helper::time_formate($role->updated_at, $role->vendor_id)); ?>

                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="<?php echo e(URL::to('admin/roles/edit-' . $role->id)); ?>"
                                                    tooltip="<?php echo e(trans('labels.edit')); ?>"
                                                    class="btn btn-info hov btn-sm <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_roles', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>">
    
                                                    <i class="fa-regular fa-pen-to-square"></i></a>
    
                                                <a href="javascript:void(0)" tooltip="<?php echo e(trans('labels.delete')); ?>"
                                                    <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?>
    
                                                        onclick="statusupdate('<?php echo e(URL::to('/admin/roles/delete-' . $role->id)); ?>')" <?php endif; ?>
                                                    class="btn btn-danger hov btn-sm <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_roles', Auth::user()->role_id, Auth::user()->vendor_id, 'delete') == 1 ? '' : 'd-none') : ''); ?>">
    
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

<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/admin/rolemanager/index.blade.php ENDPATH**/ ?>