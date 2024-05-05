<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><?php echo e(__('Tasks')); ?></div>

                <div class="card-body">
                    <?php if(session('success')): ?>
                        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
                    <?php endif; ?>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Due Date</th>
                                <th>Actions</th> <!-- New column for actions -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($task->title); ?></td>
                                    <td><?php echo e($task->description); ?></td>
                                    <td><?php echo e($task->due_date); ?></td>
                                    <td>
                                        <!-- Delete button -->
                                        <form action="<?php echo e(route('tasks.destroy', $task->id)); ?>" method="POST" style="display: inline;">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="4">No tasks found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                    <?php echo e($tasks->links()); ?>


                    <!-- Button to redirect back to the welcome page -->
                    <a href="<?php echo e(route('welcome')); ?>" class="btn btn-secondary">Back to adding Tasks </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\CARNIVAL\OneDrive\Desktop\taskManager\firstApp\TaskManager\resources\views/home.blade.php ENDPATH**/ ?>