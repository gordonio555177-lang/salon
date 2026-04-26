@extends('layouts.app')

@section('content')
<h1>Payment History</h1>

<table class="data-table">
    <thead>
        <tr>
            <th>Transaction ID</th>
            <th>Customer Name</th>
            <th>Service</th>
            <th>Amount</th>
            <th>Payment Method</th>
            <th>Status</th>
            <th>Payment Date</th>
        </tr>
    </thead>
    <tbody>
        @forelse($payments as $payment)
        <tr>
            <td>{{ $payment->transaction_id }}</td>
            <td>{{ $payment->appointment->customer_name }}</td>
            <td>{{ $payment->appointment->service->name }}</td>
            <td>{{ number_format($payment->amount, 2) }}</td>
            <td>{{ $payment->payment_method }}</td>
            <td><span class="badge-paid">{{ $payment->status }}</span></td>
            <td>{{ $payment->created_at->format('Y-m-d H:i:s') }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="7" style="text-align: center;">No payment history found</td>
        </tr>
        @endforelse
    </tbody>
</table>

<div style="margin-top: 20px;">
    {{ $payments->links() }}
</div>
@endsection