<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Constructor for Controller.
     */
    public function __construct(private $name = 'Profile', private $userRole = [], private $access = [], private $read = 0, private $update = 0)
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
                if ($r->action == 'Read') {
                    $this->read = $r->access;
                }

                if ($r->action == 'Update') {
                    $this->update = $r->access;
                }
            }
        }

        return $this->access = [
            "Read" => (int) $this->read,
            "Update" => (int) $this->update
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
                $userActive = User::select(['id','name','email','nip','rank','group','position','role_id'])->where('id', auth()->user()->id)->first();
                $roleUser = \App\Models\Group::select(['group_name'])->where('group_id', $userActive->group_id)->first();
                return view('admin.setting.profile.index', [
                    'name' => $this->name,
                    'userActive' => $userActive,
                    'roleUser' => $roleUser,
                    'access' => $this->access
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        try {
            $this->get_access_page();
            if ($this->update == 1) {
                $userActive = $user->find(request()->segment(3));
                $role = \App\Models\Group::get();

                return view('admin.setting.profile.edit',[
                    'name' => $this->name,
                    'userActive' => $userActive,
                    'roles' => $role
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
    public function update(Request $request, User $user)
    {
        try {
            $this->get_access_page();
            if ($this->update == 1) {
                $validated = \Illuminate\Support\Facades\Validator::make($request->all(),[
                    'name' => 'required|max:255',
                    'email' => 'required',
                    'password' => 'required|confirmed|unique:users,password',
                    'nip' => 'required|max:255',
                    'rank' => 'required|max:255',
                    'group' => 'required',
                    'position' => 'required|max:255',
                    'role_id' => 'required',
                ]);

                if (!$validated->fails()) {
                    dd($user->find(request()->segment(3)));
                    $userActive = $user->find(request()->segment(3));
                    $userActive->name = $request->input('name');
                    $userActive->email = $request->input('email');
                    $userActive->password = \Illuminate\Support\Facades\Hash::make($user->find(request()->segment(3)));
                    $userActive->nip = $request->input('nip');
                    $userActive->rank = $request->input('rank');
                    $userActive->group = $request->input('group');
                    $userActive->position = $request->input('position');
                    $userActive->role_id = $request->input('role_id');
                    $userActive->save();

                    return redirect()->to(route('profile.index'))->with('success','Data Updated!');
                } else {
                    \Illuminate\Support\Facades\Log::error($validated->getMessageBag());
                    return redirect()->back()->withErrors($validated->getMessageBag())->withInput();
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
    public function destroy(User $user)
    {
        //
    }
}
