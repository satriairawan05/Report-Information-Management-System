<?php

namespace App\Http\Controllers\Admin;

use App\Models\Report;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    /**
     * Constructor for Controller.
     */
    public function __construct(private $name = 'Report', private $userRole = [], private $access = [], private $create = 0, private $read = 0, private $update = 0, private $delete = 0, private $download = 0, private $reqFolder = '')
    {
        //
    }

    /**
     * Generate Access for Controller.
     */
    public function get_access_page()
    {
        $this->userRole = $this->get_access($this->name, auth()->user()->role_id);

        foreach ($this->userRole as $r) {
            if ($r->page_name == $this->name) {
                if ($r->action == 'Create') {
                    $this->create = $r->access;
                }

                if ($r->action == 'Read') {
                    $this->read = $r->access;
                }

                if ($r->action == 'Update') {
                    $this->update = $r->access;
                }

                if ($r->action == 'Delete') {
                    $this->delete = $r->access;
                }

                // jika download di aktifkan uncomment pada bagian download ini
                // if ($r->action == 'Download') {
                //     $this->download = $r->access;
                // }
            }
        }

        // jika download di aktifkan uncomment pada bagian download ini
        return $this->access = [
            "Create" => (int) $this->create,
            "Read" => (int) $this->read,
            "Update" => (int) $this->update,
            "Delete" => (int) $this->delete,
            // "Download" => (int) $this->download
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $this->get_access_page();
            if ($this->read == 1) {
                $folderId = request()->input('folder_id');
                $year = request()->input('year');
                $month = request()->input('month');

                if (auth()->user()->role_id == 1) {
                    if ($month && $year && $folderId) {
                        $reports = Report::where('folder_id', $folderId)
                            ->where('year', $year)
                            ->where('month', $month)
                            ->latest('day')
                            ->get();

                        return view('admin.report.index4', [
                            'name' => $this->name,
                            'access' => $this->access,
                            'reports' => $reports,
                        ]);
                    }

                    if ($year && $folderId) {
                        $reports = Report::where('folder_id', $folderId)
                            ->where('year', $year)
                            ->get();

                        return view('admin.report.index3', [
                            'name' => $this->name,
                            'access' => $this->access,
                            'report' => $reports,
                        ]);
                    }

                    if ($folderId) {
                        $reports = Report::where('folder_id', $folderId)->get();

                        return view('admin.report.index2', [
                            'name' => $this->name,
                            'access' => $this->access,
                            'report' => $reports,
                        ]);
                    }

                    // Bagian ini tetap dipertahankan
                    $folders = \App\Models\Folder::with('user')->where('is_for_admin', true)
                        ->orWhere('user_id', auth()->user()->id)
                        ->latest('id')
                        ->paginate(8);

                    return view('admin.report.index', [
                        'name' => $this->name,
                        'folders' => $folders,
                    ]);
                } else {
                    if ($month && $year && $folderId) {
                        $reports = Report::where('folder_id', $folderId)
                            ->where('year', $year)
                            ->where('month', $month)
                            ->latest('day')
                            ->get();

                        return view('admin.report.index4', [
                            'name' => $this->name,
                            'access' => $this->access,
                            'reports' => $reports,
                        ]);
                    }

                    if ($year && $folderId) {
                        $reports = Report::where('folder_id', $folderId)
                            ->where('year', $year)
                            ->get();

                        return view('admin.report.index3', [
                            'name' => $this->name,
                            'access' => $this->access,
                            'report' => $reports,
                        ]);
                    }

                    if ($folderId) {
                        $reports = Report::where('folder_id', $folderId)->get();

                        return view('admin.report.index2', [
                            'name' => $this->name,
                            'access' => $this->access,
                            'report' => $reports,
                        ]);
                    }

                    // Bagian ini tetap sesuai permintaan
                    $folders = \App\Models\Folder::with('user')->where('user_id', auth()->user()->id)
                        ->latest('id')
                        ->paginate(8);

                    return view('admin.report.index', [
                        'name' => $this->name,
                        'folders' => $folders,
                    ]);
                }
            } else {
                return redirect()->back()->with('failed', 'You not Have Authority!');
            }
        } catch (\Illuminate\Database\QueryException $e) {
            \Illuminate\Support\Facades\Log::error($e->getMessage());
            return redirect()->back()->with('failed', $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $this->get_access_page();
            if ($this->create == 1) {
                return view('admin.report.create', [
                    'name' => $this->name,
                ]);
            } else {
                return redirect()->back()->with('failed', 'You not Have Authority!');
            }
        } catch (\Illuminate\Database\QueryException $e) {
            \Illuminate\Support\Facades\Log::error($e->getMessage());
            return redirect()->back()->with('failed', $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $this->get_access_page();
            if ($this->create == 1) {
                $validate = \Illuminate\Support\Facades\Validator::make($request->all(), [
                    'description' => 'required|max:255',
                    'documentation' => 'required|file|mimes:pdf,ppt,pptx,xls,xlsx,doc,docx,png,jpg,jpeg|max:5120'
                ]);

                if (!$validate->fails()) {
                    $fileDoc = $request->file('documentation');
                    $fileExtension = strtolower($fileDoc->getClientOriginalExtension());

                    $report = new Report;
                    $report->description = $request->input('description');
                    $report->folder_id = $request->input('folder_id');
                    $report->user_id = auth()->user()->id;
                    $report->year = date('Y');
                    $report->month = date('m');
                    $report->day = date('d');
                    $report->original_name = $fileDoc->getClientOriginalName();
                    $report->extension = $fileDoc->getClientOriginalExtension();
                    $report->size = $fileDoc->getSize() / 1024;
                    switch (true) {
                        case $fileExtension === 'pdf':
                            // Logika untuk file PDF
                            $report->documentation = $fileDoc->store('PortableDoc');
                            break;

                        case in_array($fileExtension, ['ppt', 'pptx']):
                            // Logika untuk file PPT
                            $report->documentation = $fileDoc->store('PowerPoint');
                            break;

                        case in_array($fileExtension, ['xls', 'xlsx']):
                            // Logika untuk file Excel
                            $report->documentation = $fileDoc->store('Excel');
                            break;

                        case in_array($fileExtension, ['doc', 'docx']):
                            $report->documentation = $fileDoc->store('Document');
                            // Logika untuk file Word
                            break;

                        case in_array($fileExtension, ['jpg', 'jpeg']):
                            $report->documentation = $fileDoc->store('Image');
                            // Logika untuk file JPG/JPEG
                            break;

                        case $fileExtension === 'png':
                            $report->documentation = $fileDoc->store('Picture');
                            // Logika untuk file PNG
                            break;

                        default:
                            // Jika jenis file tidak sesuai
                            return redirect()->back()
                                ->with('error', 'Unsupported file type.')
                                ->withInput();
                    }
                    $report->save();

                    return redirect()->to(route('report.index', ['folder_id' => $request->input('folder_id')]))->with('success', 'Report Created!');
                } else {
                    \Illuminate\Support\Facades\Log::error($validate->getMessageBag());
                    return redirect()->back()->withErrors($validate)->withInput();
                }
            } else {
                return redirect()->back()->with('failed', 'You not Have Authority!');
            }
        } catch (\Illuminate\Database\QueryException $e) {
            \Illuminate\Support\Facades\Log::error($e->getMessage());
            return redirect()->back()->with('failed', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Report $report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Report $report)
    {
        try {
            $this->get_access_page();
            if ($this->update == 1 && $report->user_id == auth()->user()->id) {
                return view('admin.report.edit', [
                    'name' => $this->name,
                    'report' => $report
                ]);
            } else {
                return redirect()->back()->with('failed', 'You not Have Authority!');
            }
        } catch (\Illuminate\Database\QueryException $e) {
            \Illuminate\Support\Facades\Log::error($e->getMessage());
            return redirect()->back()->with('failed', $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Report $report)
    {
        try {
            $this->get_access_page();
            if ($this->update == 1 && $report->user_id == auth()->user()->id) {
                $validate = \Illuminate\Support\Facades\Validator::make($request->all(), [
                    'description' => 'required|max:255',
                    'documentation' => 'required|file|mimes:pdf,ppt,pptx,xls,xlsx,doc,docx,png,jpg,jpeg|max:5120'
                ]);

                // dd($request->all());

                if (!$validate->fails()) {
                    $fileDoc = $request->file('documentation');
                    $fileExtension = strtolower($fileDoc->getClientOriginalExtension());

                    $report->descrption = $request->input('description');
                    $report->folder_id = $request->input('folder_id');
                    $report->user_id = auth()->user()->id;
                    $report->year = date('Y');
                    $report->month = date('m');
                    $report->day = date('d');
                    $report->original_name = $fileDoc->getClientOriginalName();
                    $report->extension = $fileDoc->getClientOriginalExtension();
                    $report->size = $fileDoc->getSize() / 1024;

                    // Hapus file lama jika ada
                    if ($fileDoc || $fileExtension !== $report->extension) {
                        \Illuminate\Support\Facades\Storage::delete($report->documentation);
                        switch (true) {
                            case $fileExtension === 'pdf':
                                // Logika untuk file PDF
                                $report->documentation = $fileDoc->store('PortableDoc');
                                break;

                            case in_array($fileExtension, ['ppt', 'pptx']):
                                // Logika untuk file PPT
                                $report->documentation = $fileDoc->store('PowerPoint');
                                break;

                            case in_array($fileExtension, ['xls', 'xlsx']):
                                // Logika untuk file Excel
                                $report->documentation = $fileDoc->store('Excel');
                                break;

                            case in_array($fileExtension, ['doc', 'docx']):
                                $report->documentation = $fileDoc->store('Document');
                                // Logika untuk file Word
                                break;

                            case in_array($fileExtension, ['jpg', 'jpeg']):
                                $report->documentation = $fileDoc->store('Image');
                                // Logika untuk file JPG/JPEG
                                break;

                            case $fileExtension === 'png':
                                $report->documentation = $fileDoc->store('Picture');
                                // Logika untuk file PNG
                                break;

                            default:
                                // Jika jenis file tidak sesuai
                                return redirect()->back()
                                    ->with('error', 'Unsupported file type.')
                                    ->withInput();
                        }
                    } else {
                        switch (true) {
                            case $fileExtension === 'pdf':
                                // Logika untuk file PDF
                                $report->documentation = $fileDoc->store('PortableDoc');
                                break;

                            case in_array($fileExtension, ['ppt', 'pptx']):
                                // Logika untuk file PPT
                                $report->documentation = $fileDoc->store('PowerPoint');
                                break;

                            case in_array($fileExtension, ['xls', 'xlsx']):
                                // Logika untuk file Excel
                                $report->documentation = $fileDoc->store('Excel');
                                break;

                            case in_array($fileExtension, ['doc', 'docx']):
                                $report->documentation = $fileDoc->store('Document');
                                // Logika untuk file Word
                                break;

                            case in_array($fileExtension, ['jpg', 'jpeg']):
                                $report->documentation = $fileDoc->store('Image');
                                // Logika untuk file JPG/JPEG
                                break;

                            case $fileExtension === 'png':
                                $report->documentation = $fileDoc->store('Picture');
                                // Logika untuk file PNG
                                break;

                            default:
                                // Jika jenis file tidak sesuai
                                return redirect()->back()
                                    ->with('error', 'Unsupported file type.')
                                    ->withInput();
                        }
                    }

                    $report->save();

                    return redirect()->to(route('report.index', ['folder_id' => $request->input('folder_id')]))->with('success', 'Report Updated!');
                } else {
                    \Illuminate\Support\Facades\Log::error($validate->getMessageBag());
                    return redirect()->back()->withErrors($validate->getMessageBag())->withInput();
                }
            } else {
                return redirect()->back()->with('failed', 'You not Have Authority!');
            }
        } catch (\Illuminate\Database\QueryException $e) {
            \Illuminate\Support\Facades\Log::error($e->getMessage());
            return redirect()->back()->with('failed', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Report $report)
    {
        try {
            $this->get_access_page();
            if ($this->delete == 1 && $report->user_id == auth()->user()->id) {

                if ($report->documentation && \Illuminate\Support\Facades\Storage::exists($report->documentation)) {
                    \Illuminate\Support\Facades\Storage::delete($report->documentation);
                }

                $report->delete();

                return redirect()->to(route('report.index'))->with('success', 'File ' . $report->original_name . ' Deleted!');
            } else {
                return redirect()->back()->with('failed', 'You not Have Authority!');
            }
        } catch (\Illuminate\Database\QueryException $e) {
            \Illuminate\Support\Facades\Log::error($e->getMessage());
            return redirect()->back()->with('failed', $e->getMessage());
        }
    }

    /**
     * Download the specified resource from storage.
     */
    public function download(Report $report)
    {
        try {
            $this->get_access_page();
            // jika download di aktifkan maka $this->read ubah jadi $this->download
            if ($this->read == 1) {
                $extension = ['pdf', 'ppt', 'pptx', 'xls', 'xlsx', 'doc', 'docx', 'png', 'jpg', 'jpeg'];

                if ($this->checkFiles($report->documentation, $extension)) {
                    return \Illuminate\Support\Facades\Storage::download($report->documentation, $report->original_name);
                }
            } else {
                return redirect()->back()->with('failed', 'You not Have Authority!');
            }
        } catch (\Illuminate\Database\QueryException $e) {
            \Illuminate\Support\Facades\Log::error($e->getMessage());
            return redirect()->back()->with('failed', $e->getMessage());
        }
    }

    /**
     * View the specified resource from storage.
     */
    public function view(Report $report)
    {
        try {
            $this->get_access_page();
            if ($this->read == 1) {
                ini_set('max_execution_time', 300);

                $mimeType = [
                    'pdf' => 'application/pdf',
                    'pptx' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
                    'ppt' => 'application/vnd.ms-powerpoint',
                ];

                if (strtolower($report->extension) == $mimeType['pdf']) {
                    $filePath = \Illuminate\Support\Facades\Storage::exists($report->documentation);
                    return redirect($filePath);
                }
            } else {
                return redirect()->back()->with('failed', 'You not Have Authority!');
            }
        } catch (\Illuminate\Database\QueryException $e) {
            \Illuminate\Support\Facades\Log::error($e->getMessage());
            return redirect()->back()->with('failed', $e->getMessage());
        }
    }
}
