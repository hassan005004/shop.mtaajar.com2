<?php $__env->startSection('content'); ?>
    <div class="d-flex justify-content-between align-items-center">
        <h5 class="text-capitalize fw-600 text-dark fs-4"><?php echo e(trans('labels.pricing_plan')); ?></h5>
        <?php if(Auth::user()->type == '1'): ?>
            <a href="<?php echo e(URL::to('admin/plan/add')); ?>" class="btn btn-secondary px-sm-4 d-flex"> <i
                    class="fa-regular fa-plus mx-1"></i><?php echo e(trans('labels.add')); ?> </a>
        <?php endif; ?>
    </div>

    <div class="row g-3 pt-4 <?php echo e(Auth::user()->type == 1 ? 'sort_menu' : ''); ?>" id="carddetails"
        data-url="<?php echo e(url('admin/plan/reorder_plan')); ?>">
        <?php if(count($allplan) > 0): ?>
            <?php $__currentLoopData = $allplan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plandata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    if (Auth::user()->type == 4) {
                        $vendor_id = Auth::user()->vendor_id;
                        $plan = helper::getplantransaction(Auth::user()->vendor_id);
                        $plan_id = $plan->plan_id;
                        $purchase_amount = $plan->amount;
                    } else {
                        $vendor_id = Auth::user()->id;
                        $plan_id = Auth::user()->plan_id;
                        $purchase_amount = Auth::user()->purchase_amount;
                    }
                    $check_vendorplan = helper::checkplan($vendor_id, '');
                    $data = json_decode(json_encode($check_vendorplan), true);
                ?>
                <?php if(Auth::user()->type == 2 || Auth::user()->type == 4): ?>
                    <?php if($plandata->vendor_id != '' && $plandata->vendor_id != null): ?>
                        <?php if(in_array($vendor_id, explode('|', $plandata->vendor_id))): ?>
                            <?php echo $__env->make('admin.plan.plancommon', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endif; ?>
                    <?php else: ?>
                        <?php echo $__env->make('admin.plan.plancommon', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endif; ?>
                <?php else: ?>
                    <?php echo $__env->make('admin.plan.plancommon', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <?php echo $__env->make('admin.layout.no_data', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
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

        });

        function themeinfo(id, theme_id, plan_name) {
            let string = theme_id;
            let arr = string.split('|');
            $('#themeinfoLabel').text(plan_name);
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                url: "<?php echo e(URL::to('admin/themeimages')); ?>",
                method: 'GET',
                data: {
                    theme_id: arr
                },
                dataType: 'json',
                success: function(data) {
                    $('#theme_modalbody').html(data.output);
                    $('#themeinfo').modal('show');
                }
            })
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/admin/plan/plan.blade.php ENDPATH**/ ?>