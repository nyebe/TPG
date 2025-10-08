

<?php $__env->startSection('content'); ?>
<div class="flex justify-center items-center px-4 sm:px-6 lg:px-8 py-12 min-h-screen">
    <div class="space-y-8 bg-white shadow-lg p-8 rounded-lg w-full max-w-md">
        <div>
            <h2 class="mt-6 font-extrabold text-gray-900 text-3xl text-center">
                Create your account
            </h2>
            <p class="mt-2 text-gray-600 text-sm text-center">
                Or
                <a href="<?php echo e(route('login')); ?>" class="font-medium text-orange-600 hover:text-orange-500">
                    sign in to your existing account
                </a>
            </p>
        </div>
        <form class="space-y-6 mt-8" method="POST" action="<?php echo e(url('/register')); ?>">
            <?php echo csrf_field(); ?>
            <div class="space-y-4">
                <div>
                    <label for="first_name" class="block font-medium text-gray-700 text-sm">First Name</label>
                    <input id="first_name" name="first_name" type="text" autocomplete="given-name" required
                        class="block focus:z-10 relative mt-1 px-3 py-2 border border-gray-300 focus:border-orange-500 rounded-md focus:outline-none focus:ring-orange-500 w-full text-gray-900 sm:text-sm appearance-none placeholder-gray-500"
                        placeholder="Enter your first name" value="<?php echo e(old('first_name')); ?>">
                </div>
                <div>
                    <label for="last_name" class="block font-medium text-gray-700 text-sm">Last Name</label>
                    <input id="last_name" name="last_name" type="text" autocomplete="family-name" required
                        class="block focus:z-10 relative mt-1 px-3 py-2 border border-gray-300 focus:border-orange-500 rounded-md focus:outline-none focus:ring-orange-500 w-full text-gray-900 sm:text-sm appearance-none placeholder-gray-500"
                        placeholder="Enter your last name" value="<?php echo e(old('last_name')); ?>">
                </div>
                <div>
                    <label for="middle_name" class="block font-medium text-gray-700 text-sm">Middle Name (Optional)</label>
                    <input id="middle_name" name="middle_name" type="text" autocomplete="additional-name"
                        class="block focus:z-10 relative mt-1 px-3 py-2 border border-gray-300 focus:border-orange-500 rounded-md focus:outline-none focus:ring-orange-500 w-full text-gray-900 sm:text-sm appearance-none placeholder-gray-500"
                        placeholder="Enter your middle name" value="<?php echo e(old('middle_name')); ?>">
                </div>
                <div>
                    <label for="email" class="block font-medium text-gray-700 text-sm">Email Address</label>
                    <input id="email" name="email" type="email" autocomplete="email" required
                        class="block focus:z-10 relative mt-1 px-3 py-2 border border-gray-300 focus:border-orange-500 rounded-md focus:outline-none focus:ring-orange-500 w-full text-gray-900 sm:text-sm appearance-none placeholder-gray-500"
                        placeholder="Enter your email address" value="<?php echo e(old('email')); ?>">
                </div>
                <div>
                    <label for="password" class="block font-medium text-gray-700 text-sm">Password</label>
                    <input id="password" name="password" type="password" autocomplete="new-password" required
                        class="block focus:z-10 relative mt-1 px-3 py-2 border border-gray-300 focus:border-orange-500 rounded-md focus:outline-none focus:ring-orange-500 w-full text-gray-900 sm:text-sm appearance-none placeholder-gray-500"
                        placeholder="Enter your password">
                </div>
            </div>

            <div>
                <button type="submit"
                    class="group relative flex justify-center bg-orange-600 hover:bg-orange-700 px-4 py-2 border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 w-full font-medium text-white text-sm">
                    <span class="left-0 absolute inset-y-0 flex items-center pl-3">
                        <svg class="w-5 h-5 text-orange-500 group-hover:text-orange-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z" clip-rule="evenodd" />
                        </svg>
                    </span>
                    Create Account
                </button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/auth/register.blade.php ENDPATH**/ ?>