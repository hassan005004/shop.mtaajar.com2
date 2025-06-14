<?php $__env->startSection('content'); ?>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="text-capitalize fw-600 text-dark fs-4"><?php echo e(trans('labels.edit')); ?></h5>
        <nav aria-label="breadcrumb">

            <ol class="breadcrumb m-0">

                <li class="breadcrumb-item"><a href="<?php echo e(URL::to('admin/users')); ?>"><?php echo e(trans('labels.users')); ?></a>

                </li>

                <li class="breadcrumb-item active <?php echo e(session()->get('direction') == 2 ? 'breadcrumb-rtl' : ''); ?>"
                    aria-current="page"><?php echo e(trans('labels.edit')); ?></li>

            </ol>

        </nav>

    </div>
    
    <div class="card border-0 box-shadow">
        <div class="card-body">
            <form action="<?php echo e(URL::to('admin/users/update-' . $getuserdata->slug)); ?>" method="post"
                enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="row">
                <?php if(@helper::checkaddons('digital_product')): ?>
                        <div class="form-group col-md-6">
                            <label for="store" class="form-label"><?php echo e(trans('labels.store_categories')); ?><span
                                    class="text-danger">
                                    * </span></label>
                            <select name="store" class="form-select" required>
                                <option value=""><?php echo e(trans('labels.select')); ?></option>
                                <?php $__currentLoopData = $stores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $store): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($store->id); ?>"
                                        <?php echo e($store->id == $getuserdata->store_id ? 'selected' : ''); ?>>
                                        <?php echo e($store->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="product_type" class="form-label"><?php echo e(trans('labels.product_type')); ?><span
                                    class="text-danger">
                                    * </span></label>
                            <select name="product_type" class="form-select" required>
                                <option value=""><?php echo e(trans('labels.select')); ?></option>
                                <option value="1"
                                    <?php echo e(helper::appdata($getuserdata->id)->product_type == 1 ? 'selected' : ''); ?>>
                                    <?php echo e(trans('labels.physical')); ?>

                                </option>
                                <option value="2"
                                    <?php echo e(helper::appdata($getuserdata->id)->product_type == 2 ? 'selected' : ''); ?>>
                                    <?php echo e(trans('labels.digital')); ?>

                                </option>
                            </select>
                        </div>
                    <?php else: ?>
                        <div class="form-group col-md-12">
                            <label for="store" class="form-label"><?php echo e(trans('labels.store_categories')); ?><span
                                    class="text-danger">
                                    * </span></label>
                            <select name="store" class="form-select" required>
                                <option value=""><?php echo e(trans('labels.select')); ?></option>
                                <?php $__currentLoopData = $stores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $store): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($store->id); ?>"
                                        <?php echo e($store->id == $getuserdata->store_id ? 'selected' : ''); ?>>
                                        <?php echo e($store->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    <?php endif; ?>
                    <div class="col-sm-6 form-group">
                        <input type="hidden" value="<?php echo e($getuserdata->id); ?>" name="id">
                        <label class="form-label"><?php echo e(trans('labels.name')); ?><span class="text-danger"> *
                            </span></label>
                        <input type="text" class="form-control" name="name" id="name" value="<?php echo e($getuserdata->name); ?>"
                            placeholder="<?php echo e(trans('labels.name')); ?>" required>
                        <?php $__errorArgs = ['name'];
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
                    <div class="col-sm-6 form-group">
                        <label class="form-label"><?php echo e(trans('labels.email')); ?><span class="text-danger"> *
                            </span></label>
                        <input type="email" class="form-control" name="email" value="<?php echo e($getuserdata->email); ?>"
                            placeholder="<?php echo e(trans('labels.email')); ?>" required>
                        <?php $__errorArgs = ['email'];
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

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label"><?php echo e(trans('labels.mobile')); ?><span class="text-danger"> *
                                </span></label>
                            <input type="text" class="form-control mobile-number" name="mobile"
                                value="<?php echo e($getuserdata->mobile); ?>" placeholder="<?php echo e(trans('labels.mobile')); ?>"
                                required>
                            <?php $__errorArgs = ['mobile'];
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
                    </div>
                    <div class="form-group col-sm-6">
                        <label class="form-label"><?php echo e(trans('labels.image')); ?></label>
                        <input type="file" class="form-control" name="profile">
                        <img class="rounded-circle mt-2" src="<?php echo e(helper::image_path($getuserdata->image)); ?>"
                            alt="" width="70" height="70">
                        <?php $__errorArgs = ['profile'];
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
                        <label for="country" class="form-label"><?php echo e(trans('labels.country')); ?><span
                                class="text-danger"> * </span></label>
                        <select name="country" class="form-select" id="country" required>
                            <option value=""><?php echo e(trans('labels.select')); ?></option>
                            <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($country->id); ?>"
                                    <?php echo e($country->id == $getuserdata->country_id ? 'selected' : ''); ?>>
                                    <?php echo e($country->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>

                    </div>
                    <div class="form-group col-md-6">
                        <label for="city" class="form-label"><?php echo e(trans('labels.city')); ?><span class="text-danger">
                                * </span></label>
                        <select name="city" class="form-select" id="city" required>
                            <option value=""><?php echo e(trans('labels.select')); ?></option>
                        </select>

                    </div>
                    <?php if(@helper::checkaddons('unique_slug')): ?>
                        <div class="form-group">
                            <label for="basic-url" class="form-label"><?php echo e(trans('labels.personlized_link')); ?><span
                                    class="text-danger"> * </span></label>
                            <?php if(env('Environment') == 'sendbox'): ?>
                                <span class="badge badge bg-danger ms-2 mb-0"><?php echo e(trans('labels.addon')); ?></span>
                            <?php endif; ?>
                            <div class="input-group ">
                                <span
                                    class="input-group-text col-5 col-lg-auto overflow-x-auto <?php echo e(session()->get('direction') == 2 ? 'rounded-start-0 rounded-end' : ''); ?>"><?php echo e(URL::to('/')); ?>/</span>
                                <input type="text" class="form-control <?php echo e(session()->get('direction') == 2 ? 'rounded-end-0 rounded-start' : ''); ?>" id="slug" name="slug"
                                    value="<?php echo e($getuserdata->slug); ?>" required>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="col-sm-6">
                    <?php if(@helper::checkaddons('allow_without_subscription')): ?>
                            <div class="form-group" id="plan">
                                <div class="d-flex">
                                    <input class="form-check-input mx-1" type="checkbox" name="plan_checkbox"
                                        id="plan_checkbox"> <label for="plan_checkbox"
                                        class="form-label"><?php echo e(trans('labels.assign_plan')); ?></label>&nbsp;
                                    <label class="form-label"> (<?php echo e(trans('labels.current_plan')); ?>&nbsp;:&nbsp;
                                    </label>
                                    <?php
                                        $plan = helper::plandetail(@$getuserdata->plan_id);
                                    ?>
                                    <span class="fw-500"> <?php echo e(!empty($plan) ? $plan->name : '-'); ?></span>)

                                </div>
                               
                                <select name="plan" id="selectplan" class="form-select" disabled required>
                                    <option value=""><?php echo e(trans('labels.select')); ?></option>
                                    <?php $__currentLoopData = $getplanlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plans): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($plans->id); ?>" <?php echo e($plans->id == @$plan->id ? 'selected' : ''); ?>>
                                            <?php echo e($plans->name); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>

                            </div>
                            <div class="form-group">
                                <input class="form-check-input mx-1" type="checkbox" name="allow_store_subscription"
                                    id="allow_store_subscription"
                                    <?php if($getuserdata->allow_without_subscription == '1'): ?> checked <?php endif; ?>><label class="form-check-label"
                                    for="allow_store_subscription"><?php echo e(trans('labels.allow_store_without_subscription')); ?></label>

                            </div>
                        <?php endif; ?>
                        <div class="form-group">
                            <input class="form-check-input mx-1" type="checkbox" name="show_landing_page"
                                id="show_landing_page" <?php if($getuserdata->available_on_landing == '1'): ?> checked <?php endif; ?>><label
                                class="form-check-label"
                                for="show_landing_page"><?php echo e(trans('labels.display_store_on_landing')); ?></label>

                        </div>
                    </div>
                    <div class="form-group <?php echo e(session()->get('direction') == 2 ? 'text-start' : 'text-end'); ?>">
                        <a href="<?php echo e(URL::to('admin/users')); ?>"
                            class="btn btn-danger px-sm-4"><?php echo e(trans('labels.cancel')); ?></a>
                        <button
                            <?php if(env('Environment') == 'sendbox'): ?> type="button" onclick="myFunction()" <?php else: ?> type="submit" <?php endif; ?>
                            class="btn btn-primary px-sm-4"><?php echo e(trans('labels.save')); ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script>
        var cityurl = "<?php echo e(URL::to('admin/getcity')); ?>";
        var select = "<?php echo e(trans('labels.select')); ?>";
        var cityid = "<?php echo e($getuserdata->city_id); ?>";
        $('#name').on('blur', function() {
            "use strict";
            $('#slug').val($('#name').val().split(" ").join("-").toLowerCase());
        });
    </script>
    <script src="<?php echo e(url(env('ASSETPATHURL') . '/admin-assets/js/user.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/admin/user/edit.blade.php ENDPATH**/ ?>