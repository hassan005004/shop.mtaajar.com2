<html>

<head>
    <title><?php echo e(helper::appdata('')->web_title); ?></title>
</head>
<style type="text/css">
    body {
        font-family: 'Roboto Condensed', sans-serif;
    }

    .m-0 {
        margin: 0px;
    }

    .p-0 {
        padding: 0px;
    }

    .pt-5 {
        padding-top: 5px;
    }

    .mt-10 {
        margin-top: 10px;
    }

    .text-center {
        text-align: center !important;
    }

    .w-100 {
        width: 100%;
    }

    .w-50 {
        width: 50%;
    }

    .w-85 {
        width: 85%;
    }

    .w-15 {
        width: 15%;
    }

    .logo img {
        width: 200px;
        height: 60px;
    }

    .gray-color {
        color: #5D5D5D;
    }

    .text-bold {
        font-weight: bold;
    }

    .border {
        border: 1px solid black;
    }

    table tr,
    th,
    td {
        border: 1px solid #d2d2d2;
        border-collapse: collapse;
        padding: 7px 8px;
    }

    table tr th {
        background: #F4F4F4;
        font-size: 15px;
    }

    table tr td {
        font-size: 13px;
    }

    table {
        border-collapse: collapse;
    }

    .box-text p {
        line-height: 10px;
    }

    .float-left {
        float: left;
    }

    .total-part {
        font-size: 16px;
        line-height: 12px;
    }

    .total-right p {
        padding-right: 20px;
    }
</style>

<body>
    <div class="head-title">
        <h1 class="text-center m-0 p-0"><?php echo e(trans('labels.subcategory_list')); ?></h1>
    </div>
  
    <div class="table-section bill-tbl w-100 mt-10">
        <table class="table w-100 mt-10">
            <tr>
                <th class="w-50"><?php echo e(trans('labels.categories')); ?></th>
                <th class="w-50"><?php echo e(trans('labels.sub_categories')); ?></th>
                <th class="w-50"><?php echo e(trans('labels.id')); ?></th>
            </tr>
            <?php $__currentLoopData = $subcategorylist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td>
                    <div class="box-text">
                        <?php echo e($subcategory['category_info']->name); ?>

                    </div>
                </td>
                <td>
                    <div class="box-text">
                        <?php echo e($subcategory->name); ?>

                    </div>
                </td>
                <td>
                    <div class="box-text">
                        <?php echo e($subcategory->id); ?>

                    </div>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </table>
    </div>
</body>

</html>
<?php /**PATH /home/mtaajrco/shop.mtaajr.com/resources/views/admin/product/subcategorylist.blade.php ENDPATH**/ ?>