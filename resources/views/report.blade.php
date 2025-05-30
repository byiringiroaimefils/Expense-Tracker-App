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
            <h3> Report Page</h3>
        </div>
        <form method="GET" action="{{ route('report') }}">
            <label for="start_date">From:</label>
            <input type="date" name="start_date" required>

            <label for="end_date">To:</label>
            <input type="date" name="end_date" required>

            <button type="submit">Generate Report</button>
        </form>

        <h3>Transaction Report ({{ $start }} to {{ $end }})</h3>

        <table style="width: 70%;">
            <tr>
                <th>#</th>
                <th>Date</th>
                <th>Category</th>
                <th>Type</th>
                <th>Amount</th>
                {{-- <th>User_role</th> --}}
            </tr>
            @foreach ($transactions as $key => $t)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $t->transaction_date }}</td>
                    <td>{{ $t->category }}</td>
                    <td>{{ $t->type }}</td>
                    <td>{{ number_format($t->amount, 2) }} Rfw</td>

                    {{-- @if ($user_role)
                    <td>
                        {{ $t->register->username }}
                    </td>
                @endif --}}
                    {{-- <td>
                        @if ($user_role)
                            @if ($t->register_id == 1)
                                {{ 'Admin' }}
                            @else
                                {{ 'Accountant' }}
                            @endif
                        @endif
                    </td> --}}
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

        {{-- <hr width="70%">

        <p><strong>Total Income:</strong> {{ $totalIncome }}.00RFW</p>
        <p><strong>Total Expense:</strong> {{ $totalExpense }}.00RFW</p>
        <p>
            <strong>Profit/Loss:</strong>
            @if ($profit >= 0)
                <span style="color: green;">{{ $profit }}.00RFW (Profit)</span>
            @else
                <span style="color: red;">{{ $profit }}.00RFW (Loss)</span>
            @endif
        </p> --}}
        <button onclick="window.print()">Print Report</button>
    </section>
</body>

</html>
