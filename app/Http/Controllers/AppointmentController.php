<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Service;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with('service')->orderBy('appointment_date', 'desc')->get();
        return view('appointments.index', compact('appointments'));
    }
    
    public function create()
    {
        $services = Service::all();
        return view('appointments.create', compact('services'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email',
            'customer_phone' => 'required|string|max:20',
            'service_id' => 'required|exists:services,id',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required'
        ]);
        
        $service = Service::findOrFail($request->service_id);
        
        $appointment = Appointment::create([
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_phone' => $request->customer_phone,
            'service_id' => $request->service_id,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'total_price' => $service->price,
            'payment_status' => 'Unpaid'
        ]);
        
        return redirect()->route('appointments.index')->with('success', 'Appointment booked successfully!');
    }
    
    public function show($id)
    {
        $appointment = Appointment::with('service')->findOrFail($id);
        return view('appointments.show', compact('appointment'));
    }
    
    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();
        return redirect()->route('appointments.index')->with('success', 'Appointment cancelled successfully!');
    }
}