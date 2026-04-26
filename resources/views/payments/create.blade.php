@extends('layouts.app')

@section('content')
<h1>Process Payment</h1>

<div style="background: #f8f9fa; padding: 20px; border-radius: 8px; margin-bottom: 20px;">
    <h3>Appointment Details</h3>
    <p><strong>Customer:</strong> {{ $appointment->customer_name }}</p>
    <p><strong>Service:</strong> {{ $appointment->service->name }}</p>
    <p><strong>Amount Due:</strong> {{ number_format($appointment->total_price, 2) }}</p>
    <p><strong>Appointment Date:</strong> {{ $appointment->appointment_date }}</p>
</div>

<form action="{{ route('payments.store') }}" method="POST">
    @csrf
    <input type="hidden" name="appointment_id" value="{{ $appointment->id }}">
    
    <div class="form-group">
        <label>Payment Amount:</label>
        <input type="text" name="amount" value="{{ $appointment->total_price }}" required>
    </div>
    
    <div class="form-group">
        <label>Payment Method:</label>
        <select name="payment_method" required>
            <option value="Cash">Cash</option>
            <option value="Credit Card">Credit Card</option>
            <option value="Debit Card">Debit Card</option>
            <option value="Bank Transfer">Bank Transfer</option>
        </select>
    </div>
    
    <button type="submit" class="btn-submit">Process Payment</button>
    <a href="{{ route('payments.index') }}" class="btn-back">Cancel</a>
</form>
@endsection