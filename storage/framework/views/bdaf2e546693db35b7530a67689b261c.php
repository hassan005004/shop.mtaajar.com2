<ul class="main-menu">

    <li><a href="<?php echo e(URL::to(@$vendordata->slug . '/')); ?>"
            class="<?php echo e(request()->is(@$vendordata->slug) ? 'active' : ''); ?> <?php echo e(request()->is('/') ? 'active' : ''); ?>"><?php echo e(trans('labels.home')); ?></a>
    </li>

    <li><a href="<?php echo e(URL::to(@$vendordata->slug . '/shop_all')); ?>"
            class="<?php echo e(request()->is(@$vendordata->slug . '/shop_all') ? 'active' : ''); ?> <?php echo e(request()->is('shop_all') ? 'active' : ''); ?>"><?php echo e(trans('labels.shop_all')); ?></a>
    </li>
    <li><a href="<?php echo e(URL::to(@$vendordata->slug . '/categories')); ?>"
            class="<?php echo e(request()->is(@$vendordata->slug . '/categories*') || request()->is(@$vendordata->slug . '/products') ? 'active' : ''); ?> <?php echo e(request()->is('categories*') ? 'active' : ''); ?> <?php echo e(request()->is('products') ? 'active' : ''); ?>"><?php echo e(trans('labels.categories')); ?></a>
    </li>

    <li><a href="<?php echo e(URL::to(@$vendordata->slug . '/aboutus')); ?>"
            class="<?php echo e(request()->is(@$vendordata->slug . '/aboutus') ? 'active' : ''); ?> <?php echo e(request()->is('aboutus') ? 'active' : ''); ?>"><?php echo e(trans('labels.about_us')); ?></a>
    </li>

    <li><a href="<?php echo e(URL::to(@$vendordata->slug . '/gallery')); ?>"
            class="<?php echo e(request()->is(@$vendordata->slug . '/gallery') ? 'active' : ''); ?> <?php echo e(request()->is('gallery') ? 'active' : ''); ?>"><?php echo e(trans('labels.gallery')); ?></a>
    </li>
    <?php if(@helper::checkaddons('subscription')): ?>
        <?php if(@helper::checkaddons('blog')): ?>
            <?php
                $checkplan = App\Models\Transaction::where('vendor_id', @$vdata)
                    ->orderByDesc('id')
                    ->first();
                $user = App\Models\User::where('id', @$vdata)->first();
                if (@$user->allow_without_subscription == 1) {
                    $blogs = 1;
                } else {
                    $blogs = @$checkplan->blogs;
                }
            ?>
            <?php if($blogs == 1): ?>
                <li><a href="<?php echo e(URL::to(@$vendordata->slug . '/blogs')); ?>"
                        class="<?php echo e(request()->is(@$vendordata->slug . '/blogs*') ? 'active' : ''); ?> <?php echo e(request()->is('blogs*') ? 'active' : ''); ?>"><?php echo e(trans('labels.blog')); ?></a>
                </li>
            <?php endif; ?>
        <?php endif; ?>
    <?php else: ?>
        <?php if(@helper::checkaddons('blog')): ?>
            <li><a href="<?php echo e(URL::to(@$vendordata->slug . '/blogs')); ?>"
                    class="<?php echo e(request()->is(@$vendordata->slug . '/blogs*') ? 'active' : ''); ?> <?php echo e(request()->is('blogs*') ? 'active' : ''); ?>"><?php echo e(trans('labels.blog')); ?></a>
            </li>
        <?php endif; ?>
    <?php endif; ?>


    <li><a href="<?php echo e(URL::to(@$vendordata->slug . '/contact-us')); ?>"
            class="<?php echo e(request()->is(@$vendordata->slug . '/contact-us') ? 'active' : ''); ?> <?php echo e(request()->is('contact-us') ? 'active' : ''); ?>"><?php echo e(trans('labels.help_contact')); ?></a>
    </li>

    <li><a href="<?php echo e(URL::to(@$vendordata->slug . '/find-order')); ?>"
            class="<?php echo e(request()->is(@$vendordata->slug . '/find-order*') ? 'active' : ''); ?> <?php echo e(request()->is('find-order*') ? 'active' : ''); ?>"><?php echo e(trans('labels.find_my_order')); ?></a>
    </li>

</ul>
<?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/web/layout/common_menulist.blade.php ENDPATH**/ ?>