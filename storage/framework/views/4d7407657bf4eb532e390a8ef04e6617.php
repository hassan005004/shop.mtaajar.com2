<?php
    if (Auth::user()->type == 4) {
        $vendor_id = Auth::user()->vendor_id;
    } else {
        $vendor_id = Auth::user()->id;
    }
?>
<?php $__env->startSection('content'); ?>
    <div class="d-flex justify-content-between align-items-center">
        <h5 class="text-capitalize fw-600 text-dark fs-4"><?php echo e(trans('labels.add_new')); ?></h5>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="<?php echo e(URL::to('admin/products')); ?>"><?php echo e(trans('labels.products')); ?></a></li>
                <li class="breadcrumb-item active <?php echo e(session()->get('direction') == 2 ? 'breadcrumb-rtl' : ''); ?>"
                    aria-current="page"><?php echo e(trans('labels.add')); ?></li>
            </ol>
        </nav>
    </div>
    <div class="row mt-3">
        <div class="col-12">
            <div class="card border-0 box-shadow">
                <div class="card-body">
                    <form action="<?php echo e(URL::to('admin/products/save')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label class="form-label"><?php echo e(trans('labels.category')); ?> <span class="text-danger">
                                        * </span></label>
                                <select class="form-select" name="category" id="cat_id"
                                    data-url="<?php echo e(URL::to('admin/products/subcategories')); ?>" required>
                                    <option value=""><?php echo e(trans('labels.select')); ?></option>
                                    <?php $__currentLoopData = $getcategorylist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $catdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($catdata->id); ?>" data-id="<?php echo e($catdata->id); ?>"
                                            <?php echo e(old('category') == $catdata->id ? 'selected' : ''); ?>>
                                            <?php echo e($catdata->name); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php $__errorArgs = ['category'];
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

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label"><?php echo e(trans('labels.sub_category')); ?> </label>
                                    <select name="sub_category[]" class="form-control" multiple id="sub_category"></select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label"><?php echo e(trans('labels.name')); ?> <span class="text-danger"> *
                                    </span></label>
                                <input type="text" class="form-control" name="product_name"
                                    value="<?php echo e(old('product_name')); ?>" placeholder="<?php echo e(trans('labels.name')); ?>" required>
                                <?php $__errorArgs = ['product_name'];
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
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label"><?php echo e(trans('labels.sku')); ?> </label>
                                    <input type="text" class="form-control" name="product_sku"
                                        value="<?php echo e(old('product_sku')); ?>" placeholder="<?php echo e(trans('labels.sku')); ?>"
                                        id="product_sku">
                                    <?php $__errorArgs = ['product_sku'];
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
                            <div class="col-md-4 form-group">
                                <label class="form-label"><?php echo e(trans('labels.image')); ?> <span class="text-danger"> *
                                    </span></label>
                                <input type="file" class="form-control" name="product_image[]" id="image"
                                    multiple="" required>
                                <?php $__errorArgs = ['product_image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-danger"><?php echo e($message); ?></span> <br>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                <div class="gallery"></div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label"><?php echo e(trans('labels.tax')); ?> </label>
                                    <select name="tax[]" class="form-control selectpicker" multiple
                                        data-live-search="true">
                                        <?php if(!empty($gettaxlist)): ?>
                                            <?php $__currentLoopData = $gettaxlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($tax->id); ?>"> <?php echo e($tax->name); ?> </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label"><?php echo e(trans('labels.video_url')); ?> </label>
                                    <input class="form-control" type="text" name="video_url"
                                        placeholder="<?php echo e(trans('labels.video_url')); ?>" value="<?php echo e(old('video_url')); ?>">

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label"><?php echo e(trans('labels.attachment_name')); ?> </label>
                                    <input type="text" class="form-control" name="attachment_name" id="attachment_name"
                                        placeholder="<?php echo e(trans('labels.attachment_name')); ?>">
                                    <?php $__errorArgs = ['attachment_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="text-danger"><?php echo e($message); ?></span> <br>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label"><?php echo e(trans('labels.attachment_file')); ?></label>
                                    <input type="file" class="form-control" name="attachment_file" id="attachment_file">

                                </div>
                            </div>
                            <?php if(@helper::checkaddons('digital_product')): ?>
                                <?php echo $__env->make('admin.product.digital_product', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php endif; ?>
                        </div>

                        <div class="row">
                            <div class="col-12 d-flex flex-wrap justify-content-between align-items-center">
                                <div class="form-group">
                                    <label for="has_extras"
                                        class="form-label"><?php echo e(trans('labels.product_has_extras')); ?></label>
                                    <div class="col-md-12">
                                        <div class="form-check-inline">
                                            <input class="form-check-input me-0 has_extras" type="radio"
                                                name="has_extras" id="extras_no" value="2" checked
                                                <?php if(old('has_extras') == 2): ?> checked <?php endif; ?>>
                                            <label class="form-check-label"
                                                for="extras_no"><?php echo e(trans('labels.no')); ?></label>
                                        </div>
                                        <div class="form-check-inline">
                                            <input class="form-check-input me-0 has_extras" type="radio"
                                                name="has_extras" id="extras_yes" value="1"
                                                <?php if(old('has_extras') == 1): ?> checked <?php endif; ?>>
                                            <label class="form-check-label"
                                                for="extras_yes"><?php echo e(trans('labels.yes')); ?></label>
                                        </div>

                                    </div>
                                </div>
                                <div class="d-flex justify-content-center col-sm-auto col-12 mb-sm-0 mb-2">
                                    <div class="col-sm-auto col-10 pe-2">
                                        <?php if(count($globalextras) > 0): ?>
                                            <button class="btn btn-secondary px-sm-4 w-100 align-items-end"
                                                type="button" id="globalextra" onclick="global_extras()">
                                                <i class="fa-sharp fa-solid fa-plus"></i>
                                                <?php echo e(trans('labels.add_global_extras')); ?>

                                            </button>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-auto">
                                        <button class="btn btn-primary" type="button" id="add_extra"
                                            onclick="extras_fields('<?php echo e(trans('labels.name')); ?>','<?php echo e(trans('labels.price')); ?>')"><i
                                                class="fa-sharp fa-solid fa-plus"></i> </button>
                                    </div>
                                </div>

                            </div>
                            <div id="extras">

                                <?php if(!empty($globalextras) && $globalextras->count() > 0): ?>
                                    <div id="global-extras"></div>
                                <?php endif; ?>
                                <div id="more_extras_fields"></div>
                            </div>


                        </div>

                        <div class="row">
                            <div class="col-12 d-flex align-items-center justify-content-between">
                                <div class="form-group">
                                    <label for="has_variants"
                                        class="form-label"><?php echo e(trans('labels.product_has_variation')); ?></label>
                                    <div class="col-md-12">
                                        <div class="form-check-inline">
                                            <input class="form-check-input me-0 has_variants" type="radio"
                                                name="has_variants" id="no" value="2" checked
                                                <?php if(old('has_variants') == 2): ?> checked <?php endif; ?>>
                                            <label class="form-check-label"
                                                for="no"><?php echo e(trans('labels.no')); ?></label>
                                        </div>
                                        <div class="form-check-inline">
                                            <input class="form-check-input me-0 has_variants" type="radio"
                                                name="has_variants" id="yes" value="1"
                                                <?php if(old('has_variants') == 1): ?> checked <?php endif; ?>>
                                            <label class="form-check-label"
                                                for="yes"><?php echo e(trans('labels.yes')); ?></label>
                                        </div>

                                    </div>
                                </div>
                                <button class="btn btn-primary" type="button" id="btn_addvariants"
                                    onclick="commonModal()">
                                    <i class="fa-sharp fa-solid fa-plus"></i>
                                </button>
                            </div>
                            <div class="col-12">
                                <div class="row dn <?php if($errors->has('variants_name.*') || $errors->has('variants_price.*')): ?> dn <?php endif; ?> <?php if(old('variants') == 2): ?> d-flex <?php endif; ?>"
                                    id="price_row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label"><?php echo e(trans('labels.original_price')); ?> <span
                                                    class="text-danger"> * </span>
                                            </label>
                                            <input type="text" class="form-control numbers_only" name="original_price"
                                                value="<?php echo e(old('original_price')); ?>"
                                                placeholder="<?php echo e(trans('labels.original_price')); ?>" id="original_price"
                                                required>
    
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label"><?php echo e(trans('labels.selling_price')); ?> <span
                                                    class="text-danger"> * </span></label>
                                            <input type="text" class="form-control numbers_only" name="price"
                                                value="<?php echo e(old('price')); ?>"
                                                placeholder="<?php echo e(trans('labels.selling_price')); ?>" id="price" required>
    
                                        </div>
                                    </div>
    
                                    <div class="col-12 d-flex align-items-center justify-content-between">
                                        <div class="form-group">
                                            <label for="has_stock"
                                                class="form-label"><?php echo e(trans('labels.stock_management')); ?></label>
                                            <div class="col-md-12">
                                                <div class="form-check-inline">
                                                    <input class="form-check-input me-0 has_stock" type="radio"
                                                        name="has_stock" id="stock_no" value="2" checked
                                                        <?php if(old('has_stock') == 2): ?> checked <?php endif; ?>>
                                                    <label class="form-check-label"
                                                        for="stock_no"><?php echo e(trans('labels.no')); ?></label>
                                                </div>
                                                <div class="form-check-inline">
                                                    <input class="form-check-input me-0 has_stock" type="radio"
                                                        name="has_stock" id="stock_yes" value="1"
                                                        <?php if(old('has_stock') == 1): ?> checked <?php endif; ?>>
                                                    <label class="form-check-label"
                                                        for="stock_yes"><?php echo e(trans('labels.yes')); ?></label>
                                                </div>
    
                                            </div>
                                        </div>
                                    </div>
    
                                    <div class="col-md-3" id="block_stock_qty">
                                        <div class="form-group">
                                            <label class="form-label"><?php echo e(trans('labels.stock_qty')); ?> <span
                                                    class="text-danger"> * </span></label>
                                            <input type="text" class="form-control numbers_only"
                                                onkeypress="allowNumbersOnly(event)" name="qty"
                                                value="<?php echo e(old('qty')); ?>" placeholder="<?php echo e(trans('labels.stock_qty')); ?>"
                                                id="qty">
                                        </div>
                                    </div>
                                    <div class="col-md-3" id="block_min_order">
                                        <div class="form-group">
                                            <label class="form-label"><?php echo e(trans('labels.min_order_qty')); ?> <span
                                                    class="text-danger"> * </span>
                                            </label>
                                            <input type="text" class="form-control numbers_only"
                                                onkeypress="allowNumbersOnly(event)" name="min_order"
                                                value="<?php echo e(old('min_order')); ?>"
                                                placeholder="<?php echo e(trans('labels.min_order_qty')); ?>" id="min_order">
    
                                        </div>
                                    </div>
                                    <div class="col-md-3" id="block_max_order">
                                        <div class="form-group">
                                            <label class="form-label"><?php echo e(trans('labels.max_order_qty')); ?> <span
                                                    class="text-danger"> * </span>
                                            </label>
                                            <input type="text" class="form-control numbers_only"
                                                onkeypress="allowNumbersOnly(event)" name="max_order"
                                                value="<?php echo e(old('max_order')); ?>"
                                                placeholder="<?php echo e(trans('labels.max_order_qty')); ?>" id="max_order">
    
                                        </div>
                                    </div>
                                    <div class="col-md-3" id="block_product_low_qty_warning">
                                        <div class="form-group">
                                            <label class="form-label"><?php echo e(trans('labels.product_low_qty_warning')); ?> <span
                                                    class="text-danger"> * </span></label>
                                            <input type="text" class="form-control numbers_only variation_qty"
                                                onkeypress="allowNumbersOnly(event)" name="low_qty" id="low_qty"
                                                placeholder="<?php echo e(trans('labels.product_low_qty_warning')); ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row  dn <?php if($errors->has('variation.*') || $errors->has('variation_price.*') || old('has_variants') == 1): ?> d-flex <?php endif; ?>" id="variations">
                                    <div id="productVariant" class="col-md-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="card my-3 d-none" id="variant_card">
                                                    <div class="card-header">
                                                        <div class="row flex-grow-1">
                                                            <div class="col-md d-flex align-items-center">
                                                                <h5 class="card-header-title">
                                                                    <?php echo e(trans('labels.product')); ?>

                                                                    <?php echo e(trans('labels.variants')); ?>

                                                                </h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <input type="hidden" id="hiddenVariantOptions"
                                                            name="hiddenVariantOptions" value="{}">
                                                        <div class="variant-table">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 form-group">
                                <label class="form-label"><?php echo e(trans('labels.description')); ?> </label>
                                <textarea class="form-control" id="ckeditor" name="description" required><?php echo e(old('description')); ?></textarea>

                            </div>
                            <div class="col-12 form-group">
                                <label class="form-label"><?php echo e(trans('labels.additional_info')); ?> </label>
                                <textarea class="form-control" id="ckeditor1" name="additional_info" required> <?php echo e(old('additional_info')); ?></textarea>
                                <?php $__errorArgs = ['additional_info'];
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
                        <div class="row">
                            <div class="form-group <?php echo e(session()->get('direction') == 2 ? 'text-start' : 'text-end'); ?>">
                                <a href="<?php echo e(URL::to('admin/products')); ?>"
                                    class="btn btn-danger px-sm-4"><?php echo e(trans('labels.cancel')); ?></a>
                                <button
                                    class="btn btn-primary px-sm-4 <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_products', Auth::user()->role_id, Auth::user()->vendor_id, 'add') == 1 ? '' : 'd-none') : ''); ?>"
                                    <?php if(env('Environment') == 'sendbox'): ?> type="button" onclick="myFunction()" <?php else: ?> type="submit" <?php endif; ?>><?php echo e(trans('labels.save')); ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade  modal-fade-transform" id="commonModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-inner lg-dialog" role="document">
            <div class="modal-content">
                <div class="popup-content">
                    <div class="modal-header justify-content-between popup-header align-items-center">
                        <div class="modal-title text-dark">
                            <h5 class="mb-0" id="modelCommanModelLabel"><?php echo e(trans('labels.add_variants')); ?></h5>
                        </div>
                        <button type="button" class="btn-close m-0" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="<?php echo e(URL::to('admin/products/get-product-variants-possibilities')); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label for="variant_name" class="mb-1"><?php echo e(trans('labels.variant_name')); ?></label>
                                <input class="form-control" name="variant_name" type="text" id="variant_name"
                                    onkeyup="this.value = this.value.replace(/[`\/\\|~_$&+,:;=?[\]@#{}'<>.^*()%!-/]/, '')"
                                    placeholder="<?php echo e('Variant Name, i.e Size, Color etc'); ?>">
                            </div>
                            <div class="form-group">
                                <label for="variant_options" class="mb-1"><?php echo e(trans('labels.variant_options')); ?></label>
                                <input class="form-control" name="variant_options" type="text" id="variant_options"
                                    placeholder="<?php echo e('Variant Options separated by|pipe symbol, i.e Black|Blue|Red'); ?>">
                            </div>
                            <div class="form-group col-12 d-flex justify-content-end form-label">
                                <input type="button" value="<?php echo e(trans('labels.cancel')); ?>"
                                    class="btn btn-danger px-sm-4" data-bs-dismiss="modal">
                                <input type="button" value="<?php echo e(trans('labels.add_variants')); ?>"
                                    class="btn btn-primary px-sm-4 add-variants ms-2">
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script>
        var page = "add";
        var extrasurl = "<?php echo e(URL::to('admin/getextras')); ?>";
        var vendor_id = "<?php echo e($vendor_id); ?>";
        var placehodername = "<?php echo e(trans('labels.name')); ?>";
        var placeholderprice = "<?php echo e(trans('labels.price')); ?>";
        var page = "add";
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.12.1/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('ckeditor1');
    </script>

    <script src="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/js/editor.js')); ?>"></script>
    <script src="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/js/product.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/admin/product/add_product.blade.php ENDPATH**/ ?>