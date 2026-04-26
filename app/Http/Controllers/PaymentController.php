<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('appointment')->orderBy('created_at', 'desc')->get();
        return view('payments.index', compact('payments'));
    }
    
    public function create($appointmentId)
    {
        $appointment = Appointment::with('service')->findOrFail($appointmentId);
        
        if ($appointment->payment_status === 'Paid') {
            return redirect()->route('payments.index')->with('error', 'This appointment is already paid!');
        }
        
        return view('payments.create', compact('appointment'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|string'
        ]);
        
        $appointment = Appointment::findOrFail($request->appointment_id);
        
        $payment = Payment::create([
            'appointment_id' => $request->appointment_id,
            'amount' => $request->amount,
            'payment_method' => $request->payment_method,
            'status' => 'Paid',
            'transaction_id' => 'TXN-' . Str::random(10) . time()
        ]);
        
        $appointment->update(['payment_status' => 'Paid']);
        
        return redirect()->route('payments.index')->with('success', 'Payment processed successfully!');
    }
    
    public function history()
    {
        $payments = Payment::with('appointment')->orderBy('created_at', 'desc')->paginate(10);
        return view('payments.history', compact('payments'));
    }
}