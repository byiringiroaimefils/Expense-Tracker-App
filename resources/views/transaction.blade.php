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
    <section>
        <div>
            <h3> Transaction Page</h3>

        </div>
        <button> <a href="/transaction_form">Add Transaction </a> </button>
        <br><br><br>
        @if (Session::has('message'))
            <div>{{ session::get('message') }}</div>
        @endif
        <br><br>
        <table style="width: 70%;">
            <tr style="align-items: center">
                <th>#</th>
                <th>Type of transaction</th>
                <th>Transaction Date</th>
                <th>Category</th>
                <th>Amount</th>
                {{-- <th>User </th> --}}
                <th>Action</th>

            </tr>
            @foreach ($transactions as $key => $transaction)
                <tr style="align-items: center">
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $transaction->category }}</td>
                    <td>{{ $transaction->transaction_date }}</td>
                    <td>{{ $transaction->type }}</td>
                    <td>{{ number_format($transaction->amount, 2) }} Rfw</td>

                    {{-- @if ($user_role)
                        <td>
                            {{ $transaction->register->username }}
                        </td>
                    @endif --}}
                    {{-- <td>
                        @if ($user_role)
                            @if ($transaction->register_id == 1)
                                {{ 'Admin' }}
                            @else
                                {{ 'Accountant' }}
                            @endif
                        @endif
                    </td> --}}
                    <td style="display: flex">
                        <button><a href="{{ route('transaction.edit', $transaction->id) }}">Update</a></button>
                        <form action="{{ route('transaction.delete', $transaction->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button onclick="alert('Do you want to delete tranaction')">Delete</button>
                        </form>
                    </td>

                </tr>
            @endforeach
            <tr style="font-weight: bolder;">
                <td colspan="2">Total Income</td>
                <td colspan="4">{{ number_format($totalIncome, 2) }} Rfw</td>
            </tr>
            <tr style="font-weight: bolder">
                <td colspan="2">Total Expenses</td>
                <td colspan="4">{{ number_format($totalExpense, 2) }} Rfw </td>
            </tr>
            <tr style="font-weight: bolder">

                <td colspan="2">Net</td>
                <td colspan="4">{{ number_format($profit, 2) }} Rfw</td>
            </tr>
            <tr style="font-weight: bolder">

                <td colspan="2">Decision</td>
                <td colspan="4">
                    @if ($profit >= 0)
                        <span style="color: green;"> Profit</span>
                    @else
                        <span style="color: red;">Loss</span>
                    @endif
                </td>
            </tr>
        </table>
    </section>
</body>

</html>
