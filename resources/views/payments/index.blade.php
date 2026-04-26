@extends('layouts.app')

@section('content')
<h1>Payment Management</h1>

<h3>Recent Payments</h3>
<table class="data-table">
    <thead>
        <tr>
            <th>Transaction ID</th>
            <th>Customer Name</th>
            <th>Service</th>
            <th>Amount</th>
            <th>Payment Method</th>
            <th>Date</th>
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
            <td>{{ $payment->created_at->format('Y-m-d H:i') }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="6" style="text-align: center;">No payments recorded yet</td>
        </tr>
        @endforelse
    </tbody>
</table>

<hr>

<h3>Unpaid Appointments</h3>
<table class="data-table">
    <thead>
        <tr>
            <th>Customer Name</th>
            <th>Service</th>
            <th>Amount</th>
            <th>Appointment Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @php
            $unpaidAppointments = App\Models\Appointment::where('payment_status', 'Unpaid')->get();
        @endphp
        @forelse($unpaidAppointments as $appointment)
        <tr>
            <td>{{ $appointment->customer_name }}</td>
            <td>{{ $appointment->service->name }}</td>
            <td>{{ number_format($appointment->total_price, 2) }}</td>
            <td>{{ $appointment->appointment_date }}</td>
            <td>
                <a href="{{ route('payments.create', $appointment->id) }}" class="btn-success">Process Payment</a>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" style="text-align: center;">All appointments are paid</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection