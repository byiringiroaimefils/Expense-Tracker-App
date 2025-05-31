<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Tracker - Manage Your Finances</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .hero-gradient {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        }
        .feature-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
    </style>
</head>
<body class="h-full bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <i class="fas fa-wallet text-indigo-600 text-2xl mr-2"></i>
                        <span class="text-xl font-bold text-gray-900">ExpenseTracker</span>
                    </div>
                </div>
                <!-- <div class="hidden sm:ml-6 sm:flex sm:items-center space-x-4">
                    <a href="#features" class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Features</a>
                    <a href="#how-it-works" class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">How It Works</a>
                    <a href="#contact" class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Contact</a>
                </div> -->
                <div class="hidden sm:ml-6 sm:flex sm:items-center space-x-4">
                    <a href="/login" class="text-indigo-600 hover:text-indigo-800 px-4 py-2 text-sm font-medium">Sign In</a>
                    <a href="/register" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium transition duration-150 ease-in-out">Get Started</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero-gradient">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 md:py-32">
            <div class="text-center">
                <h1 class="text-4xl tracking-tight font-extrabold text-white sm:text-5xl md:text-6xl">
                    <span class="block">Take Control of Your</span>
                    <span class="block text-indigo-200">Personal Finances</span>
                </h1>
                <p class="mt-3 max-w-md mx-auto text-base text-indigo-100 sm:text-lg md:mt-5 md:text-xl md:max-w-3xl">
                    Track expenses, manage budgets, and achieve your financial goals with our intuitive expense tracking solution.
                </p>
                <div class="mt-8 flex justify-center">
                    <div class="rounded-md shadow">
                        <a href="/register" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-indigo-600 bg-white hover:bg-gray-50 md:py-4 md:text-lg md:px-10">
                            Get Started - It's Free
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="relative">
            <div class="absolute inset-0 flex flex-col" style="z-index: 0;">
                <div class="flex-1"></div>
                <div class="flex-1 w-full bg-white"></div>
            </div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative" style="z-index: 1;">
                <div class="max-w-4xl mx-auto">
                    <div class="bg-white rounded-lg shadow-xl overflow-hidden">
                        <div class="p-1 bg-gray-100">
                            <div class="flex space-x-2">
                                <div class="w-3 h-3 rounded-full bg-red-500"></div>
                                <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                                <div class="w-3 h-3 rounded-full bg-green-500"></div>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex justify-between items-center mb-6">
                                <h3 class="text-lg font-medium text-gray-900">Expense Overview</h3>
                                <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">This Month</span>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                                <div class="p-4 bg-green-50 rounded-lg">
                                    <p class="text-sm font-medium text-gray-500">Total Income</p>
                                    <p class="text-2xl font-bold text-green-600">+2,450,000 RWF</p>
                                </div>
                                <div class="p-4 bg-red-50 rounded-lg">
                                    <p class="text-sm font-medium text-gray-500">Total Expenses</p>
                                    <p class="text-2xl font-bold text-red-600">-1,250,000 RWF</p>
                                </div>
                                <div class="p-4 bg-blue-50 rounded-lg">
                                    <p class="text-sm font-medium text-gray-500">Net Balance</p>
                                    <p class="text-2xl font-bold text-blue-600">+1,200,000 RWF</p>
                                </div>
                            </div>
                            <div class="h-48 bg-gray-100 rounded-lg flex items-center justify-center">
                                <p class="text-gray-400">Expense Chart Preview</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div id="features" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                    Powerful Features
                </h2>
                <p class="mt-4 max-w-2xl text-xl text-gray-500 mx-auto">
                    Everything you need to manage your personal or business finances
                </p>
            </div>

            <div class="mt-16">
                <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                    <!-- Feature 1 -->
                    <div class="feature-card pt-6 bg-white rounded-lg overflow-hidden shadow">
                        <div class="px-6 pb-6">
                            <div class="h-12 w-12 rounded-md bg-indigo-500 text-white flex items-center justify-center mb-4">
                                <i class="fas fa-chart-pie text-xl"></i>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Expense Tracking</h3>
                            <p class="mt-2 text-base text-gray-500">
                                Easily track all your expenses in one place. Categorize transactions and get detailed insights into your spending habits.
                            </p>
                        </div>
                    </div>

                    <!-- Feature 2 -->
                    <div class="feature-card pt-6 bg-white rounded-lg overflow-hidden shadow">
                        <div class="px-6 pb-6">
                            <div class="h-12 w-12 rounded-md bg-green-500 text-white flex items-center justify-center mb-4">
                                <i class="fas fa-chart-line text-xl"></i>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Income Management</h3>
                            <p class="mt-2 text-base text-gray-500">
                                Record all your income sources and get a clear picture of your monthly cash flow and financial health.
                            </p>
                        </div>
                    </div>

                    <!-- Feature 3 -->
                    <div class="feature-card pt-6 bg-white rounded-lg overflow-hidden shadow">
                        <div class="px-6 pb-6">
                            <div class="h-12 w-12 rounded-md bg-blue-500 text-white flex items-center justify-center mb-4">
                                <i class="fas fa-chart-bar text-xl"></i>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Detailed Reports</h3>
                            <p class="mt-2 text-base text-gray-500">
                                Generate comprehensive reports and visualizations to analyze your spending patterns and financial growth over time.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="bg-indigo-700">
        <div class="max-w-2xl mx-auto text-center py-16 px-4 sm:py-20 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-extrabold text-white sm:text-4xl">
                <span class="block">Ready to take control of your finances?</span>
            </h2>
            <p class="mt-4 text-lg leading-6 text-indigo-200">
                Join thousands of users who are already managing their expenses with our platform.
            </p>
            <a href="/register" class="mt-8 w-full inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-indigo-600 bg-white hover:bg-indigo-50 sm:w-auto">
                Get Started for Free
            </a>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-white">
        <div class="max-w-7xl mx-auto py-12 px-4 overflow-hidden sm:px-6 lg:px-8">
            <nav class="-mx-5 -my-2 flex flex-wrap justify-center" aria-label="Footer">
                <div class="px-5 py-2">
                    <a href="#" class="text-base text-gray-500 hover:text-gray-900">About</a>
                </div>
                <div class="px-5 py-2">
                    <a href="#" class="text-base text-gray-500 hover:text-gray-900">Blog</a>
                </div>
                <div class="px-5 py-2">
                    <a href="#" class="text-base text-gray-500 hover:text-gray-900">Privacy</a>
                </div>
                <div class="px-5 py-2">
                    <a href="#" class="text-base text-gray-500 hover:text-gray-900">Terms</a>
                </div>
                <div class="px-5 py-2">
                    <a href="#contact" class="text-base text-gray-500 hover:text-gray-900">Contact</a>
                </div>
            </nav>
            <p class="mt-8 text-center text-base text-gray-400">
                &copy; {{ date('Y') }} ExpenseTracker. All rights reserved.
            </p>
        </div>
    </footer>
</body>
</html>