<?php
    if (Auth::user()->type == 4) {
        $vendor_id = Auth::user()->vendor_id;
    } else {
        $vendor_id = Auth::user()->id;
    }
    $user = App\Models\User::where('id', $vendor_id)->first();
?>
<?php $__env->startSection('content'); ?>
    <div class="d-flex mb-3">
        <h5 class="text-capitalize fw-600 text-dark fs-4"><?php echo e(trans('labels.dashboard_come')); ?></h5>
    </div>
    <div class="row g-3 mb-3">
        <div class="col-xl-6 col-12">
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="card border-0 box-shadow h-100">
                        <div class="card-body">
                            <div class="dashboard-card">
                                <?php if(Auth::user()->type == 1): ?>
                                    <span class="card-icon">
                                        <i class="fa-regular fa-user fs-5"></i>
                                    </span>
                                    <span class="<?php echo e(session()->get('direction') == 2 ? 'text-start' : 'text-end'); ?>">
                                        <p class="text-dark fs-15 fw-500 mb-1"><?php echo e(trans('labels.users')); ?></p>
                                        <h5 class="text-primary fw-600"><?php echo e($totalvendors); ?></h4>
                                    </span>
                                <?php else: ?>
                                    <span class="card-icon">
                                        <i class="fa-solid fa-list-timeline"></i>
                                    </span>
                                    <span class="<?php echo e(session()->get('direction') == 2 ? 'text-start' : 'text-end'); ?>">
                                        <p class="text-dark fs-15 fw-500 mb-1"><?php echo e(trans('labels.products')); ?></p>
                                        <h5 class="text-primary fw-600"><?php echo e($totalvendors); ?></h4>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border-0 box-shadow h-100">
                        <div class="card-body">
                            <div class="dashboard-card">
                                <span class="card-icon">
                                    <i class="fa-regular fa-medal fs-5"></i>
                                </span>
                                <span class="<?php echo e(session()->get('direction') == 2 ? 'text-start' : 'text-end'); ?>">
                                    <?php if(Auth::user()->type == 1): ?>
                                        <p class="text-dark fs-15 fw-500 mb-1"><?php echo e(trans('labels.pricing_plan')); ?></p>
                                        <h5 class="text-primary fw-600"><?php echo e($totalplans); ?></h4>
                                        <?php else: ?>
                                            <p class="text-dark fs-15 fw-500 mb-1"><?php echo e(trans('labels.current_plan')); ?></p>
                                            <?php if(!empty($currentplanname)): ?>
                                                <h5 class="text-primary fw-600"> <?php echo e(@$currentplanname->name); ?> </h4>
                                                <?php else: ?>
                                                    -
                                            <?php endif; ?>
                                    <?php endif; ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border-0 box-shadow h-100">
                        <div class="card-body">
                            <div class="dashboard-card">
                                <span class="card-icon">
                                    <i class="fa-solid fa-ballot-check fs-5"></i>
                                </span>
                                <span class="<?php echo e(session()->get('direction') == 2 ? 'text-start' : 'text-end'); ?>">
                                    <p class="text-dark fs-15 fw-500 mb-1">
                                        <?php echo e(Auth::user()->type == 1 ? trans('labels.transactions') : trans('labels.orders')); ?>

                                    </p>
                                    <h5 class="text-primary fw-600"><?php echo e($totalorders); ?></h4>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border-0 box-shadow h-100">
                        <div class="card-body">
                            <div class="dashboard-card">
                                <span class="card-icon">
                                    <i class="fa-regular fa-money-bill-1-wave fs-5"></i>
                                </span>
                                <span class="<?php echo e(session()->get('direction') == 2 ? 'text-start' : 'text-end'); ?>">
                                    <p class="text-dark fs-15 fw-500 mb-1"><?php echo e(trans('labels.revenue')); ?></p>
                                    <h5 class="text-primary fw-600">
                                        <?php echo e(helper::currency_formate($totalrevenue, $vendor_id)); ?></h4>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-12">
            <div class="card border-0 box-shadow h-100">
                <div class="card-body">

                    <div class="d-flex flex-wrap justify-content-sm-between justify-content-center gap-2">
                        <div
                            class="col-xxl-8 col-xl-7 col-lg-8 col-md-8 col-sm-7 d-flex flex-column gap-2 justify-content-center align-items-start">
                            <h5 class="text-dark fw-600 d-flex gap-2 align-items-center">
                                <img src="<?php echo e(helper::image_path(Auth::user()->image)); ?>"
                                    class="object border rounded-circle dasbord-img" alt="">
                                <small class="text-dark"><?php echo e(Auth::user()->name); ?></small>
                            </h5>
                            <p class="text-muted fs-7 m-0 line-3"><?php echo e(trans('labels.dashboard_description')); ?></p>
                            <div class="dropdown">
                                <a class="btn btn-secondary fs-7 text-light fw-500 dropdown-toggle" href="#"
                                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-regular fa-plus"></i> <?php echo e(trans('labels.quick_add')); ?>

                                </a>
                                <?php if(Auth::user()->type == 2 || Auth::user()->type == 4): ?>
                                    <ul class="dropdown-menu fw-500 fs-7 text-dark">
                                        <li><a class="dropdown-item py-2"
                                                href="<?php echo e(URL::to('/admin/products')); ?>"><?php echo e(trans('labels.products')); ?></a>
                                        </li>
                                        <li><a class="dropdown-item py-2"
                                                href="<?php echo e(URL::to('/admin/categories')); ?>"><?php echo e(trans('labels.categories')); ?>

                                            </a></li>
                                        <li><a class="dropdown-item py-2"
                                                href="<?php echo e(URL::to('/admin/basic_settings')); ?>"><?php echo e(trans('labels.basic_settings')); ?></a>
                                        </li>
                                    </ul>
                                <?php else: ?>
                                    <ul class="dropdown-menu fw-500 fs-7 text-dark">
                                        <li><a class="dropdown-item py-2"
                                                href="<?php echo e(URL::to('admin/users')); ?>"><?php echo e(trans('labels.users')); ?></a>
                                        </li>
                                        <li><a class="dropdown-item py-2"
                                                href="<?php echo e(URL::to('admin/plan')); ?>"><?php echo e(trans('labels.pricing_plan')); ?>

                                            </a></li>
                                        <li><a class="dropdown-item py-2"
                                                href="<?php echo e(URL::to('/admin/basic_settings')); ?>"><?php echo e(trans('labels.basic_settings')); ?></a>
                                        </li>
                                    </ul>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php if(Auth::user()->type == 2 || Auth::user()->type == 4): ?>
                            <div
                                class="col-xxl-3 col-xl-4 mt-2 mt-sm-0 col-lg-3 col-md-3 col-sm-5 gap-2 d-flex flex-column justify-content-center align-items-center">
                                <img src="https://qrcode.tec-it.com/API/QRCode?data=<?php echo e(URL::to('/' . $user->slug)); ?>&choe=UTF-8"
                                    class="object quer-code" alt="">
                                <div class="d-flex mt-sm-2">
                                    <input type="hidden" value="<?php echo e(URL::to('/' . $user->slug)); ?>" id="myInput"
                                        class="form-control rounded-0" readonly>
                                    <button class="btn btn-primary fw-500 fs-7" id="copyButton"
                                        onclick="setClipboard('<?php echo e(URL::to('/' . $user->slug)); ?>')">
                                        <i class="fa-regular fa-clone"></i> <?php echo e(trans('labels.copy')); ?>

                                    </button>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-md-8 mb-3">
            <div class="card border-0 box-shadow h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3 border-bottom pb-3 justify-content-between">
                        <h5 class="card-title m-0"><?php echo e(trans('labels.revenue')); ?></h5>
                        <select class="form-select form-select-sm w-auto" id="revenueyear"
                            data-url="<?php echo e(URL::to('/admin/dashboard')); ?>">
                            <?php if(!in_array(date('Y'), array_column($revenue_years->toArray(), 'year'))): ?>
                                <option value="<?php echo e(date('Y')); ?>" selected><?php echo e(date('Y')); ?></option>
                            <?php endif; ?>
                            <?php $__empty_1 = true; $__currentLoopData = $revenue_years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $revenue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <option value="<?php echo e($revenue->year); ?>" <?php echo e(date('Y') == $revenue->year ? 'selected' : ''); ?>>
                                    <?php echo e($revenue->year); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <option value="" selected disabled><?php echo e(trans('labels.select')); ?></option>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="row">
                        <canvas id="revenuechart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card border-0 box-shadow h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3 pb-3 border-bottom">
                        <h5 class="card-title m-0">
                            <?php if(Auth::user()->type == 1): ?>
                                <?php echo e(trans('labels.users')); ?>

                            <?php else: ?>
                                <?php echo e(trans('labels.orders')); ?>

                            <?php endif; ?>
                        </h5>
                        <select class="form-select form-select-sm w-auto" id="doughnutyear"
                            data-url="<?php echo e(request()->url()); ?>">
                            <?php if(!in_array(date('Y'), array_column($doughnut_years->toArray(), 'year'))): ?>
                                <option value="<?php echo e(date('Y')); ?>" selected><?php echo e(date('Y')); ?></option>
                            <?php endif; ?>
                            <?php $__empty_1 = true; $__currentLoopData = $doughnut_years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $useryear): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <option value="<?php echo e($useryear->year); ?>"
                                    <?php echo e(date('Y') == $useryear->year ? 'selected' : ''); ?>><?php echo e($useryear->year); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <option value="" selected disabled><?php echo e(trans('labels.select')); ?></option>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="row">
                        <canvas id="doughnut"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if(Auth::user()->type != 1): ?>
        <?php
            $ran = [
                'gradient-1',
                'gradient-2',
                'gradient-3',
                'gradient-4',
                'gradient-5',
                'gradient-6',
                'gradient-7',
                'gradient-8',
                'gradient-9',
            ];
        ?>
        <div class="row g-3 mb-3">
            <div class="col-xl-6">
                <div class="card border-0 box-shadow h-100">
                    <div class="card-body">
                        <h5 class="card-title pb-3 border-bottom">Top Products</h5>
                        <div class="table-responsive" id="table-items">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="fs-15 fw-500"><?php echo e(trans('labels.image')); ?></th>
                                        <th class="fs-15 fw-500"><?php echo e(trans('labels.item_name')); ?></th>
                                        <th class="fs-15 fw-500"><?php echo e(trans('labels.category')); ?></th>
                                        <th class="fs-15 fw-500"><?php echo e(trans('labels.orders')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(count($topitems) > 0): ?>
                                        <?php $__currentLoopData = @$topitems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr class="fs-7 fw-500 text-dark align-middle">
                                                <td>
                                                    <img src="<?php echo e(Helper::image_path($row['product_image']->image)); ?>"
                                                        class="rounded hw-50 object" alt="">
                                                </td>
                                                <td>
                                                    <a
                                                        href="<?php echo e(URL::to('admin/products/edit-' . $row->slug)); ?>"><?php echo e($row->name); ?></a>
                                                </td>
                                                <td><?php echo e(@$row['category_info']->name); ?></td>
                                                <td>
                                                    <?php
                                                        $per =
                                                            $getorderdetailscount > 0
                                                                ? ($row->item_order_counter * 100) /
                                                                    $getorderdetailscount
                                                                : 0;
                                                    ?>
                                                    <?php echo e(number_format($per, 2)); ?>%
                                                    <div class="progress h-10-px">
                                                        <div class="progress-bar gradient-6 <?php echo e($ran[array_rand($ran, 1)]); ?>"
                                                            style="width: <?php echo e($per); ?>%;" role="progressbar">
                                                            <span class="sr-only"><?php echo e($per); ?>%
                                                                <?php echo e(trans('labels.orders')); ?></span>
                                                        </div>
                                                    </div>
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
            <div class="col-xl-6">
                <div class="card border-0 box-shadow h-100">
                    <div class="card-body">
                        <h5 class="card-title pb-3 border-bottom">Top Customers</h5>
                        <div class="table-responsive" id="table-users">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="fs-15 fw-500"><?php echo e(trans('labels.image')); ?></th>
                                        <th class="fs-15 fw-500"><?php echo e(trans('labels.name')); ?></th>
                                        <th class="fs-15 fw-500"><?php echo e(trans('labels.email')); ?></th>
                                        <th class="fs-15 fw-500"><?php echo e(trans('labels.orders')); ?></th>
                                    </tr>
                                </thead>
                                <?php $i = 1; ?>
                                <?php if(count($topusers) > 0): ?>
                                    <?php $__currentLoopData = @$topusers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr class="fs-7 fw-500 text-dark align-middle">
                                            <td>
                                                <img src="<?php echo e(Helper::image_path($user->image)); ?>"
                                                    class="rounded hw-50 object" alt="">
                                            </td>
                                            <td>
                                                <div class="fs-7 fw-500">
                                                    <p><?php echo e($user->name); ?></p>
                                                    <p><?php echo e($user->mobile); ?></p>
                                                </div>
                                            </td>
                                            <td>
                                                <?php echo e($user->email); ?>

                                            </td>
                                            <td>
                                                <?php echo e(number_format($per, 2)); ?>%
                                                <div class="progress h-10-px">
                                                    <div class="progress-bar <?php echo e($ran[array_rand($ran, 1)]); ?>"
                                                        style="width: <?php echo e($per); ?>%;" role="progressbar">
                                                        <span class="sr-only"><?php echo e($per); ?>%
                                                            <?php echo e(trans('labels.orders')); ?></span>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <div class="row">
        <div class="col-12">
            <div class="card border-0 my-3">
                <div class="card-body">
                    <h5 class="card-title text-capitalize mb-3 pb-3 border-bottom">
                        <?php echo e(Auth::user()->type == 1 ? trans('labels.today_transaction') : trans('labels.today_orders')); ?>

                    </h5>
                    <div class="table-responsive">
                        <?php if(Auth::user()->type == 1): ?>
                            <?php echo $__env->make('admin.dashboard.admintransaction', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php else: ?>
                            <?php echo $__env->make('admin.orders.orderstable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <!--- Admin -------- users-chart-script --->
    <!--- VendorAdmin -------- orders-count-chart-script --->
    <script type="text/javascript">
        var doughnut = null;
        var doughnutlabels = <?php echo e(Js::from($doughnutlabels)); ?>;
        var doughnutdata = <?php echo e(Js::from($doughnutdata)); ?>;
    </script>
    <!--- Admin ------ revenue-by-plans-chart-script --->
    <!--- vendorAdmin ------ revenue-by-orders-script --->
    <script type="text/javascript">
        var revenuechart = null;
        var labels = <?php echo e(Js::from($revenuelabels)); ?>;
        var revenuedata = <?php echo e(Js::from($revenuedata)); ?>;

        function setClipboard(value) {
            var tempInput = document.createElement("input");
            tempInput.style = "position: absolute; left: -1000px; top: -1000px";
            tempInput.value = value;
            document.body.appendChild(tempInput);
            tempInput.select();
            document.execCommand("copy");
            document.body.removeChild(tempInput);
            toastr.success("<?php echo e(session('success')); ?>", "Success");
        }
    </script>
    <script src="<?php echo e(url(env('ASSETPATHURL') . 'admin-assets/js/dashboard.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/admin/dashboard/index.blade.php ENDPATH**/ ?>