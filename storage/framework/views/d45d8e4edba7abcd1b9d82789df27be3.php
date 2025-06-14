<?php
    if(Auth::user()->type == 4)
    {
        $vendor_id = Auth::user()->vendor_id;
    }else{
       $vendor_id = Auth::user()->id;        
    }
?>

<?php $__env->startSection('content'); ?>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="text-capitalize fw-600 text-dark fs-4"><?php echo e(trans('labels.store_categories')); ?></h5>
            <a href="<?php echo e(URL::to('admin/store_categories/add')); ?>" class="btn btn-secondary px-sm-4 text-capitalize d-flex"><i
                    class="fa-regular fa-plus mx-1"></i><?php echo e(trans('labels.add')); ?></a>
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
                                        <td><?php echo e(trans('labels.category')); ?></td>
                                        <td><?php echo e(trans('labels.status')); ?></td>
                                        <td><?php echo e(trans('labels.created_date')); ?></td>   
                                        <td><?php echo e(trans('labels.updated_date')); ?></td>   
                                        <td><?php echo e(trans('labels.action')); ?></td>
                                        
                                    </tr>
                                </thead>
                                <tbody id="tabledetails" data-url="<?php echo e(url('admin/store_categories/reorder_category')); ?>">
                                    <?php $i=1; ?>
                                    <?php $__currentLoopData = $allcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr class="fs-7 align-middle row1"  id="dataid<?php echo e($category->id); ?>" data-id="<?php echo e($category->id); ?>">
                                            <td><a tooltip="<?php echo e(trans('labels.move')); ?>"><i
                                                class="fa-light fa-up-down-left-right mx-2"></i></a></td>
                                            <td><?php echo $i++ ?></td>
                                            <td><?php echo e($category->name); ?></td>
                                            <td>
                                                <?php if($category->is_available == '1'): ?>
                                                    <a tooltip="<?php echo e(trans('labels.active')); ?>" <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?> onclick="statusupdate('<?php echo e(URL::to('admin/store_categories/change_status-' . $category->id . '/2')); ?>')" <?php endif; ?>
                                                        class="btn btn-sm hov btn-outline-success"><i class="fas fa-check"></i></a>
                                                <?php else: ?>
                                                    <a tooltip="<?php echo e(trans('labels.inactive')); ?>" <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?> onclick="statusupdate('<?php echo e(URL::to('admin/store_categories/change_status-' . $category->id . '/1')); ?>')" <?php endif; ?>
                                                        class="btn btn-sm hov btn-outline-danger"><i class="fas fa-close"></i></a>
                                                <?php endif; ?>
                                            </td>
                                            <td><?php echo e(helper::date_formate($category->created_at,$vendor_id)); ?><br>
                                            <?php echo e(helper::time_formate($category->created_at,$vendor_id)); ?>

                                            </td>
                                            <td><?php echo e(helper::date_formate($category->updated_at,$vendor_id)); ?><br>
                                            <?php echo e(helper::time_formate($category->updated_at,$vendor_id)); ?>

                                            </td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <a href="<?php echo e(URL::to('admin/store_categories/edit-' . $category->id)); ?>" tooltip="<?php echo e(trans('labels.edit')); ?>"
                                                        class="btn btn-info hov btn-sm"> <i
                                                            class="fa-regular fa-pen-to-square"></i></a>
                                                    <a tooltip="<?php echo e(trans('labels.delete')); ?>" <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?> onclick="statusupdate('<?php echo e(URL::to('admin/store_categories/delete-' . $category->id)); ?>')" <?php endif; ?>
                                                        class="btn btn-danger hov btn-sm"> <i
                                                            class="fa-regular fa-trash"></i></a>
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

<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/admin/store_categories/index.blade.php ENDPATH**/ ?>