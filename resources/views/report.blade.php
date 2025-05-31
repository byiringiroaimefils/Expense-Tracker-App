<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Financial Report - Expense Tracker</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="h-full">
    <x-navbar />

    <div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Header -->
            <div class="md:flex md:items-center md:justify-between mb-8">
                <div class="flex-1 min-w-0">
                    <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                        Financial Report
                    </h2>
                    <p class="mt-1 text-sm text-gray-500">
                        {{ \Carbon\Carbon::parse($start)->format('M d, Y') }} to {{ \Carbon\Carbon::parse($end)->format('M d, Y') }}
                    </p>
                </div>
                <div class="mt-4 flex md:mt-0 md:ml-4">
                    <button onclick="window.print()" class="ml-3 inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <i class="fas fa-print mr-2"></i> Print Report
                    </button>
                </div>
            </div>

            <!-- Date Range Form -->
            <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-8">
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Report Filters</h3>
                </div>
                <div class="border-t border-gray-200 px-4 py-5 sm:p-6">
                    <form method="GET" action="{{ route('report') }}" class="space-y-4 sm:space-y-0 sm:grid sm:grid-cols-3 sm:gap-4">
                        @csrf
                        <div>
                            <label for="start_date" class="block text-sm font-medium text-gray-700">From Date</label>
                            <input type="date" name="start_date" id="start_date" value="{{ $start }}" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="end_date" class="block text-sm font-medium text-gray-700">To Date</label>
                            <input type="date" name="end_date" id="end_date" value="{{ $end }}" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>
                        <div class="flex items-end">
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <i class="fas fa-filter mr-2"></i> Generate Report
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Summary Cards -->
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-3 mb-8">
                <!-- Total Income -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-green-100 rounded-md p-3">
                                <i class="fas fa-arrow-down text-green-600 text-xl"></i>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Total Income</dt>
                                    <dd class="flex items-baseline">
                                        <div class="text-2xl font-semibold text-gray-900">
                                            {{ number_format($totalIncome, 2) }} RWF
                                        </div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Expenses -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-red-100 rounded-md p-3">
                                <i class="fas fa-arrow-up text-red-600 text-xl"></i>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Total Expenses</dt>
                                    <dd class="flex items-baseline">
                                        <div class="text-2xl font-semibold text-gray-900">
                                            {{ number_format($totalExpense, 2) }} RWF
                                        </div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Net Profit/Loss -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 {{ $profit >= 0 ? 'bg-green-100' : 'bg-red-100' }} rounded-md p-3">
                                <i class="fas {{ $profit >= 0 ? 'fa-chart-line text-green-600' : 'fa-chart-line-down text-red-600' }} text-xl"></i>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Net {{ $profit >= 0 ? 'Profit' : 'Loss' }}</dt>
                                    <dd class="flex items-baseline">
                                        <div class="text-2xl font-semibold {{ $profit >= 0 ? 'text-green-600' : 'text-red-600' }}">
                                            {{ number_format(abs($profit), 2) }} RWF
                                        </div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Transactions Table -->
            <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-8">
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Transaction Details</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                                @if($isAdmin)
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                                @endif
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($transactions as $key => $t)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $key + 1 }}</td>
                                    @if($isAdmin)
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <div class="flex items-center">
                                        <div class="h-10 w-10 flex-shrink-0 bg-indigo-100 rounded-full flex items-center justify-center">
                                            <span class="text-indigo-700 font-medium text-sm">{{ substr($t->register->username, 0, 1) }}</span>
                                        </div>
                                        <div class="ml-3">
                                            <div class="flex items-center">
                                                <div class="text-sm font-medium text-gray-900">{{ $t->register->username }}</div>
                                                <span class="ml-2 px-2 py-0.5 text-xs rounded-full {{ $t->register->role === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                                                    {{ ucfirst($t->register->role) }}
                                                </span>
                                            </div>
                                            <div class="text-xs text-gray-500">{{ $t->register->email }}</div>
                                        </div>
                                    </div>
                                    </td>
                                    @endif
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ \Carbon\Carbon::parse($t->transaction_date)->format('M d, Y') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                            {{ $t->category }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $t->type === 'income' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ ucfirst($t->type) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium 
                                        {{ $t->type === 'income' ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $t->type === 'income' ? '+' : '-' }}{{ number_format($t->amount, 2) }} RWF
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">
                                        No transactions found in the selected date range.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                        <tfoot class="bg-gray-50">
                            <tr class="border-t-2 border-gray-200">
                                <td colspan="4" class="px-6 py-3 text-right text-sm font-medium text-gray-900">Total Income:</td>
                                <td class="px-6 py-3 text-right text-sm font-medium text-green-600">
                                    +{{ number_format($totalIncome, 2) }} RWF
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4" class="px-6 py-3 text-right text-sm font-medium text-gray-900">Total Expenses:</td>
                                <td class="px-6 py-3 text-right text-sm font-medium text-red-600">
                                    -{{ number_format($totalExpense, 2) }} RWF
                                </td>
                            </tr>
                            <tr class="bg-gray-50 font-bold">
                                <td colspan="4" class="px-6 py-3 text-right text-sm font-medium text-gray-900">Net {{ $profit >= 0 ? 'Profit' : 'Loss' }}:</td>
                                <td class="px-6 py-3 text-right text-sm font-medium {{ $profit >= 0 ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $profit >= 0 ? '+' : '' }}{{ number_format($profit, 2) }} RWF
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <!-- Print Only Section -->
            <div class="hidden print:block mt-12">
                <div class="text-center text-sm text-gray-500">
                    <p>Generated on {{ now()->format('M d, Y h:i A') }}</p>
                    <p>Expense Tracker System</p>
                </div>
            </div>
        </div>
    </div>

    <style>
        @media print {
            body * {
                visibility: hidden;
            }
            .print-container, .print-container * {
                visibility: visible;
            }
            .print-container {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }
            .no-print {
                display: none !important;
            }
            .print\:hidden {
                display: none;
            }
        }
    </style>
</body>
</html>