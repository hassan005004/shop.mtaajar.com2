<?php $__env->startSection('content'); ?>



                <h5 class="text-capitalize fw-600 text-dark fs-4"><?php echo e(trans('labels.inquiries')); ?></h5>

       

            <div class="row">

                <div class="col-12">

                    <div class="card border-0 my-3">

                        <div class="card-body">

                            <div class="table-responsive">

                                <table class="table table-striped table-bordered py-3 zero-configuration w-100">

                                    <thead>

                                    <tr class="text-capitalize fs-15 fw-500">

                                            <td><?php echo e(trans('labels.srno')); ?></td>

                                            <td><?php echo e(trans('labels.name')); ?></td>

                                            <td><?php echo e(trans('labels.email')); ?></td>

                                            <td><?php echo e(trans('labels.mobile')); ?></td>

                                            <td><?php echo e(trans('labels.message')); ?></td>
                                            <td><?php echo e(trans('labels.created_date')); ?></td>
                                            <td><?php echo e(trans('labels.updated_date')); ?></td>
                                            <td><?php echo e(trans('labels.action')); ?></td>

                                        </tr>

                                    </thead>

                                    <tbody>

                                       <?php $i=1; ?>

                                        <?php $__currentLoopData = $getinquiries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inquiry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <tr class="fs-7 align-middle">

                                          <td><?php echo $i++ ?></td>

                                            <td><?php echo e($inquiry->name); ?></td>

                                            <td><?php echo e($inquiry->email); ?></td>

                                            <td><?php echo e($inquiry->mobile); ?></td>

                                            <td><?php echo e($inquiry->message); ?></td>
                                            <td><?php echo e(helper::date_formate($inquiry->created_at, $inquiry->vendor_id)); ?><br>
                                <?php echo e(helper::time_formate($inquiry->created_at, $inquiry->vendor_id)); ?>

                            </td>
                            <td><?php echo e(helper::date_formate($inquiry->updated_at, $inquiry->vendor_id)); ?><br>
                                <?php echo e(helper::time_formate($inquiry->updated_at, $inquiry->vendor_id)); ?>

                            </td>
                                            <td>

                                                <a  tooltip="<?php echo e(trans('labels.delete')); ?>" <?php if(env('Environment')=='sendbox' ): ?> onclick="myFunction()" <?php else: ?> onclick="deletedata('<?php echo e(URL::to('admin/inquiries/delete-'.$inquiry->id)); ?>')" <?php endif; ?> class="btn btn-danger hov btn-sm <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_inquiries', Auth::user()->role_id, Auth::user()->vendor_id, 'delete') == 1 ? '' : 'd-none') : ''); ?>"> <i class="fa-regular fa-trash"></i></a>

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


<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/admin/inquiries/index.blade.php ENDPATH**/ ?>