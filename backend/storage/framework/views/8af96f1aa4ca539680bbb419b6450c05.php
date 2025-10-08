<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo e(config('app.name', 'Laravel')); ?></title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-gray-800 min-h-screen text-white">
    <div class="mx-auto px-4 py-8 container">
        <!-- Success Messages -->
        <?php if(session('status') || session('success')): ?>
        <div id="success-toast" class="top-4 right-4 z-50 fixed flex items-center space-x-2 bg-green-500 shadow-lg px-6 py-3 rounded-lg text-white">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
            </svg>
            <span><?php echo e(session('status') ?? session('success')); ?></span>
            <button onclick="closeToast('success-toast')" class="ml-2 text-green-200 hover:text-white">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
        <?php endif; ?>

        <!-- Error Modal -->
        <?php if($errors->any()): ?>
        <div id="error-modal" class="z-50 fixed inset-0 flex justify-center items-center bg-black bg-opacity-50">
            <div class="bg-white shadow-xl mx-4 rounded-lg w-full max-w-md">
                <div class="flex justify-between items-center bg-red-500 px-6 py-4 rounded-t-lg text-white">
                    <h3 class="flex items-center font-semibold text-lg">
                        <svg class="mr-2 w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        Validation Errors
                    </h3>
                    <button onclick="closeModal('error-modal')" class="text-red-200 hover:text-white">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <div class="px-6 py-4 text-gray-800">
                    <ul class="space-y-2">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="flex items-start">
                            <svg class="flex-shrink-0 mt-0.5 mr-2 w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                            </svg>
                            <?php echo e($error); ?>

                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
                <div class="bg-gray-50 px-6 py-3 rounded-b-lg text-right">
                    <button onclick="closeModal('error-modal')" class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded text-white transition-colors">
                        Close
                    </button>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <?php echo $__env->yieldContent('content'); ?>
    </div>

    <script>
        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        function closeToast(toastId) {
            document.getElementById(toastId).style.display = 'none';
        }

        // Auto-hide success toast after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const successToast = document.getElementById('success-toast');
            if (successToast) {
                setTimeout(() => {
                    successToast.style.display = 'none';
                }, 5000);
            }
        });
    </script>
</body>

</html><?php /**PATH /var/www/html/resources/views/layouts/app.blade.php ENDPATH**/ ?>