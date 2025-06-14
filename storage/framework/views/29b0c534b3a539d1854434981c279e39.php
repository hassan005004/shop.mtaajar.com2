<?php $__env->startSection('contents'); ?>
    <!-- BREADCRUMB AREA START -->
    <section class="py-4 bg-light">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li
                        class="<?php echo e(@helper::appdata(@$vendordata->id)->web_layout == 2 ? 'breadcrumb-item-rtl' : 'breadcrumb-item'); ?>">
                        <a class="text-dark fw-600"
                            href="<?php echo e(URL::to(@$vendordata->slug . '/')); ?>"><?php echo e(trans('labels.home')); ?></a>
                    </li>
                    <?php if(request()->category_slug == null || request()->category_slug == ''): ?>
                        <li class="text-muted <?php echo e(@helper::appdata(@$vendordata->id)->web_layout == 2 ? 'breadcrumb-item-rtl' : 'breadcrumb-item'); ?> active"
                            aria-current="page"><?php echo e(trans('labels.shop_all')); ?></li>
                    <?php else: ?>
                        <li
                            class="<?php echo e(@helper::appdata(@$vendordata->id)->web_layout == 2 ? 'breadcrumb-item-rtl' : 'breadcrumb-item'); ?>">
                            <a class="text-dark"
                                href="<?php echo e(URL::to(@$vendordata->slug . '/categories')); ?>"><?php echo e(trans('labels.categories')); ?></a>
                        </li>
                    <?php endif; ?>
                    <?php if(!empty($getcategorydata)): ?>
                        <?php if(empty($getsubcategorydata)): ?>
                            <li class="text-muted <?php echo e(@helper::appdata(@$vendordata->id)->web_layout == 2 ? 'breadcrumb-item-rtl' : 'breadcrumb-item'); ?> active"
                                aria-current="page"><?php echo e($getcategorydata->name); ?></li>
                        <?php else: ?>
                            <li
                                class="<?php echo e(@helper::appdata(@$vendordata->id)->web_layout == 2 ? 'breadcrumb-item-rtl' : 'breadcrumb-item'); ?>">
                                <a class="text-dark"
                                    href="<?php echo e(URL::to(@$vendordata->slug . '/category?category=' . $getcategorydata->slug)); ?>"><?php echo e($getcategorydata->name); ?></a>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php if(!empty($getsubcategorydata)): ?>
                        <li class="text-muted <?php echo e(@helper::appdata(@$vendordata->id)->web_layout == 2 ? 'breadcrumb-item-rtl' : 'breadcrumb-item'); ?> active"
                            aria-current="page"><?php echo e($getsubcategorydata->name); ?></li>
                    <?php endif; ?>
                </ol>
            </nav>
        </div>
    </section>
    <!-- BREADCRUMB AREA END -->
    <!-- PRODUCTS LIST AREA START -->
    <section class="product-list">
        <div class="container my-5">

            <?php if(!empty(@helper::appdata(@$vendordata->id)->viewallpage_banner)): ?>
                <img class="w-100 mb-4 object-fit-cover rounded h-250-px"
                    src="<?php echo e(helper::image_path(@helper::appdata(@$vendordata->id)->viewallpage_banner)); ?>">
            <?php endif; ?>
            <div class="filter bg-light px-2 rounded-3 py-4 row mt-4 mb-4 gap-2">
                <div class="col-12 col-md-auto">
                    <div class="row mb-3 gx-3 mb-md-0">
                        <div class="col-12 col-md-6 mb-3 mb-md-0">
                            <label for="category" class="form-label"><?php echo e(trans('labels.categories')); ?></label>
                            <select class="form-select form-select-sm select-auto-expand form-select-p"
                                aria-label="Default select example"
                                onchange="location =  $('option:selected',this).data('value');" name="category"
                                id="category">
                                <option class="select-auto-expand__select"
                                    data-value="<?php echo e(URL::to($vendordata->slug . '/products?category=' . '&subcategory=' . request()->get('subcategory'))); ?>"
                                    selected>
                                    <?php echo e(trans('labels.select')); ?></option>
                                <?php $__currentLoopData = helper::getcategories(@$vendordata->id, ''); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option class="select-auto-expand__select"
                                        <?php echo e(request()->category_slug == $category->slug || request()->get('category') == $category->slug ? 'selected' : ''); ?>

                                        value="<?php echo e($category->slug); ?>"
                                        data-value="<?php echo e(URL::to($vendordata->slug . '/products?category=' . $category->slug)); ?>">
                                        <?php echo e($category->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <?php
                            if (request()->has('category')) {
                                $category = request()->get('category');
                            } else {
                                $category = request()->category_slug;
                            }
                        ?>
                        <div class="col-12 col-md-6">
                            <label for="subcategory" class="form-label"><?php echo e(trans('labels.sub_categories')); ?></label>
                            <select class="form-select form-select-sm select-auto-expand form-select-p"
                                aria-label="Default select example"
                                onchange="location =  $('option:selected',this).data('value');" name="subcategory"
                                id="subcategory">
                                <option class="select-auto-expand__select"
                                    data-value="<?php echo e(URL::to(@$vendordata->slug . '/products?category=' . $category . '&subcategory=')); ?>"
                                    selected><?php echo e(trans('labels.select')); ?>

                                </option>
                                <?php $__currentLoopData = $subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option class="select-auto-expand__select" value="<?php echo e($subcategory->slug); ?>"
                                        data-value="<?php echo e(URL::to(@$vendordata->slug . '/products?category=' . $category . '&subcategory=' . $subcategory->slug)); ?>"
                                        <?php echo e(request()->get('subcategory') == $subcategory->slug ? 'selected' : ''); ?>>
                                        <?php echo e($subcategory->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-auto">
                    <label for="filter_by" class="form-label"><?php echo e(trans('labels.filter_by')); ?></label>
                    <select class="form-select form-select-sm form-select-p w-100 select-auto-expand"
                        onchange="location = $(this).find(':selected').attr('data-url');" name="filter_by">
                        <option class="select-auto-expand__select"
                            data-url="<?php echo e(URL::to(@$vendordata->slug . '/products-all?category=' . request()->get('category') . '&subcategory=' . request()->get('subcategory'))); ?>"
                            selected>
                            <?php echo e(trans('labels.select')); ?></option>
                        <option class="select-auto-expand__select"
                            data-url="<?php echo e(URL::to(@$vendordata->slug . '/products-newest?category=' . request()->get('category') . '&subcategory=' . request()->get('subcategory'))); ?>"
                            <?php echo e(strpos(request()->url(), 'newest') ? 'selected' : ''); ?>>
                            <?php echo e(trans('labels.newest')); ?></option>
                        <option class="select-auto-expand__select"
                            data-url="<?php echo e(URL::to(@$vendordata->slug . '/products-oldest?category=' . request()->get('category') . '&subcategory=' . request()->get('subcategory'))); ?>"
                            <?php echo e(strpos(request()->url(), 'oldest') ? 'selected' : ''); ?>>
                            <?php echo e(trans('labels.oldest')); ?></option>
                        <option class="select-auto-expand__select"
                            data-url="<?php echo e(URL::to(@$vendordata->slug . '/products-best-selling-products?category=' . request()->get('category') . '&subcategory=' . request()->get('subcategory'))); ?>"
                            <?php echo e(strpos(request()->url(), 'best-selling-products') ? 'selected' : ''); ?>>
                            <?php echo e(trans('labels.best_selling_products')); ?></option>
                        <option class="select-auto-expand__select"
                            data-url="<?php echo e(URL::to(@$vendordata->slug . '/products-price-low-high?category=' . request()->get('category') . '&subcategory=' . request()->get('subcategory'))); ?>"
                            <?php echo e(strpos(request()->url(), 'price-low-high') ? 'selected' : ''); ?>>
                            <?php echo e(trans('labels.price_low_high')); ?></option>
                        <option class="select-auto-expand__select"
                            data-url="<?php echo e(URL::to(@$vendordata->slug . '/products-price-high-low?category=' . request()->get('category') . '&subcategory=' . request()->get('subcategory'))); ?>"
                            <?php echo e(strpos(request()->url(), 'price-high-low') ? 'selected' : ''); ?>>
                            <?php echo e(trans('labels.price_high_low')); ?></option>
                    </select>
                </div>
            </div>
        </div>
    </section>
    <section class="mb-5">
        <div class="container">
            <?php if(count($getproductslist) > 0): ?>
                <?php if(helper::appdata(@$vdata)->theme == 1): ?>
                    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 best-product pro-hover">
                        <?php $__currentLoopData = $getproductslist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $getproductdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo $__env->make('web.productcommonview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
                <?php if(helper::appdata(@$vdata)->theme == 2): ?>
                    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 g-4 mb-4">
                        <?php $__currentLoopData = $getproductslist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $getproductdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo $__env->make('web.theme-2.productcomonview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
                <?php if(helper::appdata(@$vdata)->theme == 3): ?>
                    <div class="row row-cols-xl-4 row-cols-lg-3 row-cols-md-2 row-cols-2 g-4">
                        <?php $__currentLoopData = $getproductslist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $getproductdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo $__env->make('web.theme-3.productcomonview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
                <?php if(helper::appdata(@$vdata)->theme == 4): ?>
                    <div class="row row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 row-cols-2 m-0 product-list">
                        <?php $__currentLoopData = $getproductslist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $getproductdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo $__env->make('web.theme-4.productcomonview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
                <?php if(helper::appdata(@$vdata)->theme == 5): ?>
                    <div class="row row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 row-cols-2 g-md-4 g-3">
                        <?php $__currentLoopData = $getproductslist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $getproductdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo $__env->make('web.theme-5.productcomonview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
                <?php if(helper::appdata(@$vdata)->theme == 6): ?>
                    <div class="row row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 row-cols-2 g-md-4 g-3">
                        <?php $__currentLoopData = $getproductslist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $getproductdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo $__env->make('web.theme-6.productcomonview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
                <?php if(helper::appdata(@$vdata)->theme == 7): ?>
                    <div
                        class="row row-cols-2 row-cols-sm-2 row-cols-md-3 row-cols-lg-3 row-cols-xl-4 g-md-4 g-3 theme-7-best-Selling-product">
                        <?php $__currentLoopData = $getproductslist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $getproductdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo $__env->make('web.theme-7.productcomonview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
                <?php if(helper::appdata(@$vdata)->theme == 8): ?>
                    <div
                        class="row row-cols-xl-4 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-2 g-sm-3 g-2 theme-8-best-Selling-product">
                        <?php $__currentLoopData = $getproductslist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $getproductdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo $__env->make('web.theme-8.productcomonview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
                <?php if(helper::appdata(@$vdata)->theme == 9): ?>
                    <div
                        class="row row-cols-xl-4 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-2 g-sm-4 g-3 theme-9-best-Selling-product">
                        <?php $__currentLoopData = $getproductslist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $getproductdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo $__env->make('web.theme-9.productcomonview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
                <?php if(helper::appdata(@$vdata)->theme == 10): ?>
                    <div class="row row-cols-xl-4 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-2 g-sm-4 g-3 theme-10">
                        <?php $__currentLoopData = $getproductslist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $getproductdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo $__env->make('web.theme-10.productcomonview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
                <?php if(helper::appdata(@$vdata)->theme == 11): ?>
                    <div
                        class="row row-cols-xl-4 row-cols-lg-3 row-cols-md-3 row-cols-sm-2 row-cols-2 g-sm-3 g-2 theme-11 theme-11-best-Selling-product">
                        <?php $__currentLoopData = $getproductslist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $getproductdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo $__env->make('web.theme-11.productcomonview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
                <?php if(helper::appdata(@$vdata)->theme == 12): ?>
                    <div
                        class="row row-cols-xl-4 row-cols-lg-3 row-cols-md-3 row-cols-sm-2 row-cols-2 g-sm-3 g-2 theme-12 theme-12-best-Selling-product">
                        <?php $__currentLoopData = $getproductslist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $getproductdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo $__env->make('web.theme-12.productcomonview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
                <?php if(helper::appdata(@$vdata)->theme == 13): ?>
                    <div class="row g-sm-3 g-2 theme-13-best-Selling-product">
                        <?php $__currentLoopData = $getproductslist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $getproductdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo $__env->make('web.theme-13.productcomonview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
                <?php if(helper::appdata(@$vdata)->theme == 14): ?>
                    <div
                        class="row row-cols-xl-4 row-cols-lg-3 row-cols-md-3 row-cols-sm-2 row-cols-2 g-sm-3 g-2 theme-14-best-Selling-product">
                        <?php $__currentLoopData = $getproductslist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $getproductdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo $__env->make('web.theme-14.productcomonview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
                <?php if(helper::appdata(@$vdata)->theme == 15): ?>
                    <div
                        class="row row-cols-xl-4 row-cols-lg-3 row-cols-md-3 row-cols-sm-2 row-cols-2 g-sm-4 g-3 theme-15-best-Selling-product">
                        <?php $__currentLoopData = $getproductslist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $getproductdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo $__env->make('web.theme-15.productcomonview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
                <?php if(helper::appdata(@$vdata)->theme == 16): ?>
                    <div
                        class="row row-cols-xl-4 row-cols-lg-3 theme-16 row-cols-md-3 row-cols-sm-2 row-cols-2 g-3 theme-15-best-Selling-product">
                        <?php $__currentLoopData = $getproductslist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $getproductdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo $__env->make('web.theme-16.productcomonview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
                <?php if(helper::appdata(@$vdata)->theme == 17): ?>
                    <div
                        class="row row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 row-cols-2 g-3 theme-17 theme-5-best-Selling-product">
                        <?php $__currentLoopData = $getproductslist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $getproductdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo $__env->make('web.theme-17.productcomonview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
                <?php if(helper::appdata(@$vdata)->theme == 18): ?>
                    <div
                        class="row row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 row-cols-2 g-3 theme-18 theme-4-best-Selling-product">
                        <?php $__currentLoopData = $getproductslist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $getproductdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo $__env->make('web.theme-18.productcomonview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>

                <?php if(helper::appdata(@$vdata)->theme == 19): ?>
                    <div class="theme-19-product-slider owl-carousel owl-theme">
                        <?php $__currentLoopData = $getproductslist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $getproductdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="item p-1 theme-19 h-100">
                                <?php echo $__env->make('web.theme-19.productcomonview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
                <?php if(helper::appdata(@$vdata)->theme == 20): ?>
                    <div class="top-deals20 owl-carousel owl-theme">
                        <?php $__currentLoopData = $getproductslist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $getproductdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="item p-1 theme-20 h-100">
                                <?php echo $__env->make('web.theme-20.productcomonview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
            <?php else: ?>
                <?php echo $__env->make('web.nodata', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
            <?php echo e($getproductslist->appends(request()->query())->links()); ?>

            <!-- PRODUCTS LIST AREA END -->
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(url(env('ASSETPATHURL') . 'web-assets/js/products.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/web/viewallproducts.blade.php ENDPATH**/ ?>