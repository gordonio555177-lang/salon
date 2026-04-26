@extends('layouts.app')

@section('content')
<h1>Appointment Details</h1>

<div style="background: #f8f9fa; padding: 20px; border-radius: 8px;">
    <p><strong>Customer Name:</strong> {{ $appointment->customer_name }}</p>
    <p><strong>Customer Email:</strong> {{ $appointment->customer_email }}</p>
    <p><strong>Customer Phone:</strong> {{ $appointment->customer_phone }}</p>
    <p><strong>Service Selected:</strong> {{ $appointment->service->name }}</p>
    <p><strong>Service Duration:</strong> {{ $appointment->service->duration }}</p>
    <p><strong>Service Description:</strong> {{ $appointment->service->description ?? 'N/A' }}</p>
    <p><strong>Date and Time:</strong> {{ $appointment->appointment_date }} at {{ date('h:i A', strtotime($appointment->appointment_time)) }}</p>
    <p><strong>Price:</strong> {{ number_format($appointment->total_price, 2) }}</p>
    <p><strong>Payment Status:</strong> 
        @if($appointment->payment_status == 'Paid')
            <span class="badge-paid">Paid</span>
        @else
            <span class="badge-unpaid">Unpaid</span>
        @endif
    </p>
</div>

<div style="margin-top: 20px;">
    <a href="{{ route('appointments.index') }}" class="btn-back">Back to Appointments</a>
    @if($appointment->payment_status == 'Unpaid')
        <a href="{{ route('payments.create', $appointment->id) }}" class="btn-submit">Process Payment</a>
    @endif
</div>
@endsection