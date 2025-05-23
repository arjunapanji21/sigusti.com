<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice #{{ $payment->id }}</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 14px;
            line-height: 1.4;
        }
        .container { padding: 40px; }
        .header {
            border-bottom: 1px solid #ddd;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }
        .flex { display: flex; }
        .justify-between { justify-content: space-between; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        .total {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 2px solid #ddd;
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>INVOICE</h1>
            <p>Transaction #{{ $payment->id }}</p>
            <p>Date: {{ $payment->created_at->format('M d, Y') }}</p>
        </div>

        <div class="details">
            <div>
                <strong>To:</strong><br>
                {{ $payment->user->name }}<br>
                {{ $payment->user->email }}
            </div>
            <br>
            <div>
                <strong>Payment Method:</strong><br>
                {{ ucfirst(str_replace('_', ' ', $payment->payment_method)) }}
            </div>
        </div>

        <table style="margin-top: 40px;">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Description</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $payment->plan->name }}</td>
                    <td>{{ $payment->payment_frequency == 'yearly' ? $payment->plan->duration_days * 12 : $payment->plan->duration_days }} days subscription</td>
                    <td>Rp. {{ number_format($payment->amount) }}</td>
                </tr>
            </tbody>
        </table>

        <div class="total">
            <h3>Total: Rp. {{ number_format($payment->amount) }}</h3>
            <p>Status: {{ ucfirst($payment->status) }}</p>
        </div>
    </div>
</body>
</html>
