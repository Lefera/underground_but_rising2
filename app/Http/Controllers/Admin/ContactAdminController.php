<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactAdminController extends Controller
{
    public function index()
    {
        $contacts = Contact::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.contacts.index', compact('contacts'));
    }

    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        return view('admin.contacts.show', compact('contact'));
    }

    public function destroy($id)
    {
        Contact::findOrFail($id)->delete();
        return back()->with('success', 'Message supprimé.');
    }

    public function stats()
    {
        $stats = Contact::select(
            DB::raw('COUNT(*) as total'),
            DB::raw('MONTH(created_at) as month')
        )
        ->groupBy('month')
        ->orderBy('month')
        ->get();

        return view('admin.contacts.stats', compact('stats'));
    }
}

