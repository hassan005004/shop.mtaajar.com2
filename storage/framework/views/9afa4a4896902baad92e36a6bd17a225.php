<?php $__env->startSection('content'); ?>
   

            <div class="d-flex justify-content-between align-items-center">

                <h5 class="text-capitalize fw-600 text-dark fs-4"><?php echo e(trans('labels.faqs')); ?></h5>

                <a href="<?php echo e(URL::to('admin/faqs/add')); ?>" class="btn btn-secondary px-sm-4 text-capitalize d-flex">

                    <i class="fa-regular fa-plus mx-1"></i><?php echo e(trans('labels.add')); ?>


                </a>

            </div>

            <div class="row mt-3">

                <div class="col-12">

                    <div class="card border-0 mb-3">

                        <div class="card-body">

                            <div class="table-responsive">

                                <table
                                    class="table table-striped table-bordered py-3 zero-configuration w-100 dataTable no-footer">

                                    <thead>

                                        <tr class="text-capitalize fs-15 fw-500">
                                            <td></td>
                                            <td><?php echo e(trans('labels.srno')); ?></td>

                                            <td><?php echo e(trans('labels.question')); ?></td>

                                            <td><?php echo e(trans('labels.answer')); ?></td>
                                            <td><?php echo e(trans('labels.created_date')); ?></td>
                                <td><?php echo e(trans('labels.updated_date')); ?></td>
                                            <td><?php echo e(trans('labels.action')); ?></td>

                                        </tr>

                                    </thead>

                                    <tbody id="tabledetails" data-url="<?php echo e(url('admin/faqs/reorder_faq')); ?>">

                                        <?php
                                            
                                            $i = 1;
                                            
                                        ?>

                                        <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr class="fs-7 align-middle row1" id="dataid<?php echo e($faq->id); ?>" data-id="<?php echo e($faq->id); ?>">
                                        <td><a tooltip="<?php echo e(trans('labels.move')); ?>"><i class="fa-light fa-up-down-left-right mx-2"></i></a></td>
                                                <td><?php
                                                    
                                                    echo $i++;
                                                    
                                                ?></td>

                                                <td><?php echo e($faq->question); ?></td>

                                                <td><?php echo e($faq->answer); ?></td>
                                                <td><?php echo e(helper::date_formate($faq->created_at, $faq->vendor_id)); ?><br>
                                <?php echo e(helper::time_formate($faq->created_at, $faq->vendor_id)); ?>

                            </td>
                            <td><?php echo e(helper::date_formate($faq->updated_at, $faq->vendor_id)); ?><br>
                                <?php echo e(helper::time_formate($faq->updated_at, $faq->vendor_id)); ?>

                            </td>
                                                <td>
                                                    <div class="d-flex gap-2">
                                                        <a href="<?php echo e(URL::to('/admin/faqs/edit-' . $faq->id)); ?>"  tooltip="<?php echo e(trans('labels.edit')); ?>"
                                                            class="btn btn-info btn-sm hov"> <i
                                                                class="fa-regular fa-pen-to-square"></i></a>
    
                                                        <a href="javascript:void(0)"  tooltip="<?php echo e(trans('labels.delete')); ?>"
                                                            <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?> onclick="statusupdate('<?php echo e(URL::to('admin/faqs/delete-' . $faq->id)); ?>')" <?php endif; ?>
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

<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/admin/faqs/index.blade.php ENDPATH**/ ?>