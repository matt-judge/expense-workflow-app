<!DOCTYPE html>
<html>
    <head>
        <title>New Expense Submitted</title>
        <style>
            .button {
                display: inline-block;
                padding: 10px 20px;
                font-size: 16px;
                color: #fff;
                background-color: #007bff;
                text-decoration: none;
                border-radius: 5px;
            }
        </style>
    </head>
    <body>
        <h1>New Expense Submitted</h1>
        <p>A new expense has been submitted and needs to be reviewed. Here are the details:</p>
        <table border="1" cellpadding="10" cellspacing="0">
            <tr>
                <th>Description</th>
                <td>{{ $expense->description }}</td>
            </tr>
            <tr>
                <th>Category</th>
                <td>{{ $expense->category->name }}</td>
            </tr>
            <tr>
                <th>Amount</th>
                <td>£{{ number_format($expense->amount, 2) }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>{{ ucfirst($expense->status) }}</td>
            </tr>
            <tr>
                <th>Submitted on</th>
                <td>{{ $expense->created_at->format('d F Y H:i:s') }}</td>
            </tr>
            @if ($expense->receipt_image)
            <tr>
                <th>Receipt Image</th>
                <td><img src="{{ asset('storage/' . $expense->receipt_image) }}" alt="Receipt Image" style="max-width: 200px;"></td>
            </tr>
            @endif
        </table>
        <p>
            <a href="{{ url('/expenses/admin') }}" class="button">Review this expense</a>
        </p>
    </body>
</html>