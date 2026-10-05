<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Http\Requests\StoreContactMessageRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class ContactController extends Controller
{
    /**
     * Show the contact form.
     */
    public function create()
    {
        return view('pages.contact');
    }

    /**
     * Store a new contact message.
     */
    public function store(StoreContactMessageRequest $request)
    {
        $data = $request->validated();
        
        $data['subject'] = 'General Inquiry';

        // Attach user if logged in
        if (auth()->check()) {
            $data['user_id'] = auth()->id();
        }

        $contactMessage = ContactMessage::create($data);

        // Notify all admins
        $admins = \App\Models\User::where('role', 'admin')->get();
        Notification::send($admins, new \App\Notifications\NewContactMessageNotification($contactMessage));

        return back()->with('success', 'Thank you for reaching out! We\'ve received your message and will get back to you within 24 hours.');
    }

    // ─── Admin Methods ───────────────────────────────────────────

    /**
     * Admin: list all contact messages.
     */
    public function adminIndex(Request $request)
    {
        $query = ContactMessage::latest();

        // Filter by status
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Search by name, email or subject
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%");
            });
        }

        $messages = $query->get();

        $stats = [
            'total'    => ContactMessage::count(),
            'new'      => ContactMessage::where('status', 'new')->count(),
            'read'     => ContactMessage::where('status', 'read')->count(),
            'replied'  => ContactMessage::where('status', 'replied')->count(),
            'archived' => ContactMessage::where('status', 'archived')->count(),
        ];

        return view('admin.contact-messages', compact('messages', 'stats'));
    }

    /**
     * Admin: view a single message detail.
     */
    public function adminShow($id)
    {
        $contactMessage = ContactMessage::with('user')->findOrFail($id);

        // Auto-mark as read when admin opens it
        if ($contactMessage->status === 'new') {
            $contactMessage->markAsRead();
        }

        return view('admin.contact-message-detail', compact('contactMessage'));
    }

    /**
     * Admin: update message status.
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:new,read,replied,archived',
        ]);

        $message = ContactMessage::findOrFail($id);

        if ($request->status === 'replied' && $message->status !== 'replied') {
            $message->markAsReplied();
        } elseif ($request->status === 'archived') {
            $message->archive();
        } else {
            $message->update(['status' => $request->status]);
        }

        return back()->with('success', 'Message status updated.');
    }

    /**
     * Admin: add internal notes.
     */
    public function addNotes(Request $request, $id)
    {
        $request->validate([
            'admin_notes' => 'required|string|max:1000',
        ]);

        $message = ContactMessage::findOrFail($id);
        $message->update(['admin_notes' => $request->admin_notes]);

        return back()->with('success', 'Notes saved successfully.');
    }

    /**
     * Admin: delete a contact message.
     */
    public function destroy($id)
    {
        ContactMessage::findOrFail($id)->delete();
        return redirect('/admin/contact-messages')->with('success', 'Message deleted.');
    }
}
