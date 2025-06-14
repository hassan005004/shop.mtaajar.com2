<?php
    if (Auth::user()->type == 4) {
        $vendor_id = Auth::user()->vendor_id;
    } else {
        $vendor_id = Auth::user()->id;
    }
?>
<?php $__env->startSection('content'); ?>

    <div class="d-flex justify-content-between align-items-center ">
        <h5 class="text-capitalize fw-600 text-dark fs-4"><?php echo e(trans('labels.edit')); ?></h5>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="<?php echo e(URL::to('admin/products')); ?>"><?php echo e(trans('labels.products')); ?></a></li>
                <li class="breadcrumb-item active <?php echo e(session()->get('direction') == 2 ? 'breadcrumb-rtl' : ''); ?>"
                    aria-current="page"><?php echo e(trans('labels.edit')); ?></li>
            </ol>
        </nav>
    </div>
    <div class="row mt-3">
        <div class="col-12">
            <div class="card border-0 box-shadow">
                <div class="card-body">
                    <?php if(!empty($getproductdata)): ?>
                        <form action="<?php echo e(URL::to('admin/products/update-' . $getproductdata->slug)); ?>" method="POST"
                            enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-md-6 form-group">

                                    <label class="form-label"><?php echo e(trans('labels.category')); ?> <span class="text-danger"> *
                                        </span></label>
                                    <select class="form-select" name="category" id="editcat_id"
                                        data-url="<?php echo e(URL::to('admin/products/subcategories')); ?>" required>
                                        <option value=""><?php echo e(trans('labels.select')); ?></option>
                                        <?php $__currentLoopData = $getcategorylist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $catdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($catdata->id); ?>" data-id="<?php echo e($catdata->id); ?>"
                                                <?php echo e($getproductdata->category_id == $catdata->id ? 'selected' : ''); ?>>
                                                <?php echo e($catdata->name); ?> </option>
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

                                <div class="col-md-6 form-group">
                                    <label class="form-label"><?php echo e(trans('labels.sub_category')); ?></label>
                                    <select class="form-select" name="sub_category[]" multiple id="sub_category"
                                        data-old="<?php echo e(old('sub_category')); ?>">

                                        <?php $__currentLoopData = $getsubcategorylist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcatdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($subcatdata->id); ?>" data-id="<?php echo e($subcatdata->id); ?>"
                                                <?php echo e(in_array($subcatdata->id, explode('|', $getproductdata->sub_category_id)) ? 'selected' : ''); ?>>
                                                <?php echo e($subcatdata->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['sub_category'];
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
                                <div class="col-6 form-group">
                                    <label class="form-label"><?php echo e(trans('labels.name')); ?> <span class="text-danger">
                                            * </span></label>
                                    <input type="text" class="form-control" name="product_name"
                                        value="<?php echo e($getproductdata->name); ?>" placeholder="<?php echo e(trans('labels.name')); ?>"
                                        required>
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
                                <div class="col-6 form-group">
                                    <label class="form-label"><?php echo e(trans('labels.sku')); ?> </label>
                                    <input type="text" class="form-control" name="product_sku"
                                        value="<?php echo e($getproductdata->sku); ?>" placeholder="<?php echo e(trans('labels.sku')); ?>">
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
                                    <div class="form-group add-extra-class <?php echo e(session()->get('direction') == 2 ? 'rtl' : ''); ?>">
                                        <label class="form-label"><?php echo e(trans('labels.tax')); ?></label>
                                        <select name="tax[]" class="form-control selectpicker" multiple
                                            data-live-search="true">
                                            <?php if(!empty($gettaxlist)): ?>
                                                <?php $__currentLoopData = $gettaxlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($tax->id); ?>"
                                                        <?php echo e(in_array($tax->id, explode('|', $getproductdata->tax)) ? 'selected' : ''); ?>>
                                                        <?php echo e($tax->name); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label"><?php echo e(trans('labels.video_url')); ?> </label>
                                        <input class="form-control" type="text" name="video_url"
                                            placeholder="<?php echo e(trans('labels.video_url')); ?>"
                                            value="<?php echo e($getproductdata->video_url); ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label"><?php echo e(trans('labels.attachment_name')); ?> </label>
                                        <input class="form-control" type="text" name="attachment_name"
                                            placeholder="<?php echo e(trans('labels.attachment_name')); ?>"
                                            value="<?php echo e($getproductdata->attchment_name); ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label"><?php echo e(trans('labels.attachment_file')); ?></label>
                                        <input type="file" class="form-control" name="attachment_file"
                                            id="attachment_file">
                                        <p class="text-danger mt-2"><?php echo e(trans('labels.attachment')); ?> : <span
                                                class="text-dark">
                                                <a href="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/images/product/' . $getproductdata->attchment_file)); ?>"
                                                    target="_blank"><?php echo e($getproductdata->attchment_file); ?></a></span></p>

                                    </div>
                                </div>
                                <?php if(@helper::checkaddons('digital_product')): ?>
                                    <?php echo $__env->make('admin.product.digital_product', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php endif; ?>
                            </div>
                            <div class="col-12 d-flex flex-wrap justify-content-between align-items-center">
                                <div class="form-group">
                                    <label for="has_extras"
                                        class="col-form-label"><?php echo e(trans('labels.product_has_extras')); ?></label>
                                    <div class="col-md-12">
                                        <div class="form-check-inline">
                                            <input class="form-check-input me-0 has_extras" type="radio" name="has_extras"
                                                id="extras_no" value="2"
                                                <?php echo e(count($getproductdata['extras']) > 0 ? '' : 'checked'); ?>>
                                            <label class="form-check-label"
                                                for="extras_no"><?php echo e(trans('labels.no')); ?></label>
                                        </div>
                                        <div class="form-check-inline">
                                            <input class="form-check-input me-0 has_extras" type="radio"
                                                name="has_extras" id="extras_yes" value="1"
                                                <?php echo e(count($getproductdata['extras']) > 0 ? 'checked' : ''); ?>>
                                            <label class="form-check-label"
                                                for="extras_yes"><?php echo e(trans('labels.yes')); ?></label>
                                        </div>

                                    </div>
                                </div>
                                <div class="d-flex justify-content-center col-sm-auto col-12 mb-sm-0 mb-2">
                                    <div class="col-sm-auto col-10 px-2">
                                        <?php if(count($globalextras) > 0): ?>
                                            <button class="btn btn-secondary px-sm-4 w-100 align-items-end" type="button"
                                                id="globalextra" onclick="global_extras()">
                                                <i class="fa-sharp fa-solid fa-plus"></i>
                                                <?php echo e(trans('labels.add_global_extras')); ?>

                                            </button>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-auto">
                                        <button class="btn btn-primary" type="button" id="add_extra"
                                            onclick="more_editextras_fields('<?php echo e(trans('labels.name')); ?>','<?php echo e(trans('labels.price')); ?>')"><i
                                                class="fa-sharp fa-solid fa-plus"></i> </button>
                                    </div>
                                </div>
                                

                            </div>

                            <div class="" id="extras">
                                <?php $__currentLoopData = $getproductdata['extras']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $extras): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="row pe-0">
                                        <input type="hidden" class="form-control" name="extras_id[]"
                                            value="<?php echo e($extras->id); ?>">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <?php if($key == 0): ?>
                                                    <label class="col-form-label"><?php echo e(trans('labels.name')); ?> <span
                                                            class="text-danger">
                                                            * </span></label>
                                                <?php endif; ?>
                                                <input type="text" class="form-control extras_name"
                                                    name="extras_name[]" value="<?php echo e($extras->name); ?>"
                                                    placeholder="<?php echo e(trans('labels.name')); ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <?php if($key == 0): ?>
                                                    <label class="col-form-label"><?php echo e(trans('labels.price')); ?>

                                                        <span class="text-danger">
                                                            * </span></label>
                                                <?php endif; ?>
                                                <div class="d-flex gap-2">
                                                    <input type="text" class="form-control numbers_only extras_price"
                                                        name="extras_price[]" value="<?php echo e($extras->price); ?>"
                                                        placeholder="<?php echo e(trans('labels.price')); ?>" required>
                                                    <button class="btn btn-danger" type="button"
                                                        <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?> onclick="deletedata('<?php echo e(URL::to('admin/products/delete/extras-' . $extras->id)); ?>')" <?php endif; ?>><i
                                                            class="fa fa-trash" aria-hidden="true"></i> </button>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                    <span class="hiddenextrascount d-none"><?php echo e($key); ?></span>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <div id="global-extras"></div>
                                <div id="more_editextras_fields"></div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="form-group">
                                            <label for="has_variants"
                                                class="col-form-label"><?php echo e(trans('labels.product_has_variation')); ?></label>
                                            <div class="col-md-12">

                                                <div class="form-check-inline">
                                                    <input class="form-check-input me-0 has_variants" type="radio"
                                                        name="has_variants" id="no" value="2" checked
                                                        <?php if($getproductdata->has_variation == 2): ?> checked <?php endif; ?>>
                                                    <label class="form-check-label"
                                                        for="no"><?php echo e(trans('labels.no')); ?></label>
                                                </div>
                                                <div class="form-check-inline">
                                                    <input class="form-check-input me-0 has_variants" type="radio"
                                                        name="has_variants" id="yes" value="1"
                                                        <?php if($getproductdata->has_variation == 1): ?> checked <?php endif; ?>>
                                                    <label class="form-check-label"
                                                        for="yes"><?php echo e(trans('labels.yes')); ?></label>
                                                </div>

                                            </div>
                                        </div>
                                        <?php if($getproductdata->has_variation == 1 && count($getproductdata['multi_variation']) > 0): ?>
                                            <div
                                                class="<?php echo e(session()->get('direction') == 2 ? 'text-start' : 'text-end'); ?>">
                                                <button class="btn btn-primary get-variants" type="button"
                                                    dataa-url="<?php echo e(URL::to('admin/products/variants/edit', $getproductdata->id)); ?>">
                                                    <i class="fa-sharp fa-solid fa-plus"></i>
                                                </button>
                                            </div>
                                        <?php else: ?>
                                            <div
                                                class="<?php echo e(session()->get('direction') == 2 ? 'text-start' : 'text-end'); ?>">
                                                <button class="btn btn-primary" type="button" id="btn_addvariants"
                                                    onclick="addvariantModal()">
                                                    <i class="fa-sharp fa-solid fa-plus"></i>
                                                </button>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="row <?php if($getproductdata->has_variation == 1): ?> dn <?php endif; ?>" id="price_row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label"><?php echo e(trans('labels.original_price')); ?> <span
                                                        class="text-danger">
                                                        * </span></label>
                                                <input type="text" step="any" class="form-control numbers_only"
                                                    name="original_price"
                                                    value="<?php echo e($getproductdata->has_variation == 1 ? '' : ($getproductdata->original_price > 0 ? $getproductdata->original_price : 0)); ?>"
                                                    placeholder="<?php echo e(trans('labels.original_price')); ?>"
                                                    id="original_price">

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label"><?php echo e(trans('labels.selling_price')); ?> <span
                                                        class="text-danger">
                                                        * </span></label>
                                                <input type="text" step="any" class="form-control numbers_only"
                                                    name="price"
                                                    value="<?php echo e($getproductdata->has_variation == 1 ? '' : $getproductdata->price); ?>"
                                                    placeholder="<?php echo e(trans('labels.selling_price')); ?>" id="price">

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
                                                            <?php if($getproductdata->stock_management == 2): ?> checked <?php endif; ?>>
                                                        <label class="form-check-label"
                                                            for="stock_no"><?php echo e(trans('labels.no')); ?></label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <input class="form-check-input me-0 has_stock" type="radio"
                                                            name="has_stock" id="stock_yes" value="1"
                                                            <?php if($getproductdata->stock_management == 1): ?> checked <?php endif; ?>>
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
                                                <input type="text" class="form-control numbers_only" name="qty"
                                                    onkeypress="allowNumbersOnly(event)"
                                                    value="<?php echo e($getproductdata->has_variation == 1 ? '' : $getproductdata->qty); ?>"
                                                    placeholder="<?php echo e(trans('labels.stock_qty')); ?>" id="qty">
                                            </div>
                                        </div>
                                        <div class="col-md-3" id="block_min_order">
                                            <div class="form-group">
                                                <label class="form-label"><?php echo e(trans('labels.min_order_qty')); ?> <span
                                                        class="text-danger"> * </span></label>
                                                <input type="text" class="form-control numbers_only" name="min_order"
                                                    onkeypress="allowNumbersOnly(event)"
                                                    value="<?php echo e($getproductdata->has_variation == 1 ? '' : ($getproductdata->min_order > 0 ? $getproductdata->min_order : 0)); ?>"
                                                    placeholder="<?php echo e(trans('labels.min_order_qty')); ?>" id="min_order">

                                            </div>
                                        </div>
                                        <div class="col-md-3" id="block_max_order">
                                            <div class="form-group">
                                                <label class="form-label"><?php echo e(trans('labels.max_order_qty')); ?> <span
                                                        class="text-danger"> * </span></label>
                                                <input type="text" class="form-control numbers_only" name="max_order"
                                                    onkeypress="allowNumbersOnly(event)"
                                                    value="<?php echo e($getproductdata->has_variation == 1 ? '' : ($getproductdata->max_order > 0 ? $getproductdata->max_order : 0)); ?>"
                                                    placeholder="<?php echo e(trans('labels.max_order_qty')); ?>" id="max_order">

                                            </div>
                                        </div>
                                        <div class="col-md-3" id="block_product_low_qty_warning">
                                            <div class="form-group">
                                                <label class="form-label"><?php echo e(trans('labels.product_low_qty_warning')); ?>

                                                    <span class="text-danger"> * </span></label>
                                                <input type="text" class="form-control" name="low_qty" id="low_qty"
                                                    onkeypress="allowNumbersOnly(event)"
                                                    value="<?php echo e($getproductdata->low_qty); ?>"
                                                    placeholder="<?php echo e(trans('labels.product_low_qty_warning')); ?>">

                                            </div>
                                        </div>


                                    </div>
                                </div>
                                <div class="<?php if($getproductdata->has_variation == 2): ?> dn <?php endif; ?>" id="variations">
                                    <div class="card my-3 <?php echo e(count($productVariantArrays) > 0 ? 'd-flex' : 'd-none'); ?>"
                                        id="variant_card">
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
                                            <div class="row form-group">
                                                <div class="table-responsive">

                                                    <input type="hidden" id="hiddenVariantOptions"
                                                        name="hiddenVariantOptions"
                                                        value="<?php echo e($getproductdata->variants_json == null ? '{}' : $getproductdata->variants_json); ?>">
                                                    <div class="variant-table">
                                                        <table class="table table-bordered" id='tblvariants'>
                                                            <thead>
                                                                <tr class="text-center">
                                                                    <?php if(isset($product_variant_names)): ?>
                                                                        <?php $__currentLoopData = $product_variant_names; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <th class="fs-15 fw-500">
                                                                                <span><?php echo e(ucwords($variant)); ?></span>
                                                                            </th>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php endif; ?>
                                                                    <th class="fs-15 fw-500">
                                                                        <span><?php echo e(trans('labels.original_price')); ?></span>
                                                                    </th>
                                                                    <th class="fs-15 fw-500">
                                                                        <span><?php echo e(trans('labels.selling_price')); ?></span>
                                                                    </th>
                                                                    <th class="fs-15 fw-500">
                                                                        <span><?php echo e(trans('labels.stock_qty')); ?></span>
                                                                    </th>
                                                                    <th class="fs-15 fw-500">
                                                                        <span><?php echo e(trans('labels.min_order_qty')); ?></span>
                                                                    </th>
                                                                    <th class="fs-15 fw-500">
                                                                        <span><?php echo e(trans('labels.max_order_qty')); ?></span>
                                                                    </th>
                                                                    <th class="fs-15 fw-500">
                                                                        <span><?php echo e(trans('labels.product_low_qty_warning')); ?></span>
                                                                    </th>
                                                                    <th class="fs-15 fw-500">
                                                                        <span><?php echo e(trans('labels.stock_management')); ?></span>
                                                                    </th>
                                                                    <th class="fs-15 fw-500">
                                                                        <span><?php echo e(trans('labels.is_available')); ?></span>
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                                <?php if(isset($productVariantArrays)): ?>
                                                                    <?php $__currentLoopData = $productVariantArrays; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $counter => $productVariant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <tr class="fs-7 align-middle"
                                                                            data-id="<?php echo e($productVariant['product_variants']['id']); ?>">
                                                                            <?php $__currentLoopData = explode('|', $productVariant['product_variants']['name']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $values): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <td>
                                                                                    <input type="text"
                                                                                        name="variants[<?php echo e($productVariant['product_variants']['id']); ?>][variants][<?php echo e($key); ?>][]"
                                                                                        autocomplete="off"
                                                                                        spellcheck="false"
                                                                                        class="form-control"
                                                                                        value="<?php echo e($values); ?>"
                                                                                        readonly>
                                                                                </td>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                            <td>
                                                                                <input type="number"
                                                                                    name="variants[<?php echo e($productVariant['product_variants']['id']); ?>][original_price]"
                                                                                    autocomplete="off" spellcheck="false"
                                                                                    placeholder="<?php echo e(trans('labels.original_price')); ?>"
                                                                                    class="form-control voriginal_price_<?php echo e($counter); ?>"
                                                                                    value="<?php echo e($productVariant['product_variants']['original_price']); ?>"
                                                                                    onclick="originalpricevalidation('<?php echo e($counter); ?>')"
                                                                                    id="voriginal_price_<?php echo e($counter); ?>"
                                                                                    required>
                                                                            </td>
                                                                            <td>
                                                                                <input type="number"
                                                                                    name="variants[<?php echo e($productVariant['product_variants']['id']); ?>][price]"
                                                                                    autocomplete="off" spellcheck="false"
                                                                                    placeholder="<?php echo e(trans('labels.selling_price')); ?>"
                                                                                    class="form-control vprice_<?php echo e($counter); ?>"
                                                                                    value="<?php echo e($productVariant['product_variants']['price']); ?>"
                                                                                    onclick="sellingpricevalidation('<?php echo e($counter); ?>')"
                                                                                    id="vprice_<?php echo e($counter); ?>"
                                                                                    required>
                                                                            </td>

                                                                            <td>
                                                                                <input type="number"
                                                                                    name="variants[<?php echo e($productVariant['product_variants']['id']); ?>][qty]"
                                                                                    autocomplete="off" spellcheck="false"
                                                                                    placeholder="<?php echo e(trans('labels.stock_qty')); ?>"
                                                                                    class="form-control vqty_<?php echo e($counter); ?>"
                                                                                    value="<?php echo e($productVariant['product_variants']['qty']); ?>"
                                                                                    id="vqty_<?php echo e($counter); ?>">
                                                                            </td>
                                                                            <td>
                                                                                <input type="number"
                                                                                    name="variants[<?php echo e($productVariant['product_variants']['id']); ?>][min_order]"
                                                                                    autocomplete="off" spellcheck="false"
                                                                                    placeholder="<?php echo e(trans('labels.min_order_qty')); ?>"
                                                                                    class="form-control vmin_order_<?php echo e($counter); ?>"
                                                                                    value="<?php echo e($productVariant['product_variants']['min_order']); ?>"
                                                                                    id="vmin_order_<?php echo e($counter); ?>">
                                                                            </td>
                                                                            <td>
                                                                                <input type="number"
                                                                                    name="variants[<?php echo e($productVariant['product_variants']['id']); ?>][max_order]"
                                                                                    autocomplete="off" spellcheck="false"
                                                                                    placeholder="<?php echo e(trans('labels.max_order_qty')); ?>"
                                                                                    class="form-control vmax_order_<?php echo e($counter); ?>"
                                                                                    value="<?php echo e($productVariant['product_variants']['max_order']); ?>"
                                                                                    id="vmax_order_<?php echo e($counter); ?>">
                                                                            </td>
                                                                            <td>
                                                                                <input type="number"
                                                                                    name="variants[<?php echo e($productVariant['product_variants']['id']); ?>][low_qty]"
                                                                                    autocomplete="off" spellcheck="false"
                                                                                    placeholder="<?php echo e(trans('labels.product_low_qty_warning')); ?>"
                                                                                    class="form-control vlow_qty_<?php echo e($counter); ?>"
                                                                                    value="<?php echo e($productVariant['product_variants']['low_qty']); ?>"
                                                                                    id="vlow_qty_<?php echo e($counter); ?>">
                                                                            </td>
                                                                            <td class="text-center">
                                                                                <input
                                                                                    class="form-check-input  vstock_management_<?php echo e($counter); ?>"
                                                                                    type="checkbox" value="1"
                                                                                    <?php echo e($productVariant['product_variants']['stock_management'] == 1 ? 'checked' : ''); ?>

                                                                                    onclick="edit_stock_management(this.id)"
                                                                                    name="variants[<?php echo e($productVariant['product_variants']['id']); ?>][stock_management]"
                                                                                    id="vstockmanagement_<?php echo e($counter); ?>">

                                                                            </td>
                                                                            <td class="text-center">
                                                                                <input
                                                                                    class="form-check-input  vis_available_<?php echo e($counter); ?> product_available"
                                                                                    type="checkbox" value="1"
                                                                                    onclick="edit_checkavailable(this.id)"
                                                                                    <?php echo e($productVariant['product_variants']['is_available'] == 1 ? 'checked' : ''); ?>

                                                                                    name="variants[<?php echo e($productVariant['product_variants']['id']); ?>][is_available]"
                                                                                    id="<?php echo e($counter); ?>">

                                                                            </td>

                                                                        </tr>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                <?php endif; ?>
                                                            </tbody>
                                                        </table>
                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 form-group">
                                    <label class="form-label"><?php echo e(trans('labels.description')); ?></label>
                                    <textarea class="form-control" id="ckeditor" name="description" required><?php echo $getproductdata->description; ?></textarea>
                                </div>
                                <div class="col-sm-12 form-group">
                                    <label class="form-label"><?php echo e(trans('labels.additional_info')); ?></label>
                                    <textarea class="form-control" id="ckeditor1" name="additional_info" required><?php echo $getproductdata->additional_info; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group <?php echo e(session()->get('direction') == 2 ? 'text-start' : 'text-end'); ?>">
                                <div>
                                    <a href="<?php echo e(URL::to('admin/products')); ?>"
                                        class="btn btn-danger px-sm-4"><?php echo e(trans('labels.cancel')); ?></a>
                                    <button class="btn btn-primary px-sm-4"
                                        <?php if(env('Environment') == 'sendbox'): ?> type="button" onclick="myFunction()" <?php else: ?> type="submit" <?php endif; ?>><?php echo e(trans('labels.save')); ?></button>
                                </div>
                            </div>
                        </form>
                    <?php else: ?>
                        <?php echo $__env->make('admin.layout.no_data', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="mt-3">
            <div class="card border-0 box-shadow">
                <div class="card-body">
                    <div class="col-12" data-url="<?php echo e(url('admin/products/reorder_image-' . $getproductdata->id)); ?>"
                        id="carddetails">
                        <div class="col-12 d-flex flex-wrap gap-2 border-bottom pb-3 justify-content-between align-items-center mb-3">
                            <h5 class="text-capitalize text-dark">
                                <?php echo e(trans('labels.product_images')); ?></h5>
                            <a href="javascript:void(0)" onclick="addimage('<?php echo e($getproductdata->id); ?>')"
                                class="btn btn-secondary px-sm-4">
                                <i class="fa-regular fa-plus mx-1"></i><?php echo e(trans('labels.add')); ?>

                            </a>
                        </div>
                        <div class="row g-3 sort_menu">
                            <?php $__currentLoopData = $getproductdata['multi_image']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $productimage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-xl-2 col-lg-3 col-md-4 col-6" data-id="<?php echo e($productimage->id); ?>">
                                    <div class="card-dec h-100 w-100 handle">
                                        <img src="<?php echo e(helper::image_path($productimage->image)); ?>"
                                            class="img-fluid product-image rounded-3 moveing-img w-100 object">
                                        <div class="d-flex gap-1 mt-2 justify-content-center">
                                            <a tooltip="<?php echo e(trans('labels.move')); ?>"
                                                class="btn btn-secondary hov btn-sm"><i
                                                    class="fa-light fa-up-down-left-right"></i></a>
                                            <a href="javascript:void(0)" class="btn btn-info hov btn-sm"
                                                onclick="imageview('<?php echo e($productimage->id); ?>','<?php echo e($productimage->image); ?>')"><i
                                                    class="fa-regular fa-pen-to-square"></i></a>
                                            <a href="javascript:void(0)"
                                                <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?> onclick="statusupdate('<?php echo e(URL::to('admin/products/delete_image-' . $productimage->id . '/' . $productimage->product_id)); ?>')" <?php endif; ?>
                                                class="btn btn-danger hov btn-sm <?php if($getproductdata['multi_image']->count() == 1): ?> d-none <?php else: ?> '' <?php endif; ?>"><i
                                                    class="fa-regular fa-trash"></i></a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <?php if(@helper::checkaddons('product_reviews')): ?>
            <?php if(@helper::checkaddons('customer_login')): ?>
                <?php if(helper::appdata($vendor_id)->checkout_login_required == 1): ?>
                    <div class="col-12 mt-3">
                        <div class="card border-0 box-shadow">
                            <div class="card-body">
                                <h5 class="text-capitalize border-bottom pb-3 mb-3 text-dark"><?php echo e(trans('labels.product_reviews')); ?>

                                </h5>
                                <div class="table-responsive">
                                    <table
                                        class="table table-striped table-bordered py-3 zero-configuration w-100 dataTable no-footer">
                                        <thead>
                                            <tr class="text-capitalize fs-15 fw-500">
                                                <td><?php echo e(trans('labels.srno')); ?></td>
                                                <td><?php echo e(trans('labels.image')); ?></td>
                                                <td><?php echo e(trans('labels.name')); ?></td>
                                                <td><?php echo e(trans('labels.description')); ?></td>
                                                <td><?php echo e(trans('labels.ratting')); ?></td>
                                                <td><?php echo e(trans('labels.action')); ?></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $i = 1;
                                            ?>
                                            <?php $__currentLoopData = $productreview; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr class="fs-7 align-middle row1" id="dataid<?php echo e($item->id); ?>"
                                                    data-id="<?php echo e($item->id); ?>">
                                                    <td><?php
                                                        echo $i++;
                                                    ?></td>
                                                    <td>
                                                        <img src="<?php echo e(@helper::image_path($item->image)); ?>"
                                                            class="img-fluid rounded object hw-50" alt="">
                                                    </td>
                                                    <td><?php echo e($item->name); ?></td>
                                                    <td><?php echo e($item->description); ?></td>
                                                    <td><?php echo e($item->star); ?> </td>
                                                    <td>
                                                        <a href="javascript:void(0)"
                                                            <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?>
                                                            onclick="statusupdate('<?php echo e(URL::to('/admin/products/review/delete-' . $item->id)); ?>')" <?php endif; ?>
                                                            class="btn btn-danger btn-sm hov <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_products', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>">
                                                            <i class="fa-regular fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
    </div>

    
    <div class="modal modal-fade-transform" id="addModal" tabindex="-1" aria-labelledby="addModallable"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header justify-content-between">
                    <h5 class="modal-title text-dark" id="addModallable"><?php echo e(trans('labels.image')); ?> <span class="text-danger"> *
                        </span></h5>
                    <button type="button" class="btn-close m-0" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action=" <?php echo e(URL::to('admin/products/add_image')); ?>" method="post" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <input type="hidden" id="product_id" name="product_id">
                        <input type="file" name="image" class="form-control" id="">
                        <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="text-danger"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger px-sm-4" data-bs-dismiss="modal"><?php echo e(trans('labels.cancel')); ?></button>
                        <button type="submit" class="btn btn-primary px-sm-4"><?php echo e(trans('labels.save')); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="modal modal-fade-transform" id="editModal" tabindex="-1" aria-labelledby="editModallable"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header justify-content-between">
                    <h5 class="modal-title text-dark" id="editModallable"><?php echo e(trans('labels.image')); ?> (450 x 300) <span
                            class="text-danger"> * </span></h5>
                    <button type="button" class="btn-close m-0" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action=" <?php echo e(URL::to('admin/products/update')); ?>" method="post" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <input type="hidden" id="img_id" name="id">
                        <input type="hidden" id="img_name" name="image">
                        <input type="file" name="product_image" class="form-control" id="">
                        <?php $__errorArgs = ['product_image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="text-danger"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger px-sm-4" data-bs-dismiss="modal"><?php echo e(trans('labels.cancel')); ?></button>
                        <button type="submit" class="btn btn-primary px-sm-4"><?php echo e(trans('labels.save')); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal modal-fade-transform" id="commonModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-inner lg-dialog" role="document">
            <div class="modal-content">
                <div class="popup-content">
                    <div class="modal-header justify-content-between popup-header align-items-center">
                        <div class="modal-title">
                            <h5 class="mb-0 text-dark fw-500" id="modelCommanModelLabel"><?php echo e(trans('labels.add_variants')); ?></h5>
                        </div>
                        <button type="button" class="btn-close m-0" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body pt-3 p-0">
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="modal modal-fade-transform" id="addvariantModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-inner lg-dialog" role="document">
            <div class="modal-content">
                <div class="popup-content">
                    <div class="modal-header justify-content-between popup-header align-items-center">
                        <div class="modal-title">
                            <h5 class="mb-0 text-dark" id="modelCommanModelLabel"><?php echo e(trans('labels.add_variants')); ?></h5>
                        </div>
                        <button type="button" class="btn-close m-0" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST"
                            action="<?php echo e(URL::to('admin/products/get-product-variants-possibilities')); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label for="variant_name"><?php echo e(trans('labels.variant_name')); ?></label>
                                <input class="form-control" name="variant_name" type="text" id="variant_name"
                                    onkeyup="this.value = this.value.replace(/[`\/\\|~_$&+,:;=?[\]@#{}'<>.^*()%!-/]/, '')"
                                    placeholder="<?php echo e('Variant Name, i.e Size, Color etc'); ?>">
                            </div>
                            <div class="form-group">
                                <label for="variant_options"><?php echo e(trans('labels.variant_options')); ?></label>
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
        var extrasurl = "<?php echo e(URL::to('admin/editgetextras-' . $getproductdata->id)); ?>";
        var vendor_id = "<?php echo e($vendor_id); ?>";
        var placehodername = "<?php echo e(trans('labels.name')); ?>";
        var placeholderprice = "<?php echo e(trans('labels.price')); ?>";
        var page = "edit";
    </script>
    <script>
        $(document).on('click', '.get-variants', function(e) {
            $("#commonModal .modal-title fs-5").html('<?php echo e(__('Add Variants')); ?>');
            $("#commonModal .modal-dialog").addClass('modal-md');
            $("#commonModal").modal('show');
            var data_url = $(this).attr('dataa-url');

            $.get(data_url, {}, function(data) {
                $('#commonModal .modal-body').html(data);
            });
        });

        $(document).on('click', '.add-variants', function(e) {
            e.preventDefault();
            var form = $(this).parents('form');
            var variantNameEle = $('#variant_name');
            var variantOptionsEle = $('#variant_options');
            var isValid = true;
            var hiddenVariantOptions = $('#hiddenVariantOptions').val();

            if (variantNameEle.val() == '') {
                variantNameEle.focus();
                isValid = false;
            } else if (variantOptionsEle.val() == '') {
                variantOptionsEle.focus();
                isValid = false;
            }

            if (isValid) {
                $.ajax({
                    url: form.attr('action'),
                    datType: 'json',
                    data: {
                        variant_name: variantNameEle.val(),
                        variant_options: variantOptionsEle.val(),
                        hiddenVariantOptions: hiddenVariantOptions
                    },
                    success: function(data) {
                        if (data.message != "" && data.message != null) {
                            toastr.error(data.message);
                        }
                        $('#hiddenVariantOptions').val(data.hiddenVariantOptions);
                        $('.variant-table').html(data.varitantHTML);
                        $('#variant_card').removeClass('d-none');
                        $("#commonModal").modal('hide');
                    }
                })
            }
        });
    </script>
    <script>
        function validation(value, id) {
            if (value.includes('@')) {
                newval = value.replaceAll('@', '');
                $('#' + id).val(newval);
            }
            if (value.includes('\\')) {
                newval = value.replaceAll('\\', '');
                $('#' + id).val(newval);
            }
        }
    </script>
    <script>
        $(document).ready(function() {

            $('.sort_menu').sortable({
                handle: '.handle',
                cursor: 'move',
                placeholder: 'highlight',
                axis: "x,y",

                update: function(e, ui) {
                    var sortData = $('.sort_menu').sortable('toArray', {
                        attribute: 'data-id'
                    })
                    updateToDatabase(sortData.join('|'))
                }
            })

            function updateToDatabase(idString) {

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    dataType: "json",
                    url: $('#carddetails').attr('data-url'),
                    data: {
                        ids: idString,
                    },
                    success: function(response) {
                        if (response.status == 1) {
                            toastr.success(response.msg);
                        } else {
                            toastr.success(wrong);
                        }
                    }
                });
            }

        })
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.12.1/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('ckeditor');
        CKEDITOR.replace('ckeditor1');
    </script>

    <script src="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/js/editor.js')); ?>"></script>
    <script src="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/js/product.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/admin/product/edit_product.blade.php ENDPATH**/ ?>