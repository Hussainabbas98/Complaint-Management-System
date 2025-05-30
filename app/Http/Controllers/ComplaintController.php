<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Complaint;

class ComplaintController extends Controller
{
    // Show form
    public function create()
    {
        return view('complaints.create');
    }

    // Handle submission
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        // Complaint::create($request->all());
        $complaint = new Complaint();
        $complaint->name = $request->name;
        $complaint->email = $request->email;
        $complaint->message = $request->message;
        $complaint->complaint_id = strtoupper(Str::random(8)); // Example: 8-char ID
        $complaint->save();
        return redirect()->back()->with('success', 'Complaint submitted! Your Complaint ID is: ' . $complaint->complaint_id);

        // return redirect()->back()->with('success', 'Complaint submitted successfully!');
    }

    // Admin Dashboard
    public function dashboard()
    {
        $totalCount = Complaint::count();
        $newCount = Complaint::where('status', 'new')->count();
        $pendingCount = Complaint::where('status', 'pending')->count();
        $approvedCount = Complaint::where('status', 'approved')->count();

        $complaints = Complaint::latest()->get();
        // $complaints = Complaint::latest()->paginate(10);


        return view('admin.dashboard', compact('totalCount', 'newCount', 'pendingCount', 'approvedCount', 'complaints'));
    }
    public function search(Request $request)
    {
        $query = $request->input('q');

        $complaints = Complaint::where('complaint_id', 'LIKE', "%$query%")->get();
        $totalCount = Complaint::count();
        $newCount = Complaint::where('status', 'new')->count();
        $pendingCount = Complaint::where('status', 'pending')->count();
        $approvedCount = Complaint::where('status', 'approved')->count();
        return view('admin.dashboard', compact(
            'complaints',
            'totalCount',
            'newCount',
            'pendingCount',
            'approvedCount'
        ));
    }


    public function updateStatus(Request $request, $id)
    {
        $complaint = Complaint::findOrFail($id);
        $complaint->status = $request->status;
        $complaint->admin_comment = $request->admin_comment;
        $complaint->save();

        return redirect()->back()->with('success', 'Status updated.');
    }


    public function searchForm()
    {
        return view('complaints.search');
    }

    public function searchResult(Request $request)
    {
        $request->validate([
            'complaint_id' => 'required'
        ]);

        $complaint = Complaint::where('complaint_id', $request->complaint_id)->first();

        if (!$complaint) {
            return back()->with('error', 'Complaint ID not found.');
        }
        return view('complaints.result', ['complaint' => $complaint]);
        // return view('complaints.result', compact('complaint'));
    }

    public function searchOnCreate(Request $request)
    {
        $request->validate([
            'complaint_id' => 'required'
        ]);

        $complaint = Complaint::where('complaint_id', $request->complaint_id)->first();

        if (!$complaint) {
            return redirect()->back()->with('error', 'Complaint ID not found.');
        }

        return redirect()->back()->with('complaint_status', $complaint);
    }

}

