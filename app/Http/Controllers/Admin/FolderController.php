<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Folder;
use Illuminate\Http\Request;

class FolderController extends Controller
{
    /**
     * Constructor for Controller.
     */
    public function __construct(private $name = 'Folder', private $userRole = [], private $access = [], private $create = 0, private $read = 0, private $update = 0, private $delete = 0)
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
            }
        }

        return $this->access = [
            "Create" => (int) $this->create,
            "Read" => (int) $this->read,
            "Update" => (int) $this->update,
            "Delete" => (int) $this->delete
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
                if (auth()->user()->role_id == 1) {
                    // Admin: Ambil folder untuk admin atau milik user
                    $folders = Folder::with('user')
                        ->where(function ($query) {
                            $query->where('is_for_admin', true)
                                ->orWhere('user_id', auth()->user()->id);
                        })
                        ->latest('id')
                        ->paginate(8);
                } else {
                    // User biasa: Hanya ambil folder milik user yang sedang login
                    $folders = Folder::with('user')
                        ->where('user_id', auth()->user()->id)
                       
                        ->paginate(8);
                }

                foreach ($folders as $folder) {
                    $reportCount = \App\Models\Report::where('folder_id', $folder->id)->where('user_id', auth()->user()->id)->count();
                }

                return view('admin.folder.index', [
                    'name' => $this->name,
                    'access' => $this->access,
                    'folders' => $folders,
                    'reportCount' => $reportCount
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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $this->get_access_page();
            if ($this->create == 1) {
                return view('admin.folder.create', [
                    'name' => $this->name
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
                    'name' => 'required|max:255',
                ]);

                if (!$validate->fails()) {
                    Folder::create([
                        'name' => $request->input('name'),
                        'user_id' => auth()->user()->id,
                        'is_for_admin' => $request->input('is_for_admin') == "on" ? 1 : 0,
                    ]);

                    return redirect()->to(route('folder.index'))->with('success', 'Folder Created!');
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
    public function show(Folder $folder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Folder $folder)
    {
        try {
            $this->get_access_page();
            if ($this->update == 1) {
                return view('admin.folder.edit', [
                    'name' => $this->name,
                    'folder' => $folder
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
    public function update(Request $request, Folder $folder)
    {
        try {
            $this->get_access_page();
            if ($this->update == 1) {
                $validate = \Illuminate\Support\Facades\Validator::make($request->all(), [
                    'name' => 'required|max:255',
                ]);

                if (!$validate->fails()) {
                    Folder::where('id', $folder->id)->update([
                        'name' => $request->input('name'),
                        'user_id' => auth()->user()->id,
                        'is_for_admin' => $request->input('is_for_admin') == "on" ? 1 : 0,
                    ]);

                    return redirect()->to(route('folder.index'))->with('success', 'Folder Updated!');
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
     * Remove the specified resource from storage.
     */
    public function destroy(Folder $folder)
    {
        try {
            $this->get_access_page();
            if ($this->delete == 1) {
                if ($folder->is_for_admin == true) {
                    $folder->delete();

                    return redirect()->to(route('folder.index'))->with('success', 'Folder ' . $folder->name . ' Deleted!');
                } else if ($folder->user_id == auth()->user()->id) {
                    $folder->delete();

                    return redirect()->to(route('folder.index'))->with('success', 'Folder ' . $folder->name . ' Deleted!');
                } else {
                    return redirect()->route('folder.index')->with('failed', 'You do not have permission to delete this folder.');
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
