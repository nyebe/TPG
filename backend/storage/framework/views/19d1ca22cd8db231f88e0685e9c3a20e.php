<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo e(config('app.name', 'Laravel')); ?> - Employee Management System</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-gray-800 min-h-screen text-white">
    <!-- Header Navigation -->
    <header class="bg-gray-900 shadow-lg">
        <div class="mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
            <div class="flex justify-between items-center py-6">
                <div class="flex items-center">
                    <h1 class="font-bold text-orange-400 text-2xl"><?php echo e(config('app.name', 'Laravel')); ?></h1>
                    <span class="ml-3 text-gray-400">Employee Management System</span>
                </div>
                <nav class="flex items-center space-x-4">
                    <?php if(auth()->guard()->check()): ?>
                    <div class="flex items-center space-x-4">
                        <span class="text-gray-300 text-sm">
                            Welcome, <?php echo e(auth()->user()->first_name); ?> <?php echo e(auth()->user()->last_name); ?>

                        </span>
                        <span class="inline-flex items-center bg-orange-100 px-2.5 py-0.5 rounded-full font-medium text-orange-800 text-xs">
                            <?php echo e(ucfirst(auth()->user()->role)); ?>

                        </span>
                        <?php if(auth()->user()->isAdmin()): ?>
                        <a href="<?php echo e(route('users')); ?>"
                            class="inline-block px-4 py-2 text-gray-300 hover:text-white text-sm transition-colors">
                            Dashboard
                        </a>
                        <?php endif; ?>
                        <form method="POST" action="<?php echo e(url('/logout')); ?>" class="inline">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="inline-block bg-orange-600 hover:bg-orange-700 px-4 py-2 rounded-md font-medium text-white text-sm transition-colors">
                                Logout
                            </button>
                        </form>
                    </div>
                    <?php else: ?>
                    <a href="<?php echo e(route('login')); ?>" class="inline-block px-4 py-2 font-medium text-gray-300 hover:text-white text-sm transition-colors">
                        Sign In
                    </a>
                    <a href="<?php echo e(route('register')); ?>" class="inline-block bg-orange-600 hover:bg-orange-700 px-4 py-2 rounded-md font-medium text-white text-sm transition-colors">
                        Sign Up
                    </a>
                    <?php endif; ?>
                </nav>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="mx-auto px-4 sm:px-6 lg:px-8 py-12 max-w-7xl">
        <!-- Hero Section -->
        <div class="mb-16 text-center">
            <h1 class="font-bold text-white text-4xl sm:text-5xl md:text-6xl">
                Employee Management
                <span class="text-orange-400">System</span>
            </h1>
            <p class="mx-auto mt-6 max-w-3xl text-gray-300 text-xl">
                A comprehensive solution for managing your organization's workforce.
                Streamline employee records, manage roles, and maintain organizational structure
                with our intuitive and secure platform.
            </p>
            <?php if(auth()->guard()->guest()): ?>
            <div class="flex justify-center space-x-4 mt-10">
                <a href="<?php echo e(route('register')); ?>"
                    class="inline-flex items-center bg-orange-600 hover:bg-orange-700 px-8 py-3 border border-transparent rounded-md font-semibold text-white text-base transition-colors">
                    Get Started
                    <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </a>
                <a href="<?php echo e(route('login')); ?>"
                    class="inline-flex items-center bg-gray-700 hover:bg-gray-600 px-8 py-3 border border-transparent rounded-md font-semibold text-white text-base transition-colors">
                    Sign In
                </a>
            </div>
            <?php endif; ?>
        </div>

        <!-- Features Section -->
        <div class="gap-8 grid grid-cols-1 md:grid-cols-3 mb-16">
            <div class="bg-gray-900 shadow-lg p-8 rounded-lg">
                <div class="flex justify-center items-center bg-orange-600 mb-4 rounded-lg w-12 h-12">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                    </svg>
                </div>
                <h3 class="mb-3 font-semibold text-white text-xl">Employee Records</h3>
                <p class="text-gray-400">
                    Maintain comprehensive employee profiles with personal information, contact details, and employment history.
                </p>
            </div>

            <div class="bg-gray-900 shadow-lg p-8 rounded-lg">
                <div class="flex justify-center items-center bg-orange-600 mb-4 rounded-lg w-12 h-12">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <h3 class="mb-3 font-semibold text-white text-xl">Role Management</h3>
                <p class="text-gray-400">
                    Define and manage user roles with appropriate permissions. Control access to sensitive information and features.
                </p>
            </div>

            <div class="bg-gray-900 shadow-lg p-8 rounded-lg">
                <div class="flex justify-center items-center bg-orange-600 mb-4 rounded-lg w-12 h-12">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                </div>
                <h3 class="mb-3 font-semibold text-white text-xl">Analytics & Reports</h3>
                <p class="text-gray-400">
                    Generate insights about your workforce with comprehensive reporting and analytics tools.
                </p>
            </div>
        </div>

        <!-- About Section -->
        <div class="bg-gray-900 shadow-lg mb-16 p-8 rounded-lg">
            <div class="mx-auto max-w-4xl text-center">
                <h2 class="mb-6 font-bold text-white text-3xl">About This Project</h2>
                <p class="mb-6 text-gray-300 text-lg">
                    This Employee Management System is built with Laravel and demonstrates modern web application development practices.
                    It features secure authentication, role-based access control, and a comprehensive CRUD interface for managing employees.
                </p>
                <div class="gap-8 grid grid-cols-2 md:grid-cols-4 text-center">
                    <div>
                        <div class="font-bold text-orange-400 text-2xl">Laravel 12</div>
                        <div class="text-gray-400 text-sm">Framework</div>
                    </div>
                    <div>
                        <div class="font-bold text-orange-400 text-2xl">PostgreSQL</div>
                        <div class="text-gray-400 text-sm">Database</div>
                    </div>
                    <div>
                        <div class="font-bold text-orange-400 text-2xl">Tailwind CSS</div>
                        <div class="text-gray-400 text-sm">Styling</div>
                    </div>
                    <div>
                        <div class="font-bold text-orange-400 text-2xl">PHPUnit</div>
                        <div class="text-gray-400 text-sm">Testing</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- User Roles Section -->
        <div class="text-center">
            <h2 class="mb-8 font-bold text-white text-3xl">User Roles</h2>
            <div class="gap-6 grid grid-cols-1 md:grid-cols-3 mx-auto max-w-4xl">
                <div class="bg-red-900/20 p-6 border border-red-500/30 rounded-lg">
                    <div class="inline-flex justify-center items-center bg-red-600 mb-4 rounded-full w-16 h-16">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 font-semibold text-red-400 text-xl">Administrator</h3>
                    <p class="text-gray-300 text-sm">
                        Full system access. Can manage all employees, view comprehensive user directory, and perform all administrative tasks.
                    </p>
                </div>

                <div class="bg-blue-900/20 p-6 border border-blue-500/30 rounded-lg">
                    <div class="inline-flex justify-center items-center bg-blue-600 mb-4 rounded-full w-16 h-16">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2V8a2 2 0 012-2V6" />
                        </svg>
                    </div>
                    <h3 class="mb-2 font-semibold text-blue-400 text-xl">Staff</h3>
                    <p class="text-gray-300 text-sm">
                        Limited access to system features. Can view their own profile and access general information areas.
                    </p>
                </div>

                <div class="bg-orange-900/20 p-6 border border-orange-500/30 rounded-lg">
                    <div class="inline-flex justify-center items-center bg-orange-600 mb-4 rounded-full w-16 h-16">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 font-semibold text-orange-400 text-xl">Client</h3>
                    <p class="text-gray-300 text-sm">
                        Basic user access. Can view public information and manage their own account settings.
                    </p>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 border-gray-700 border-t">
        <div class="mx-auto px-4 sm:px-6 lg:px-8 py-8 max-w-7xl">
            <div class="text-center">
                <p class="text-gray-400 text-sm">
                    © <?php echo e(date('Y')); ?> <?php echo e(config('app.name', 'Laravel')); ?> Employee Management System.
                    Built with Laravel & Tailwind CSS.
                </p>
                <?php if(auth()->guard()->check()): ?>
                <p class="mt-2 text-gray-500 text-xs">
                    Logged in as <?php echo e(auth()->user()->full_name); ?> (<?php echo e(ucfirst(auth()->user()->role)); ?>)
                </p>
                <?php endif; ?>
            </div>
        </div>
    </footer>
</body>

</html><?php /**PATH /var/www/html/resources/views/welcome.blade.php ENDPATH**/ ?>