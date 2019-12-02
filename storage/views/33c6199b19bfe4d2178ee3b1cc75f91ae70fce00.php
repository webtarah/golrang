<?php $__env->startSection('content'); ?>
    <div class=" container col-sm-4 col-sm-pull-4 ">
        <?php if(isset($status)): ?>
            <div class="alert alert-danger" role="alert"><?php echo $status; ?></div>
        <?php endif; ?>
        <form action="<?php echo e($action); ?>" method="post"  enctype="multipart/form-data">
            <div class="form-group">
                <label for="email">full name:</label>
                <input type="text" class="form-control" name="name">
            </div>
            <div class="form-group">
                <label for="email">Email address:</label>
                <input type="email" class="form-control" name="email">
            </div>
            <div class="form-group">
                <label for="pwd">Password:</label>
                <input type="password" class="form-control" name="pwd">
            </div>
            <div class="form-group">
                <label for="pwd-confirm">Confirm Password:</label>
                <input type="password" class="form-control" name="pwdConfirm">
            </div>
            <div class="form-group">
                <label for="image">image:</label>
                <input type="file" name="image">
            </div>

            <button type="submit" class="btn btn-outline-primary">Submit</button>
            <a class="btn btn-outline-primary" href="<?php echo e($login); ?>">login</a>
        </form>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('../layouts/app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>