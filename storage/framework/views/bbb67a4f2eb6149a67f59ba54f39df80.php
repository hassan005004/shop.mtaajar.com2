<?php $__env->startSection('content'); ?>
    <div class="d-flex justify-content-between align-items-center mb-3">

        <h5 class="text-capitalize fw-600 text-dark fs-4"><?php echo e(trans('labels.features')); ?></h5>

        <a href="<?php echo e(URL::to('admin/features/add')); ?>" class="btn btn-secondary px-sm-4 text-capitalize d-flex">

            <i class="fa-regular fa-plus mx-1"></i><?php echo e(trans('labels.add')); ?>


        </a>

    </div>
    <div class="row mt-3">

        <div class="col-12">

            <div class="card border-0 mb-3">

                <div class="card-body">

                    <div class="table-responsive">

                        <table class="table table-striped table-bordered py-3 zero-configuration w-100 dataTable no-footer">

                            <thead>

                                <tr class="text-capitalize fs-15 fw-500">
                                    <td></td>
                                    <td><?php echo e(trans('labels.srno')); ?></td>

                                    <td><?php echo e(trans('labels.image')); ?></td>

                                    <td><?php echo e(trans('labels.title')); ?></td>

                                    <td><?php echo e(trans('labels.description')); ?></td>
                                    <td><?php echo e(trans('labels.created_date')); ?></td>
                                    <td><?php echo e(trans('labels.updated_date')); ?></td>
                                    <td><?php echo e(trans('labels.action')); ?></td>

                                </tr>

                            </thead>

                            <tbody id="tabledetails" data-url="<?php echo e(url('admin/features/reorder_features')); ?>">

                                <?php

                                    $i = 1;

                                ?>

                                <?php $__currentLoopData = $features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="fs-7 align-middle row1" id="dataid<?php echo e($feature->id); ?>"
                                        data-id="<?php echo e($feature->id); ?>">
                                        <td><a tooltip="<?php echo e(trans('labels.move')); ?>"><i
                                                    class="fa-light fa-up-down-left-right mx-2"></i></a></td>
                                        <td><?php

                                            echo $i++;

                                        ?></td>

                                        <td><img src="<?php echo e(helper::image_path($feature->image)); ?>"
                                                class="img-fluid rounded hw-50" alt=""></td>

                                        <td><?php echo e($feature->title); ?></td>

                                        <td><?php echo e($feature->description); ?></td>
                                        <td><?php echo e(helper::date_formate($feature->created_at, $feature->vendor_id)); ?><br>
                                            <?php echo e(helper::time_formate($feature->created_at, $feature->vendor_id)); ?>

                                        </td>
                                        <td><?php echo e(helper::date_formate($feature->updated_at, $feature->vendor_id)); ?><br>
                                            <?php echo e(helper::time_formate($feature->updated_at, $feature->vendor_id)); ?>

                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="<?php echo e(URL::to('/admin/features/edit-' . $feature->id)); ?>"
                                                    tooltip="<?php echo e(trans('labels.edit')); ?>"
                                                    class="btn btn-info hov btn-sm "> <i
                                                        class="fa-regular fa-pen-to-square"></i></a>

                                                <a href="javascript:void(0)" tooltip="<?php echo e(trans('labels.delete')); ?>"
                                                    <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?> onclick="statusupdate('<?php echo e(URL::to('admin/features/delete-' . $feature->id)); ?>')" <?php endif; ?>
                                                    class="btn btn-danger hov btn-sm">
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

<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/admin/features/index.blade.php ENDPATH**/ ?>