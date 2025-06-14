<?php $__env->startSection('content'); ?>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="text-capitalize fw-600 text-dark fs-4"><?php echo e(trans('labels.share')); ?></h5>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card border-0 box-shadow">
                <div class="card-body">
                    <div class="card-block text-center">
                        <img src="https://qrcode.tec-it.com/API/QRCode?data=<?php echo e(URL::to('/' . $user->slug)); ?>&choe=UTF-8"
                            width="230px" />
                        <div class="card-block mt-3">
                            <button class="btn btn-secondary" onclick="myFunction()"><?php echo e(trans('labels.share')); ?> <i
                                    class="fa-sharp fa-solid fa-share-nodes ms-2"></i></button>
                            <a href="https://qrcode.tec-it.com/API/QRCode?data=<?php echo e(URL::to('/' . $user->slug)); ?>&choe=UTF-8"
                                target="_blank" class="btn btn-secondary"><?php echo e(trans('labels.download')); ?> <i
                                    class="fa-solid fa-arrow-down-to-line ms-2"></i></a>
                            <div id="share-icons" class="d-none">
                                <?php echo $shareComponent; ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script>
        function myFunction() {
            $('#share-icons').toggleClass('d-none');
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/admin/other/share.blade.php ENDPATH**/ ?>