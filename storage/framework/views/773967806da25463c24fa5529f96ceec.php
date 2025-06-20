<div id="whatsapp">
    <div class="row mb-5">
        <div class="col-12">
            <div class="card border-0 box-shadow">
                <div class="card-header p-3 bg-secondary">
                    <h5 class="text-capitalize fw-600">
                        <?php echo e(trans('labels.whatsapp_message_settings')); ?>

                    </h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="<?php echo e(URL::to('admin/whatsappmessage  ')); ?>" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-4">
                                <h5 class="text-center">
                                    <?php echo e(trans('labels.order_variable')); ?>

                                </h5>
                                <hr>
                                <p class="mb-1"><?php echo e(trans('labels.order_number')); ?> :
                                    <span class="pull-right text-primary">{order_no}</span>
                                </p>
                                <p class="mb-1"><?php echo e(trans('labels.item_variable')); ?> :
                                    <span class="pull-right text-primary">{item_variable}</span>
                                </p>
                                <p class="mb-1"><?php echo e(trans('labels.sub_total')); ?> : <span
                                        class="pull-right text-primary">{sub_total}</span>
                                </p>
                                <p class="mb-1"><?php echo e(trans('labels.total_tax')); ?> : <span
                                        class="pull-right text-primary">{total_tax}</span>
                                </p>
                                <p class="mb-1"><?php echo e(trans('labels.delivery_charge')); ?>:
                                    <span class="pull-right text-primary">{delivery_charge}</span>
                                </p>
                                <p class="mb-1"><?php echo e(trans('labels.discount_amount')); ?> :
                                    <span class="pull-right text-primary">{discount_amount}</span>
                                </p>
                                <p class="mb-1"><?php echo e(trans('labels.grand_total')); ?> :
                                    <span class="pull-right text-primary">{grand_total}</span>
                                </p>
                                <p class="mb-1"><?php echo e(trans('labels.notes')); ?> : <span
                                        class="pull-right text-primary">{notes}</span>
                                </p>
                                <p class="mb-1"><?php echo e(trans('labels.customer_name')); ?> :
                                    <span class="pull-right text-primary">{customer_name}</span>
                                </p>
                                <p class="mb-1"><?php echo e(trans('labels.customer_email')); ?> :
                                    <span class="pull-right text-primary">{customer_email}</span>
                                </p>
                                <p class="mb-1"><?php echo e(trans('labels.customer_mobile')); ?> :
                                    <span class="pull-right text-primary">{customer_mobile}</span>
                                </p>
                                <p class="mb-1"><?php echo e(trans('labels.payment_type')); ?> :
                                    <span class="pull-right text-primary">{payment_type}</span>
                                </p>
                                <p class="mb-1"><?php echo e(trans('labels.store_name')); ?> :
                                    <span class="pull-right text-primary">{store_name}</span>
                                </p>
                                <p class="mb-1"><?php echo e(trans('labels.track_order_url')); ?> :
                                    <span class="pull-right text-primary">{track_order_url}</span>
                                </p>
                                <p class="mb-1"><?php echo e(trans('labels.store_url')); ?>: <span
                                        class="pull-right text-primary">{store_url}</span>
                                </p>
                            </div>
                            <div class="col-8">
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="text-center">
                                            <?php echo e(trans('labels.billing_info')); ?>

                                        </h5>
                                        <hr>
                                        <p class="mb-1"><?php echo e(trans('labels.address')); ?> :
                                            <span class="pull-right text-primary">{billing_address}</span>
                                        </p>
                                        <p class="mb-1"><?php echo e(trans('labels.landmark')); ?>

                                            : <span class="pull-right text-primary">{billing_landmark}</span>
                                        </p>
                                        <p class="mb-1">
                                            <?php echo e(trans('labels.postal_code')); ?> : <span
                                                class="pull-right text-primary">{billing_postal_code}</span>
                                        </p>
                                        <p class="mb-1"><?php echo e(trans('labels.city')); ?> :
                                            <span class="pull-right text-primary">{billing_city}</span>
                                        </p>
                                        <p class="mb-1"><?php echo e(trans('labels.state')); ?> :
                                            <span class="pull-right text-primary">{billing_state}</span>
                                        </p>
                                        <p class="mb-1"><?php echo e(trans('labels.country')); ?> :
                                            <span class="pull-right text-primary">{billing_country}</span>
                                        </p>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="text-center">
                                            <?php echo e(trans('labels.shipping_info')); ?>

                                        </h5>
                                        <hr>
                                        <p class="mb-1"><?php echo e(trans('labels.address')); ?> :
                                            <span class="pull-right text-primary">{shipping_address}</span>
                                        </p>
                                        <p class="mb-1"><?php echo e(trans('labels.landmark')); ?>

                                            : <span class="pull-right text-primary">{shipping_landmark}</span>
                                        </p>
                                        <p class="mb-1">
                                            <?php echo e(trans('labels.postal_code')); ?> : <span
                                                class="pull-right text-primary">{shipping_postal_code}</span>
                                        </p>
                                        <p class="mb-1"><?php echo e(trans('labels.city')); ?> :
                                            <span class="pull-right text-primary">{shipping_city}</span>
                                        </p>
                                        <p class="mb-1"><?php echo e(trans('labels.state')); ?> :
                                            <span class="pull-right text-primary">{shipping_state}</span>
                                        </p>
                                        <p class="mb-1"><?php echo e(trans('labels.country')); ?> :
                                            <span class="pull-right text-primary">{shipping_country}</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="row d-flex justify-content-end mt-2">
                                    <div class="col-6">
                                        <h5 class="text-center">
                                            <?php echo e(trans('labels.item_variable')); ?>

                                        </h5>
                                        <hr>
                                        <p class="mb-1"><?php echo e(trans('labels.item_name')); ?>

                                            :
                                            <span class="pull-right text-primary">{item_name}</span>
                                        </p>
                                        <p class="mb-1"><?php echo e(trans('labels.qty')); ?> :
                                            <span class="pull-right text-primary">{qty}</span>
                                        </p>
                                        <p class="mb-1"><?php echo e(trans('labels.variants')); ?>

                                            :
                                            <span class="pull-right text-primary">{variantsdata}</span>
                                        </p>
                                        <p class="mb-1">
                                            <?php echo e(trans('labels.item_price')); ?> :
                                            <span class="pull-right text-primary">{item_price}</span>
                                        </p>
                                        <input type="text" name="item_message" class="form-control"
                                            placeholder="<?php echo e(trans('labels.item_message')); ?>"
                                            value="<?php echo e(@$settingdata->item_message); ?>" required>
                                        <?php $__errorArgs = ['item_message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger" id="timezone_error"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label fw-bold"><?php echo e(trans('labels.whatsapp_message')); ?>

                                        <span class="text-danger"> * </span> </label>
                                    <textarea class="form-control" required="required" name="whatsapp_message" cols="50" rows="10"><?php echo e(@$settingdata->whatsapp_message); ?></textarea>
                                    <?php $__errorArgs = ['whatsapp_message'];
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
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label"><?php echo e(trans('labels.whatsapp_number')); ?><span
                                            class="text-danger"> * </span></label>
                                    <input type="text" class="form-control numbers_only" name="whatsapp_number"
                                        value="<?php echo e(@$settingdata->whatsapp_number); ?>"
                                        placeholder="<?php echo e(trans('labels.whatsapp_number')); ?>" required>
                                    <?php $__errorArgs = ['whatsapp_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <small class="text-danger"><?php echo e($message); ?></small>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 form-group">
                                    <label class="form-label" for=""><?php echo e(trans('labels.whatsapp_message')); ?>

                                    </label>
                                    <div class="text-center">
                                        <input id="whatsapp_on_off" type="checkbox" class="checkbox-switch"
                                            name="whatsapp_on_off" value="1"
                                            <?php echo e($settingdata->whatsapp_on_off == 1 ? 'checked' : ''); ?>>
                                        <label for="whatsapp_on_off" class="switch">
                                            <span
                                                class="<?php echo e(session()->get('direction') == 2 ? 'switch__circle-rtl' : 'switch__circle'); ?>"><span
                                                    class="switch__circle-inner"></span></span>
                                            <span
                                                class="switch__left <?php echo e(session()->get('direction') == 2 ? 'pe-2' : 'ps-2'); ?>"><?php echo e(trans('labels.off')); ?></span>
                                            <span
                                                class="switch__right <?php echo e(session()->get('direction') == 2 ? 'ps-2' : 'pe-2'); ?>"><?php echo e(trans('labels.on')); ?></span>
                                        </label>
                                    </div>

                                </div>
                                <div class="col-md-3 form-group">
                                    <label class="form-label" for=""><?php echo e(trans('labels.whatsapp_chat')); ?>

                                    </label>
                                    <div class="text-center">
                                        <input id="whatsapp_chat_on_off" type="checkbox" class="checkbox-switch"
                                            name="whatsapp_chat_on_off" value="1"
                                            <?php echo e($settingdata->whatsapp_chat_on_off == 1 ? 'checked' : ''); ?>>
                                        <label for="whatsapp_chat_on_off" class="switch">
                                            <span
                                                class="<?php echo e(session()->get('direction') == 2 ? 'switch__circle-rtl' : 'switch__circle'); ?>"><span
                                                    class="switch__circle-inner"></span></span>
                                            <span
                                                class="switch__left <?php echo e(session()->get('direction') == 2 ? 'pe-2' : 'ps-2'); ?>"><?php echo e(trans('labels.off')); ?></span>
                                            <span
                                                class="switch__right <?php echo e(session()->get('direction') == 2 ? 'ps-2' : 'pe-2'); ?>"><?php echo e(trans('labels.on')); ?></span>
                                        </label>
                                    </div>

                                </div>
                                <div class="col-md-3 form-group">
                                    <p class="form-label">
                                        <?php echo e(trans('labels.whatsapp_chat_position')); ?>

                                    </p>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input form-check-input-secondary" type="radio"
                                            name="whatsapp_chat_position" id="chatradio" value="1"
                                            <?php echo e(@$settingdata->whatsapp_chat_position == '1' ? 'checked' : ''); ?> />
                                        <label for="chatradio"
                                            class="form-check-label"><?php echo e(trans('labels.left')); ?></label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input form-check-input-secondary" type="radio"
                                            name="whatsapp_chat_position" id="chatradio1" value="2"
                                            <?php echo e(@$settingdata->whatsapp_chat_position == '2' ? 'checked' : ''); ?> />
                                        <label for="chatradio1"
                                            class="form-check-label"><?php echo e(trans('labels.right')); ?></label>
                                    </div>
                                </div>
                            </div>

                            <div
                                class="form-group <?php echo e(session()->get('direction') == 2 ? 'text-start' : 'text-end'); ?>">
                                <button
                                    class="btn btn-primary px-sm-4 <?php echo e(Auth::user()->type == 4 ? (helper::check_access('role_setting', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : ''); ?>"
                                    <?php if(env('Environment') == 'sendbox'): ?> type="button" onclick="myFunction()" <?php else: ?> type="submit" <?php endif; ?>><?php echo e(trans('labels.save')); ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/admin/included/whatsapp_message/setting_form.blade.php ENDPATH**/ ?>