<?php
    if (Auth::user()->type == 4) {
        $vendor_id = Auth::user()->vendor_id;
    } else {
        $vendor_id = Auth::user()->id;
    }
?>
<?php $__env->startSection('content'); ?>
    <div class="d-flex justify-content-between align-items-center">
        <h5 class="text-capitalize fw-600 text-dark fs-4"><?php echo e(trans('labels.products')); ?></h5>
        <div class="d-flex">
            <a href="<?php echo e(URL::to('admin/products/add')); ?>"
                class="btn btn-secondary px-sm-4 text-capitalize d-flex <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_products', Auth::user()->role_id, Auth::user()->vendor_id, 'add') == 1 ? '' : 'd-none') : ''); ?>">
                <i class="fa-regular fa-plus mx-1"></i><?php echo e(trans('labels.add')); ?>

            </a>
            <?php if($getproductslist->count() > 0): ?>
                <a href="<?php echo e(URL::to('/admin/exportproduct')); ?>"
                    class="btn btn-secondary px-sm-4 d-flex text-capitalize <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_products', Auth::user()->role_id, $vendor_id, 'add') == 1 ? '' : 'd-none') : ''); ?> mx-2"><?php echo e(trans('labels.export')); ?></a>
            <?php endif; ?>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12">
            <div class="card border-0">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered py-3 zero-configuration w-100">
                            <thead>
                                <tr class="text-capitalize fs-15 fw-500">
                                    <td></td>
                                    <td><?php echo e(trans('labels.srno')); ?></td>
                                    <td><?php echo e(trans('labels.image')); ?></td>
                                    <td><?php echo e(trans('labels.category')); ?></td>
                                    <td><?php echo e(trans('labels.name')); ?></td>
                                    <td><?php echo e(trans('labels.price')); ?></td>
                                    <td><?php echo e(trans('labels.stock')); ?></td>
                                    <td><?php echo e(trans('labels.status')); ?></td>
                                    <td><?php echo e(trans('labels.created_date')); ?></td>
                                    <td><?php echo e(trans('labels.updated_date')); ?></td>
                                    <td><?php echo e(trans('labels.action')); ?></td>
                                </tr>
                            </thead>
                            <tbody id="tabledetails" data-url="<?php echo e(url('admin/products/reorder_category')); ?>">
                                <?php $i = 1; ?>
                                <?php $__currentLoopData = $getproductslist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="fs-7 align-middle row1" id="dataid<?php echo e($product->id); ?>" data-id="<?php echo e($product->id); ?>">
                                        <td><a tooltip="<?php echo e(trans('labels.move')); ?>"><i
                                                    class="fa-light fa-up-down-left-right mx-2"></i></a></td>
                                        <td><?php echo $i++; ?></td>
                                        <td>
                                            <?php if($product['product_image'] == null): ?>
                                                <img src="<?php echo e(helper::image_path('product.png')); ?>"
                                                    class="img-fluid rounded hw-50" alt="">
                                            <?php else: ?>
                                                <img src="<?php echo e(@$product['product_image']->image_url); ?>"
                                                    class="img-fluid rounded hw-50" alt="">
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e(@$product['category_info']->name); ?></td>
                                        <td><?php echo e($product->name); ?> <br>
                                            <?php if($product->view_count > 0): ?>
                                                <span class="badge bg-success"><i class="fa-solid fa-eye"></i>
                                                    <?php echo e($product->view_count); ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($product->has_variation == 1): ?>
                                                <span class="badge bg-info"><?php echo e(trans('labels.in_variants')); ?></span><br>
                                            <?php else: ?>
                                                <?php echo e(helper::currency_formate($product->price, $vendor_id)); ?>

                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($product->has_variation == 1): ?>
                                                
                                                    <span
                                                        class="badge bg-info"><?php echo e(trans('labels.in_variants')); ?></span><br>
                                                    <?php if(helper::checklowqty($product->id, $product->vendor_id) == 1): ?>
                                                        <span class="badge bg-warning"><?php echo e(trans('labels.low_qty')); ?></span>
                                                    <?php endif; ?>
                                                
                                            <?php else: ?>
                                                <?php if($product->stock_management == 1): ?>
                                                    <?php if(helper::checklowqty($product->id, $product->vendor_id) == 1): ?>
                                                        <span
                                                            class="badge bg-success"><?php echo e(trans('labels.in_stock')); ?></span><br>
                                                        <span class="badge bg-warning"><?php echo e(trans('labels.low_qty')); ?></span>
                                                    <?php elseif(helper::checklowqty($product->id, $product->vendor_id) == 2): ?>
                                                        <span
                                                            class="badge bg-danger"><?php echo e(trans('labels.out_of_stock')); ?></span>
                                                    <?php elseif(helper::checklowqty($product->id, $product->vendor_id) == 3): ?>
                                                        -
                                                    <?php else: ?>
                                                        <span
                                                            class="badge bg-success"><?php echo e(trans('labels.in_stock')); ?></span>
                                                    <?php endif; ?>
                                                    <?php else: ?>
                                                    -
                                                <?php endif; ?>
                                            <?php endif; ?>

                                        </td>
                                        <td>
                                            <?php if($product->is_available == '1'): ?>
                                                <a tooltip="<?php echo e(trans('labels.active')); ?>"
                                                    <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?>  onclick="statusupdate('<?php echo e(URL::to('admin/products/status_change-' . $product->slug . '/2')); ?>')" <?php endif; ?>
                                                    class="btn btn-sm btn-outline-success hov <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_products', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>"><i
                                                        class="fa-regular fa-check"></i></a>
                                            <?php else: ?>
                                                <a tooltip="<?php echo e(trans('labels.inactive')); ?>"
                                                    <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?> onclick="statusupdate('<?php echo e(URL::to('admin/products/status_change-' . $product->slug . '/1')); ?>')" <?php endif; ?>
                                                    class="btn btn-sm btn-outline-danger hov <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_products', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>"><i
                                                        class="fa-regular fa-xmark"></i></a>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e(helper::date_formate($product->created_at, $product->vendor_id)); ?><br>
                                            <?php echo e(helper::time_formate($product->created_at, $product->vendor_id)); ?>

                                        </td>
                                        <td><?php echo e(helper::date_formate($product->updated_at, $product->vendor_id)); ?><br>
                                            <?php echo e(helper::time_formate($product->updated_at, $product->vendor_id)); ?>

                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a tooltip="<?php echo e(trans('labels.edit')); ?>"
                                                    class="btn btn-info btn-sm hov <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_products', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>"
                                                    href="<?php echo e(URL::to('admin/products/edit-' . $product->slug)); ?>"> <i
                                                        class="fa-regular fa-pen-to-square"></i></a>
                                                <a tooltip="<?php echo e(trans('labels.delete')); ?>"
                                                    class="btn btn-danger btn-sm hov <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_products', Auth::user()->role_id, Auth::user()->vendor_id, 'delete') == 1 ? '' : 'd-none') : ''); ?>"
                                                    <?php if(env('Environment') == 'sendbox'): ?> onclick="myFunction()" <?php else: ?> onclick="statusupdate('<?php echo e(URL::to('admin/products/delete-' . $product->slug)); ?>')" <?php endif; ?>>
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

<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/admin/product/product.blade.php ENDPATH**/ ?>