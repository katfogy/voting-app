<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\Member;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Response;

class accreditationController extends Controller
{
    public function index(){
        return view("practice_search.admin-upload-member");
    }

    public function upload(Request $request)
    {
        $request->validate([
            'excel' => 'required|file|mimes:xlsx,xls',
        ]);

        $file = $request->file('excel');
        $spreadsheet = IOFactory::load($file);
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();

        // Skip the header row
        unset($rows[0]);

        $inserted = 0;
        $skipped = 0;

        foreach ($rows as $row) {
            $lastName    = $row[1] ?? null;
            $firstName   = $row[2] ?? null;
            $chapter     = $row[3] ?? null;
            $category    = $row[4] ?? null;
            $practiceNo  = $row[0] ?? null;

            if (!$practiceNo) {
                $skipped++;
                continue;
            }

            // Skip if practice_no already exists
            if (Member::where('practice_no', $practiceNo)->exists()) {
                $skipped++;
                continue;
            }

            Member::create([
                'practice_no' => $practiceNo,
                'last_name'   => $lastName,
                'first_name'  => $firstName,
                'chapter'     => $chapter,
                'category'    => $category,
                'status'      => null,
                'passport'    => null,
            ]);

            $inserted++;
        }

        return back()->with('message', "$inserted members uploaded. $skipped skipped.");
    }


    public function allMembers()
    {
        $users = Member::whereNull('status')->paginate(10);
return view('practice_search.view-all-users', compact('users'));

    }


    public function search(Request $request)
{
    $q = $request->query('q');

    if (!$q) {
        return response()->json([]);
    }

    $users = Member::where('status', 'accredited')
        ->where(function ($query) use ($q) {
            $query->where('first_name', 'like', "%$q%")
                  ->orWhere('last_name', 'like', "%$q%")
                  ->orWhere('practice_no', 'like', "%$q%");
        })
        ->limit(10)
        ->get();

    return response()->json($users);
}



    public function showAccreditForm(Member $user)
    {
        return view('members.accredit', compact('user'));
    }

    public function savePhoto(Request $request, $id)
{
    $user = Member::findOrFail($id);

    $request->validate([
        'email' => 'required|email',
        'phone' => 'required',
    ]);

    $user->email = $request->email; // Save the email
    $user->phone = $request->phone;

    if ($request->filled('captured_photo')) {
        $data = $request->captured_photo;

        // Validate format
        if (strpos($data, ';') === false || strpos($data, ',') === false) {
            return back()->withErrors(['captured_photo' => 'Invalid image format']);
        }

        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);

        $data = base64_decode($data);

        $imageName = 'accreditation_' . $user->id . '_' . time() . '.png';
        $path = public_path('accreditation_photos');

        if (!file_exists($path)) {
            mkdir($path, 0755, true);
        }

        file_put_contents($path . '/' . $imageName, $data);

        $user->passport = 'accreditation_photos/' . $imageName;
    }

    // Even if no photo, still mark as accredited
    $user->status = 'accredited';
    $user->accredited_by = auth()->id();
    $user->save();

    return redirect()->route('all.members', $user->id)
                     ->with('message', 'Member accredited successfully!');
}



    public function accreditedMembers()
    {
        $users = Member::where('status','accredited')->paginate(10);
return view('practice_search.view-all-accredited-members', compact('users'));

    }


    public function searchnotcredited(Request $request)
{
    $q = $request->query('q');

    if (!$q) {
        return response()->json([]);
    }

    $users = Member::whereNull('status')
        ->where(function ($query) use ($q) {
            $query->where('first_name', 'like', "%$q%")
                  ->orWhere('last_name', 'like', "%$q%")
                  ->orWhere('practice_no', 'like', "%$q%");
        })
        ->limit(10)
        ->get();

    return response()->json($users);
}




public function exportAccredited()
    {
        $members = Member::where('status', 'accredited')
            ->get(['id', 'practice_no', 'last_name', 'first_name', 'phone', 'email', 'passport', 'chapter', 'status', 'updated_at']);

        $filename = 'accredited_members_' . date('Y-m-d') . '.csv';

        $handle = fopen('php://temp', 'r+');

        // Add the CSV header
        fputcsv($handle, ['Sno ID', 'Practice No', 'Last Name', 'First Name', 'Phone', 'Email', 'Passport', 'Chapter', 'Status', 'Accredited at']);

        // Add the member data
        foreach ($members as $member) {
            fputcsv($handle, [
                $member->id,
                $member->practice_no,
                $member->last_name,
                $member->first_name,
                $member->phone,
                $member->email,
                $member->passport,
                $member->chapter,
                $member->status,
                $member->updated_at,
            ]);
        }

        rewind($handle);
        $contents = stream_get_contents($handle);
        fclose($handle);

        return Response::make($contents, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$filename}",
        ]);
    }

}
