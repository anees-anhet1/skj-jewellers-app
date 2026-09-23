<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    // Customer submits the form (public, no login needed)
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email',
            'store' => 'required|string',
            'appointment_date' => 'required|date',
            'message' => 'nullable|string',
        ]);

        Appointment::create($request->only('name', 'phone', 'email', 'store', 'appointment_date', 'message'));

        return back()->with('success', 'Appointment request sent! We will contact you shortly.');
    }

    // Admin views all requests
    public function adminIndex()
    {
        $appointments = Appointment::latest()->get();
        return view('admin.appointments', compact('appointments'));
    }
}