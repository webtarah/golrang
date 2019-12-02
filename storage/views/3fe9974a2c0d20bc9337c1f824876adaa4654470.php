<?php $__env->startSection('content'); ?>
    <div class=" container col-sm-4 col-sm-pull-4 ">
        <div><h4><?php echo e($user->name); ?></h4></div>
        <div><img  src="<?php echo e($image); ?>" width="250"></div>
        <br>
        <div><a class="btn btn-outline-primary" href="<?php echo e($logout); ?>">logout</a></div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts/app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>