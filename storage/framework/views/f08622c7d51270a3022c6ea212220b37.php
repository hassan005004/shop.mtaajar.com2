<footer>
    <div class="footer-bg-color overflow-hidden">
        <div class="container footer-container">
            <div class="footer-contain row row-cols-md-4">
                <div class="col-md-4 col-lg-4 mt-4 me-auto">
                    <div>
                        <a href="<?php echo e(URL::to('/')); ?>">
                            <img src="<?php echo e(helper::image_path(helper::appdata('')->logo)); ?>" height="50" alt="">
                        </a>
                        <p class="footer-contain mt-4 col-lg-10">
                            <?php echo e(trans('landing.footer_description')); ?>

                        </p>
                    </div>
                </div>
                <div class="col-md-8 col-lg-8">
                    <div class="row">
                        <div class="col-md-4 col-lg-4 col-xl-4 footer-contain">
                            <div>
                                <p class="footer-title mb-2 mt-4"><?php echo e(trans('landing.pages')); ?></p>
                                <p class="py-1 fs-7"><a
                                        href="<?php echo e(URL::to('/aboutus')); ?>"><?php echo e(trans('landing.about_us')); ?></a></p>
                                <p class="py-1 fs-7"><a
                                        href="<?php echo e(URL::to('/privacypolicy')); ?>"><?php echo e(trans('landing.privacy_policy')); ?></a>
                                </p>
                                <p class="py-1 fs-7"><a
                                        href="<?php echo e(URL::to('/refund_policy')); ?>"><?php echo e(trans('landing.refund_policy')); ?></a>
                                </p>
                                <p class="py-1 fs-7"><a
                                        href="<?php echo e(URL::to('/termscondition')); ?>"><?php echo e(trans('landing.terms_conditions')); ?></a>
                                </p>


                            </div>
                        </div>
                        <div class="col-md-3 col-lg-3 col-xl-4 footer-contain">
                            <div>
                                <p class="footer-title mb-2 mt-4"><?php echo e(trans('landing.other')); ?></p>
                                <?php if(@helper::checkaddons('blog')): ?>
                                    <p class="py-1 fs-7"><a
                                            href="<?php echo e(URL::to('/blogs')); ?>"><?php echo e(trans('landing.blogs')); ?></a></p>
                                <?php endif; ?>
                                <p class="py-1 fs-7"><a href="<?php echo e(URL::to('/faqs')); ?>"><?php echo e(trans('landing.faqs')); ?></a>
                                </p>
                                <?php if(@helper::checkaddons('subscription')): ?>
                                    <p class="py-1 fs-7"><a
                                            href="<?php echo e(URL::to('/stores')); ?>"><?php echo e(trans('landing.our_stors')); ?></a></p>
                                <?php endif; ?>
                                <p class="py-1 fs-7"><a
                                        href="<?php echo e(URL::to('/contact')); ?>"><?php echo e(trans('landing.contact_us')); ?></a></p>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-5 col-xl-4 footer-contain">
                            <div>
                                <p class="footer-title mb-2 mt-4"><?php echo e(trans('landing.help')); ?></p>
                                <p class="py-1 fs-7"><a href="mailto:<?php echo e(helper::appdata('')->email); ?>"><i
                                            class="fa-solid fa-envelope <?php echo e(session()->get('direction') == 2 ? 'ps-2' : 'pe-2'); ?>"></i><?php echo e(helper::appdata('')->email); ?></a>
                                </p>
                                <p class="py-1 fs-7"><a href="tel:<?php echo e(helper::appdata('')->contact); ?>"><i
                                            class="fa-solid fa-phone <?php echo e(session()->get('direction') == 2 ? 'ps-2' : 'pe-2'); ?>"></i><?php echo e(helper::appdata('')->contact); ?></a>
                                </p>
                                <p class="py-1 fs-7"><a href="tel:<?php echo e(helper::appdata('')->address); ?>"><i
                                            class="fa-solid fa-location-dot <?php echo e(session()->get('direction') == 2 ? 'ps-2' : 'pe-2'); ?>"></i><?php echo e(helper::appdata('')->address); ?></a>
                                </p>

                                <div class="d-md-none d-lg-none d-xl-none d-xll-none">
                                    <div
                                        class="icon-flex col-md-2 pt-2 d-flex align-items-center justify-content-center">
                                        <?php if(helper::appdata('')->facebook_link != null): ?>
                                            <p class="footer-btn">
                                                <button class="border-0 rounded-circle  shadow-lg">
                                                    <a href="<?php echo e(helper::appdata('')->facebook_link); ?>"
                                                        class="icon-name"><i
                                                            class="fa-brands fa-facebook-f fs-6 text-dark"></i></a>
                                                </button>
                                            </p>
                                        <?php endif; ?>
                                        <?php if(helper::appdata('')->instagram_link != null): ?>
                                            <p class="footer-btn">
                                                <button class="border-0 shadow-lg">
                                                    <a href="<?php echo e(helper::appdata('')->instagram_link); ?>"
                                                        class="icon-name"><i
                                                            class="fa-brands fa-instagram text-dark"></i></a>
                                                </button>
                                            </p>
                                        <?php endif; ?>
                                        <?php if(helper::appdata('')->twitter_link != null): ?>
                                            <p class="footer-btn">
                                                <button class="border-0 shadow-lg">
                                                    <a href="<?php echo e(helper::appdata('')->twitter_link); ?>"
                                                        class="icon-name"><i
                                                            class="fa-brands fa-twitter text-dark"></i></a>
                                                </button>
                                            </p>
                                        <?php endif; ?>
                                        <?php if(helper::appdata('')->linkedin_link != null): ?>
                                            <p class="footer-btn">
                                                <button class="border-0 shadow-lg">
                                                    <a href="<?php echo e(helper::appdata('')->linkedin_link); ?>"
                                                        class="icon-name"><i
                                                            class="fa-brands fa-linkedin-in text-dark"></i></a>
                                                </button>
                                            </p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!------ whatsapp_icon ------>
            <?php if(@helper::checkaddons('whatsapp_message')): ?>
                <?php if(helper::appdata('')->whatsapp_chat_on_off == 1): ?>
                    <?php if(helper::appdata('')->whatsapp_number != null && helper::appdata('')->whatsapp_number != ''): ?>
                        <input type="checkbox" id="check" class="d-none">
                        <label
                            class="chat-btn <?php echo e(helper::appdata('')->whatsapp_chat_position == 1 ? 'chat-btn_rtl' : 'chat-btn_ltr'); ?>"
                            for="check">
                            <i class="fa-brands fa-whatsapp comment"></i>
                            <i class="fa fa-close close"></i>
                        </label>
                        <div
                            class="shadow <?php echo e(helper::appdata('')->whatsapp_chat_position == 1 ? 'wrapper_rtl' : 'wrapper'); ?>">
                            <div class="msg_header">
                                <h6><?php echo e(helper::appdata('')->website_title); ?></h6>
                            </div>

                            <div class="text-start p-3 bg-msg">
                                <div class="card p-2 msg d-inline-block fs-7">
                                    <?php echo e(trans('labels.how_can_help_you')); ?>

                                </div>
                            </div>

                            <div class="chat-form">

                                <form action="https://api.whatsapp.com/send" method="get" target="_blank"
                                    class="d-flex align-items-center d-grid gap-2">
                                    <textarea class="form-control fs-7 m-0" name="text" placeholder="Your Text Message" cols="30" rows="10"
                                        required></textarea>
                                    <input type="hidden" name="phone"
                                        value="<?php echo e(helper::appdata('')->whatsapp_number); ?>">
                                    <button type="submit" class="btn btn-whatsapp btn-block m-0">
                                        <i class="fa-solid fa-paper-plane"></i>
                                    </button>
                                </form>

                            </div>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endif; ?>
            <hr class="text-white mt-5">
            <div class="d-md-flex justify-content-between align-items-center pb-2">
                <h5 class="copy-right-text m-0"><?php echo e(helper::appdata('')->copyright); ?></h5>
                <ul class="footer_acceped_card d-flex flex-wrap justify-content-center gap-2 p-0 m-0 mt-3 mt-md-0">
                    <?php $__currentLoopData = helper::paymentlist(1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <a href="#">
                                <img src="<?php echo e(helper::image_path($item->image)); ?>" class="w-20px">
                            </a>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        </div>
    </div>
</footer>
<?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/landing/layout/footer.blade.php ENDPATH**/ ?>