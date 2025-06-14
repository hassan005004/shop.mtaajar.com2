<?php $__env->startSection('contents'); ?>
    <!-- BREADCRUMB AREA START -->
    <section class="py-4 mb-4 bg-light">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="<?php echo e(session()->get('direction') == 2 ? 'breadcrumb-item-rtl' : ' breadcrumb-item '); ?>"><a
                            class="text-dark fw-600"
                            href="<?php echo e(URL::to(@$vendordata->slug . '/')); ?>"><?php echo e(trans('labels.home')); ?></a>
                    </li>
                    <li class="text-muted <?php echo e(session()->get('direction') == 2 ? 'breadcrumb-item-rtl' : ' breadcrumb-item '); ?> active"
                        aria-current="page"><?php echo e(trans('labels.faqs')); ?></li>
                </ol>
            </nav>
        </div>
    </section>
    <!-- BREADCRUMB AREA END -->
    <section class="my-5">
        <div class="container">
            <?php if($faqs->count() > 0): ?>
                <div class="accordion faq-accordion" id="accordionExample">
                    <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="accordion-item mb-3 border">
                            <h2 class="accordion-header">
                                <button
                                    class="accordion-button fw-600 fs-16 justify-content-between m-0 text-dark <?php echo e($key != 0 ? 'collapsed' : ''); ?> <?php echo e(session()->get('direction') == 2 ? 'rtl' : ''); ?>"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo e($key); ?>"
                                    aria-expanded="true" aria-controls="collapse<?php echo e($key); ?>">
                                    <?php echo e($faq->question); ?>

                                </button>
                            </h2>
                            <div id="collapse<?php echo e($key); ?>"
                                class="accordion-collapse collapse rounded <?php echo e($key == 0 ? 'show' : ''); ?>"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p class="fs-7"><?php echo e($faq->answer); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                </div>
            <?php else: ?>
                <?php echo $__env->make('web.nodata', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>

        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/web/faq.blade.php ENDPATH**/ ?>