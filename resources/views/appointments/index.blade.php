@extends('layouts.app')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center;">
    <h1>Appointments</h1>
    <a href="{{ route('appointments.create') }}" class="btn-submit">New Booking</a>
</div>

<table class="data-table">
    <thead>
        <tr>
            <th>Customer Name</th>
            <th>Service</th>
            <th>Date & Time</th>
            <th>Total Price</th>
            <th>Payment Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($appointments as $appointment)
        <tr>
            <td>{{ $appointment->customer_name }}</td>
            <td>{{ $appointment->service->name }}</td>
            <td>{{ $appointment->appointment_date }} at {{ date('h:i A', strtotime($appointment->appointment_time)) }}</td>
            <td>{{ number_format($appointment->total_price, 2) }}</td>
            <td>
                @if($appointment->payment_status == 'Paid')
                    <span class="badge-paid">Paid</span>
                @else
                    <span class="badge-unpaid">Unpaid</span>
                @endif
            </td>
            <td>
                <a href="{{ route('appointments.show', $appointment->id) }}" class="btn-update" style="padding: 5px 10px; font-size: 14px;">View</a>
                @if($appointment->payment_status == 'Unpaid')
                    <a href="{{ route('payments.create', $appointment->id) }}" class="btn-success" style="padding: 5px 10px; font-size: 14px;">Process Payment</a>
                @endif
                <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-danger" onclick="return confirm('Cancel this appointment?')">Cancel</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" style="text-align: center;">No appointments found</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection