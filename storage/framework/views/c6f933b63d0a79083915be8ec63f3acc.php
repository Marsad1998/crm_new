<?php if(Route::has('login')): ?>
                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                    <?php if(auth()->guard()->check()): ?>
                        <a href="<?php echo e(url('/')); ?>">Home</a>
                        <a href="<?php echo e(url('/logout')); ?>">Logout</a>
                        <br>
                        <?php
                            auth()->user()->id;
                            echo $user = Auth::user();
                            // echo $tenantDomain = tenant('id');
                            echo tenant('id');
                        ?>
                    <?php else: ?>
                        <a href="<?php echo e(route('login')); ?>">Log in</a>

                        <?php if(Route::has('register')): ?>
                            <a href="<?php echo e(route('register')); ?>" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            <?php endif; ?><?php /**PATH C:\xampp\htdocs\upwork\crm_new\resources\views/tenant.blade.php ENDPATH**/ ?>