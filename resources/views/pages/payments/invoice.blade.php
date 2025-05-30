<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice #{{ $payment->id }}</title>
    <style>
        body {
            font-family: 'Helvetica', sans-serif;
            font-size: 14px;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            padding: 40px;
            max-width: 800px;
            margin: 0 auto;
        }
        .header {
            padding-bottom: 30px;
            margin-bottom: 30px;
            border-bottom: 2px solid #22c55e;
        }
        .logo {
            width: 90px;
        }
        .invoice-info {
            text-align: right;
        }
        .invoice-details {
            margin-bottom: 40px;
        }
        .invoice-id {
            color: #22c55e;
            font-size: 24px;
            margin: 0;
        }
        .grid {
            width: 100%;
            margin-bottom: 40px;
            border-spacing: 40px 0;
        }
        .grid td {
            width: 50%;
            vertical-align: top;
            padding: 20px;
            background: #f9fafb;
            border-radius: 8px;
        }
        .info-block h4 {
            margin: 0 0 10px;
            color: #6b7280;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.05em;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 40px 0;
            background: white;
        }
        th {
            background: #f9fafb;
            padding: 12px 15px;
            text-align: left;
            font-weight: 600;
            color: #374151;
            border-bottom: 2px solid #e5e7eb;
        }
        td {
            padding: 12px 15px;
            border-bottom: 1px solid #e5e7eb;
        }
        .amount {
            font-family: monospace;
        }
        .total {
            text-align: right;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px solid #e5e7eb;
        }
        .total-amount {
            font-size: 24px;
            color: #22c55e;
            font-weight: bold;
        }
        .status {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 9999px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            background: #dcfce7;
            color: #166534;
        }
        .status.pending { background: #fef3c7; color: #92400e; }
        .status.rejected { background: #fee2e2; color: #991b1b; }
        .footer {
            margin-top: 60px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            text-align: center;
            color: #6b7280;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <table class="grid">
                <tr>
                    <td>
                        <img src="{{ public_path('logo.png') }}" alt="Logo" class="logo">
                    </td>
                    <td>
                        <div class="invoice-info">
                            <h1 class="invoice-id">Invoice #{{ $payment->reference_number }}</h1>
                            <p>Generated on {{ $payment->created_at->format('F d, Y') }}</p>
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        <table class="grid">
            <tr>
                <td>
                    <h4>Billed To</h4>
                    <p>
                        <strong>{{ $payment->user->name }}</strong><br>
                        {{ $payment->user->email }}<br>
                        {{ $payment->user->phone ?? '' }}
                    </p>
                </td>
                <td>
                    <h4>Payment Details</h4>
                    <p>
                        <strong>Method:</strong> {{ $payment->paymentMethod->provider }}<br>
                        <strong>Account:</strong> {{ $payment->paymentMethod->account_number }}<br>
                        <strong>Account Name:</strong> {{ $payment->paymentMethod->account_name }}
                    </p>
                </td>
            </tr>
        </table>

        <table>
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Period</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <strong>{{ $payment->plan->name }}</strong><br>
                        <small>{{ number_format($payment->plan->daily_limit) }} daily messages, {{ $payment->plan->max_device }} devices</small>
                    </td>
                    <td>
                        {{ ucfirst($payment->payment_frequency) }} Plan<br>
                        <small>{{ $payment->payment_frequency == 'yearly' ? $payment->plan->duration_days * 12 : $payment->plan->duration_days }} days</small>
                    </td>
                    <td class="amount">Rp {{ number_format($payment->amount_before_tax) }}</td>
                </tr>
                <tr>
                    <td colspan="2" class="text-right">Tax (11%)</td>
                    <td class="amount">Rp {{ number_format($payment->tax_amount) }}</td>
                </tr>
            </tbody>
        </table>

        <div class="total">
            <p>Total Amount (Including Tax)</p>
            <h2 class="total-amount">Rp {{ number_format($payment->amount) }}</h2>
            <span class="status {{ strtolower($payment->status) }}">
                {{ ucfirst(str_replace('_', ' ', $payment->status)) }}
            </span>
        </div>

        <div class="footer">
            <p>Thank you for your business!</p>
            <p>If you have any questions, please contact our support team.</p>
        </div>
    </div>
</body>
</html>
