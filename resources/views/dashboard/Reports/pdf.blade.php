<!DOCTYPE html>
<html>
<head>
    <title>Reports PDF</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: left; }
    </style>
</head>
<body>
    <h2>Reports List</h2>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Total Expenses</th>
                <th>Total Income</th>
                <th>Net Balance</th>
                <th>Start Date</th>
                <th>End Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reports as $report)
            <tr>
                <td>{{ $report->reportID }}</td>
                <td>${{ number_format($report->totalExpenses, 2) }}</td>
                <td>${{ number_format($report->totalIncome, 2) }}</td>
                <td>${{ number_format($report->netBalance, 2) }}</td>
                <td>{{ $report->startDate }}</td>
                <td>{{ $report->endDate }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
