<table class="table">
    <thead>
        <tr class="text-capitalize fs-15 fw-500">
            <td><?php echo e(trans('labels.requested_domain')); ?></td>
            <td><?php echo e(trans('labels.current_domain')); ?></td>
            <td><?php echo e(trans('labels.status')); ?></td>
        </tr>
    </thead>
    <tbody>
        <tr class="border fs-7 align-middle">
            <td><?php echo e(empty(@$domain->requested_domain) ? '-' : @$domain->requested_domain); ?></td>
            <td><?php echo e(empty(@$domain->current_domain) ? '-' : @$domain->current_domain); ?></td>
            <td class="<?php echo e(@$domain->status == 1 ? 'text-warning' : 'text-success'); ?>">
                <?php if(@$domain->status == 1): ?>
                <span class="badge bg-warning"><?php echo e(trans('labels.pending')); ?> </span>
                <?php elseif(@$domain->status == 2): ?>
                <span class="badge bg-success"><?php echo e(trans('labels.connected')); ?> </span>
                <?php else: ?>
                    -
                <?php endif; ?>
            </td>
        </tr>
    </tbody>
</table>
<?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/admin/customdomain/customdomain_table.blade.php ENDPATH**/ ?>