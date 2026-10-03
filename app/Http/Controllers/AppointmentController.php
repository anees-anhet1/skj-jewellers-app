<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Http\Requests\StoreAppointmentRequest;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function create(Request $request)
    {
        $product = null;
        if ($request->has('product_id')) {
            $product = \App\Models\Product::find($request->product_id);
        }
        return view('pages.book-appointment', compact('product'));
    }

    public function store(StoreAppointmentRequest $request)
    {
        $data = $request->validated();
        if (auth()->check()) {
            $data['user_id'] = auth()->id();
        }
        
        $appointment = Appointment::create($data);

        // Notify admins
        $admins = \App\Models\User::where('role', 'admin')->get();
        \Illuminate\Support\Facades\Notification::send($admins, new \App\Notifications\NewAppointmentNotification($appointment));

        return back()->with('success', 'Appointment request sent! We will contact you shortly.');
    }

    // Admin views all requests
    public function adminIndex()
    {
        $appointments = Appointment::with('product')->latest()->get();
        return view('admin.appointments', compact('appointments'));
    }

    // Admin deletes an appointment
    public function destroy($id)
    {
        Appointment::findOrFail($id)->delete();
        return back()->with('success', 'Appointment deleted.');
    }
}