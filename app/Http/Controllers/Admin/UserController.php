<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\InterestRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use App\Models\User;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Hash;

class UserController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::get();
        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate(
            $request,
            [
                'pkms_no' => 'required|max:255',
                'abvp_no' => 'nullable|max:255',
                'member_name' => 'required|max:255',
                'father_or_husband_name' => 'required|max:255',
                'gender' => 'required',
                'dob' => 'nullable',
                'ma' => 'nullable',
                'aadhar_no' => 'nullable|digits:12',
                'qualification' => 'nullable|max:255',
                'blood_group' => 'nullable|max:255',
                'address' => 'required|max:255',
                'city' => 'required|max:255',
                'pin_code' => 'required|digits:6',
                'email' => 'nullable|email',
                'mobile_mo' => 'nullable|digits:10|unique:users',
            ],
            [
                'pkms_no.required' => 'This field is required',
                'member_name.required' => 'This field is required',
                'father_or_husband_name.required' => 'This field is required',
                'gender.required' => 'This field is required',
                //     'dob.required' => 'This field is required',
                //     'ma.required' => 'This field is required',
                'address.required' => 'This field is required',
                'city.required' => 'This field is required',
                'pin_code.required' => 'This field is required',
                // 'email.required' => 'This field is required',
                'mobile_mo.digits' => 'Please enter 10 digits mobile no',
                'mobile_mo.unique' => 'Already exist',
            ]
        );

        $user = new User();
        $user->abvp_no = $request->abvp_no;
        $user->pkms_no = $request->pkms_no;
        $user->member_name = $request->member_name;
        $user->father_or_husband_name = $request->father_or_husband_name;
        $user->gender = $request->gender;
        $user->dob = $request->dob;
        $user->ma = $request->ma;
        $user->aadhar_no = $request->aadhar_no;
        $user->qualification = $request->qualification;
        $user->blood_group = $request->blood_group;
        $user->address = $request->address;
        $user->city = $request->city;
        $user->pin_code = $request->pin_code;
        $user->email = $request->email;
        $user->mobile_mo = $request->mobile_mo;
        $user->status = 0;
        $user->save();

        return $this->responseRedirect('admin.user.index', 'User has been created successfully', 'success', false, false);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request)
    {

        $userId = $request->id;

        User::where('id', $userId)->update([
            'status' => $request->status,
        ]);

        return response()->json(array('message' => 'User status has been successfully updated'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'abvp_no' => 'nullable|max:255',
                'pkms_no' => 'required|max:255',
                'member_name' => 'required|max:255',
                'father_or_husband_name' => 'required|max:255',
                'gender' => 'required',
                'dob' => 'nullable',
                'ma' => 'nullable',
                'aadhar_no' => 'nullable|max:255',
                'qualification' => 'nullable|max:255',
                'blood_group' => 'nullable|max:255',
                'address' => 'required|max:255',
                'city' => 'required|max:255',
                'pin_code' => 'required|max:255',
                'email' => 'nullable',
                'mobile_mo' => 'nullable|digits:10',
                // 'password' => 'required',
            ],
            [
                'pkms_no.required' => 'This field is required',
                'member_name.required' => 'This field is required',
                'father_or_husband_name.required' => 'This field is required',
                'gender.required' => 'This field is required',
                //     'dob.required' => 'This field is required',
                //     'ma.required' => 'This field is required',
                'address.required' => 'This field is required',
                'city.required' => 'This field is required',
                'pin_code.required' => 'This field is required',
                // 'email.required' => 'This field is required',
                'password.required' => 'This field is required',

            ]
        );

        // dd($request->all());
        $user =  User::find($id);
        $user->pkms_no = $request->pkms_no;
        $user->abvp_no = $request->abvp_no;
        $user->member_name = $request->member_name;
        $user->father_or_husband_name = $request->father_or_husband_name;
        $user->gender = $request->gender;
        $user->dob = $request->dob;
        $user->ma = $request->ma;
        $user->aadhar_no = $request->aadhar_no;
        $user->qualification = $request->qualification;
        $user->blood_group = $request->blood_group;
        $user->address = $request->address;
        $user->city = $request->city;
        $user->pin_code = $request->pin_code;
        $user->email = $request->email;
        $user->mobile_mo = $request->mobile_mo;
        $user->save();
        return $this->responseRedirect('admin.user.index', 'User details has been updated successfully', 'success', false, false);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::where('id', $id)->delete();
        return $this->responseRedirect('admin.user.index', 'User has been deleted successfully', 'success', false, false);
    }
}
