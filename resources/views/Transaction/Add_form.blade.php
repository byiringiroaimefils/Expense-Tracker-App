<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Transaction - Expense Tracker</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="bg-gray-100 min-h-screen">
    <x-navbar />
    
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto">
            <!-- Back Button -->
            <div class="mb-6">
                <a href="/transaction" class="inline-flex items-center text-blue-600 hover:text-blue-800">
                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Transactions
                </a>
            </div>

            <!-- Form Card -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="bg-blue-600 py-4 px-6">
                    <h2 class="text-xl font-semibold text-white">Add New Transaction</h2>
                </div>
                
                <form action="{{ route('transaction.store') }}" method="post" class="p-6">
                    @method('post')
                    @csrf

                    <!-- Type Field -->
                    <div class="mb-6">
                        <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Transaction Type</label>
                        <div class="relative">
                            <select id="type" name="type" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <option value="" disabled selected>Select transaction type</option>
                                <option value="income" {{ old('type') == 'income' ? 'selected' : '' }}>Income</option>
                                <option value="expense" {{ old('type') == 'expense' ? 'selected' : '' }}>Expense</option>
                            </select>
                        </div>
                        @error('type')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Amount Field -->
                    <div class="mb-6">
                        <label for="amount" class="block text-sm font-medium text-gray-700 mb-1">Amount (RWF)</label>
                        <div class="relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500">RWF</span>
                            </div>
                            <input type="number" id="amount" name="amount" value="{{ old('amount') }}" 
                                   class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-16 pr-12 py-2 border border-gray-300 rounded-md" 
                                   placeholder="0.00" step="0.01" min="0">
                        </div>
                        @error('amount')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category Field -->
                    <div class="mb-6">
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                        <div class="relative">
                            <select id="category" name="category" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <option value="" disabled selected>Select a category</option>
                                <option value="Salary" {{ old('category') == 'Salary' ? 'selected' : '' }}>Salary</option>
                                <option value="Freelance" {{ old('category') == 'Freelance' ? 'selected' : '' }}>Freelance</option>
                                <option value="Business" {{ old('category') == 'Business' ? 'selected' : '' }}>Business</option>
                                <option value="Food" {{ old('category') == 'Food' ? 'selected' : '' }}>Food</option>
                                <option value="Transport" {{ old('category') == 'Transport' ? 'selected' : '' }}>Transport</option>
                                <option value="Bills" {{ old('category') == 'Bills' ? 'selected' : '' }}>Bills</option>
                                <option value="Shopping" {{ old('category') == 'Shopping' ? 'selected' : '' }}>Shopping</option>
                                <option value="Entertainment" {{ old('category') == 'Entertainment' ? 'selected' : '' }}>Entertainment</option>
                                <option value="other" {{ old('category') == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>
                        @error('category')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Date Field -->
                    <div class="mb-8">
                        <label for="transaction_date" class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                        <input type="date" id="transaction_date" name="transaction_date" value="{{ old('transaction_date', date('Y-m-d')) }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        @error('transaction_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Add Transaction
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Set default date to today
        document.addEventListener('DOMContentLoaded', function() {
            const today = new Date().toISOString().split('T')[0];
            if (!document.getElementById('transaction_date').value) {
                document.getElementById('transaction_date').value = today;
            }
        });
    </script>
</body>
</html>
