<?php $__env->startSection('content'); ?>


            <div class="d-flex justify-content-between align-items-center">

                <h5 class="text-capitalize fw-600 text-dark fs-4"><?php echo e(trans('labels.edit')); ?></h5>

                <nav aria-label="breadcrumb">

                    <ol class="breadcrumb m-0">

                        <li class="breadcrumb-item"><a

                                href="<?php echo e(URL::to('admin/shipping-area')); ?>"><?php echo e(trans('labels.shipping_area')); ?></a></li>

                        <li class="breadcrumb-item active <?php echo e(session()->get('direction') == 2 ? 'breadcrumb-rtl' : ''); ?>" aria-current="page"><?php echo e(trans('labels.edit')); ?></li>

                    </ol>

                </nav>

            </div>

            <div class="row mt-3">

                <div class="col-12">

                    <div class="card border-0 box-shadow">

                        <div class="card-body">

                            <form action="<?php echo e(URL::to('admin/shipping-area/update-' . $shippingareadata->id)); ?>"

                                method="POST">

                                <?php echo csrf_field(); ?>

                                <div class="row">

                                    <div class="col-md-12">

                                        <div class="form-group">

                                            <label class="form-label"><?php echo e(trans('labels.area_name')); ?><span class="text-danger"> * </span></label>

                                            <input type="text" class="form-control" name="name" value="<?php echo e($shippingareadata->name); ?>" placeholder="<?php echo e(trans('labels.area_name')); ?>" required>

                                            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-danger"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                                        </div>

                                        <div class="form-group">

                                            <label class="form-label"><?php echo e(trans('labels.delivery_charge')); ?><span class="text-danger"> * </span></label>

                                            <input type="text" class="form-control numbers_only" name="delivery_charge" value="<?php echo e($shippingareadata->delivery_charge); ?>" placeholder="<?php echo e(trans('labels.delivery_charge')); ?>" required>

                                            <?php $__errorArgs = ['delivery_charge'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                                        </div>

                                    </div>

                                    <div class="form-group <?php echo e(session()->get('direction') == 2 ? 'text-start' : 'text-end'); ?>">

                                        <a href="<?php echo e(URL::to('admin/shipping-area')); ?>" class="btn btn-danger px-sm-4"><?php echo e(trans('labels.cancel')); ?></a>

                                        <button class="btn btn-primary px-sm-4 <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_shipping_area', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>" <?php if(env('Environment')=='sendbox'): ?> type="button" onclick="myFunction()" <?php else: ?> type="submit" <?php endif; ?>><?php echo e(trans('labels.save')); ?></button>

                                    </div>

                                </div>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

     

<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/admin/shippingarea/show.blade.php ENDPATH**/ ?>