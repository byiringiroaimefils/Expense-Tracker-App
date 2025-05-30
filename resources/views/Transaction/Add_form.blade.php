<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <x-navbar />
    <button> <a href="/transaction">Back </a> </button>
    <h3>Add Transaction</h3>
    <form action="{{ route('transaction.store') }}" method="post" style="margin-top: 40px">
        @method('post')
        @csrf

        <label>Type:</label><br>
        <select name="type" style="width: 21%; padding: 5px;">
            <option value="hidden">Type</option>
            <option value="income">Income</option>
            <option value="expense">Expense</option>
        </select><br>
        <span style="color: red">
            @error('type')
                {{ $message }}
            @enderror
        </span><br>
        <label>Amount:</label><br>
        <input type="number" name="amount" style="width: 20%; padding: 5px;"><br>
        <span style="color: red">
            @error('amount')
                {{ $message }}
            @enderror
        </span><br>
        <label>Category:</label><br>
        <input type="text" name="category" style="width: 20%; padding: 5px;"><br>
        <span style="color: red">
            @error('category')
                {{ $message }}
            @enderror
        </span><br>
        <label>Date:</label><br>
        <input type="date" name="transaction_date" style="width: 20%; padding: 5px;"><br>
        <span style="color: red">
            @error('transaction_date')
                {{ $message }}
            @enderror
        </span>
        <br><br>
        <button type="submit" style="width: 21%; padding: 5px;">Add </button>
    </form>
</body>

</html>
