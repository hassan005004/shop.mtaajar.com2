<?php
    if (Auth::user()->type == 4) {
        $vendor_id = Auth::user()->vendor_id;
    } else {
        $vendor_id = Auth::user()->id;
    }
?>
<?php $__env->startSection('content'); ?>
    <div class="d-flex justify-content-between align-items-center">
        <h5 class="text-capitalize fw-600 text-dark fs-4"><?php echo e(trans('labels.top_deals')); ?></h5>
    </div>
    <div class="row">
        <div id="top_deals">
            <div class="row my-4">
                <div class="col-12">
                    <div class="col-12">
                        <div class="card border-0 box-shadow">
                            <div class="card-body pb-0">

                                <form action="<?php echo e(URL::to('admin/top_deals/update')); ?>" method="POST"
                                    enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?>
                                    <div class="row">
                                        <div class="col-sm-6 form-group">
                                            <label class="form-label"><?php echo e(trans('labels.deals_type')); ?> <span
                                                    class="text-danger"> * </span></label>

                                            <select name="deal_type" class="form-select" id="deal_type" required>
                                                <option value=""><?php echo e(trans('labels.select')); ?></option>
                                                <option value="1" <?php echo e(@$topdeals->deal_type == 1 ? 'selected' : ''); ?>>
                                                    <?php echo e(trans('labels.one_time')); ?></option>
                                                <option value="2" <?php echo e(@$topdeals->deal_type == 2 ? 'selected' : ''); ?>>
                                                    <?php echo e(trans('labels.daily')); ?></option>
                                            </select>

                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label class="form-label" for=""><?php echo e(trans('labels.top_deals')); ?>

                                            </label>
                                            <input id="top_deals_switch" type="checkbox" class="checkbox-switch"
                                                name="top_deals_switch" value="1"
                                                <?php echo e(@$topdeals->top_deals_switch == 1 ? 'checked' : ''); ?>>
                                            <label for="top_deals_switch" class="switch">
                                                <span
                                                    class="<?php echo e(session()->get('direction') == 2 ? 'switch__circle-rtl' : 'switch__circle'); ?>"><span
                                                        class="switch__circle-inner"></span></span>
                                                <span
                                                    class="switch__left  <?php echo e(session()->get('direction') == 2 ? 'pe-2' : 'ps-2'); ?>"><?php echo e(trans('labels.off')); ?></span>
                                                <span
                                                    class="switch__right <?php echo e(session()->get('direction') == 2 ? 'ps-2' : 'pe-2'); ?>"><?php echo e(trans('labels.on')); ?></span>
                                            </label>
                                        </div>

                                        <div class="col-sm-6 form-group d-none" id="start_date">
                                            <label class="form-label"><?php echo e(trans('labels.start_date')); ?> <span
                                                    class="text-danger"> * </span></label>
                                            <input type="date" class="form-control" id="start_date"
                                                name="top_deals_start_date" value="<?php echo e(@$topdeals->start_date); ?>">
                                            <?php $__errorArgs = ['top_deals_start_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <small class="text-danger"><?php echo e($message); ?></small> <br>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="col-sm-6 form-group d-none" id="end_date">
                                            <label class="form-label"><?php echo e(trans('labels.end_date')); ?> <span
                                                    class="text-danger"> * </span></label>
                                            <input type="date" class="form-control" id="end_date"
                                                name="top_deals_end_date" value="<?php echo e(@$topdeals->end_date); ?>">
                                            <?php $__errorArgs = ['top_deals_end_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <small class="text-danger"><?php echo e($message); ?></small> <br>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>


                                        <div class="col-sm-6 form-group d-none" id="start_time">
                                            <label class="form-label"><?php echo e(trans('labels.start_time')); ?> <span
                                                    class="text-danger"> * </span></label>
                                            <input type="time" class="form-control" name="top_deals_start_time"
                                                id="start_time" value="<?php echo e(@$topdeals->start_time); ?>">
                                            <?php $__errorArgs = ['top_deals_start_time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <small class="text-danger"><?php echo e($message); ?></small> <br>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>

                                        <div class="col-sm-6 form-group d-none" id="end_time">
                                            <label class="form-label"><?php echo e(trans('labels.end_time')); ?> <span
                                                    class="text-danger"> * </span></label>
                                            <input type="time" class="form-control" name="top_deals_end_time"
                                                id="end_time" value="<?php echo e(@$topdeals->end_time); ?>">
                                            <?php $__errorArgs = ['top_deals_end_time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <small class="text-danger"><?php echo e($message); ?></small> <br>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>


                                        <div class="col-md-6">
                                            <label class="form-label"><?php echo e(trans('labels.offer_type')); ?><span
                                                    class="text-danger">
                                                    * </span></label>
                                            <select class="form-select" name="offer_type" required>
                                                <option value=" "><?php echo e(trans('labels.select')); ?></option>
                                                <option value="1"
                                                    <?php echo e(@$topdeals->offer_type == '1' ? 'selected' : ''); ?>>
                                                    <?php echo e(trans('labels.fixed')); ?>

                                                </option>
                                                <option value="2"
                                                    <?php echo e(@$topdeals->offer_type == '2' ? 'selected' : ''); ?>>
                                                    <?php echo e(trans('labels.percentage')); ?>

                                                </option>
                                            </select>
                                            <?php $__errorArgs = ['offer_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="text-danger"><?php echo e($message); ?></span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="form-label"><?php echo e(trans('labels.discount')); ?><span
                                                    class="text-danger"> *
                                                </span></label>
                                            <input type="text" class="form-control numbers_only" name="amount"
                                                value="<?php echo e(@$topdeals->offer_amount); ?>"
                                                placeholder="<?php echo e(trans('labels.discount')); ?>" required>
                                            <?php $__errorArgs = ['amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="text-danger"><?php echo e($message); ?></span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="col-md-12">
                                            <div
                                                class="form-group add-extra-class <?php echo e(session()->get('direction') == 2 ? 'rtl' : ''); ?>">
                                                <label class="form-label"><?php echo e(trans('labels.products')); ?></label>
                                                <select class="form-control selectpicker" name="products[]" multiple
                                                    data-live-search="true">

                                                    <?php if(!empty($getproducts)): ?>
                                                        <?php $__currentLoopData = $getproducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $products): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($products->id); ?>">
                                                                <?php echo e($products->name); ?>

                                                            </option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                </select>

                                            </div>
                                        </div>

                                        <div
                                            class="form-group <?php echo e(session()->get('direction') == 2 ? 'text-start' : 'text-end'); ?>">
                                            <button
                                                class="btn btn-primary px-sm-4 <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_top_deals', Auth::user()->role_id, $vendor_id, 'add') == 1 || helper::check_access('role_top_deals', Auth::user()->role_id, $vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>"
                                                <?php if(env('Environment') == 'sendbox'): ?> type="button" onclick="myFunction()" <?php else: ?> type="submit" <?php endif; ?>><?php echo e(trans('labels.save')); ?></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-12">

            <div class="card border-0 my-3">

                <div class="card-body">
                    <div class="table-responsive">

                        <table class="table table-striped table-bordered py-3 zero-configuration w-100">

                            <thead>

                                <tr class="text-capitalize fs-15 fw-500">
                                    <td><?php echo e(trans('labels.srno')); ?></td>
                                    <td><?php echo e(trans('labels.products')); ?></td>
                                    <td><?php echo e(trans('labels.created_date')); ?></td>
                                    <td><?php echo e(trans('labels.updated_date')); ?></td>
                                    <td><?php echo e(trans('labels.action')); ?></td>
                                </tr>

                            </thead>

                            <tbody>

                                <?php $i = 1; ?>

                                <?php $__currentLoopData = $productlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="fs-7 align-middle">
                                        <td><?php echo $i++; ?></td>

                                        <td><?php echo e($product->name); ?></td>
                                        <td><?php echo e(helper::date_formate($product->created_at, $product->vendor_id)); ?><br>
                                            <?php echo e(helper::time_formate($product->created_at, $product->vendor_id)); ?>

                                        </td>
                                        <td><?php echo e(helper::date_formate($product->updated_at, $product->vendor_id)); ?><br>
                                            <?php echo e(helper::time_formate($product->updated_at, $product->vendor_id)); ?>

                                        </td>

                                        <td>
                                            <a href="javascript:void(0)" tooltip="<?php echo e(trans('labels.delete')); ?>"
                                                <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?> onclick="deletedata('<?php echo e(URL::to('admin/top_deals/delete-' . $product->id)); ?>')" <?php endif; ?>
                                                class="btn btn-danger hov btn-sm <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_top_deals', Auth::user()->role_id, Auth::user()->vendor_id, 'delete') == 1 ? '' : 'd-none') : ''); ?>">
                                                <i class="fa-regular fa-trash"></i>
                                            </a>
                                        </td>

                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    <?php $__env->stopSection(); ?>
    <?php $__env->startSection('scripts'); ?>
        <script>
            $('#deal_type').on('change', function() {
                if ($('#deal_type').val() == 1) {
                    $('#start_date').removeClass('d-none');
                    $('#start_time').removeClass('d-none');
                    $('#end_date').removeClass('d-none');
                    $('#end_time').removeClass('d-none');
                    $('#start_date').prop('required', true);
                    $('#start_time').prop('required', true);
                    $('#end_date').prop('required', true);
                    $('#end_time').prop('required', true);
                } else {
                    $('#start_date').addClass('d-none');
                    $('#start_time').removeClass('d-none');
                    $('#end_date').addClass('d-none');
                    $('#end_time').removeClass('d-none');
                    $('#start_date').prop('required', false);
                    $('#start_time').prop('required', true);
                    $('#end_date').prop('required', false);
                    $('#end_time').prop('required', true);
                }
            }).change()
        </script>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/admin/top_deals/index.blade.php ENDPATH**/ ?>