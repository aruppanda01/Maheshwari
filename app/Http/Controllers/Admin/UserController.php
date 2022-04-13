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
        $user->is_head_of_the_family = $request->family_head;
        $user->occupation = $request->occupation;
        $user->occupation_sector = $request->occupation_sector;
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
        $user->is_head_of_the_family = $request->family_head;
        $user->occupation = $request->occupation;
        $user->occupation_sector = $request->occupation_sector;
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

    // csv upload
    public function csvImport(Request $request)
    {
        if (!empty($request->file)) {
            // if ($request->input('submit') != null ) {
            $file = $request->file('file');
            // File Details
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $tempPath = $file->getRealPath();
            $fileSize = $file->getSize();
            $mimeType = $file->getMimeType();

            // Valid File Extensions
            $valid_extension = array("csv");
            // 50MB in Bytes
            $maxFileSize = 50097152;
            // Check file extension
            if (in_array(strtolower($extension), $valid_extension)) {
                // Check file size
                if ($fileSize <= $maxFileSize) {
                    // File upload location
                    $location = 'uploads/csv';
                    // Upload file
                    $file->move($location, $filename);
                    // Import CSV to Database
                    $filepath = public_path($location . "/" . $filename);
                    // Reading file
                    $file = fopen($filepath, "r");
                    $importData_arr = array();
                    $i = 0;
                    while (($filedata = fgetcsv($file, 10000, ",")) !== FALSE) {
                        $num = count($filedata);
                        // Skip first row
                        if ($i == 0) {
                            $i++;
                            continue;
                        }
                        for ($c = 0; $c < $num; $c++) {
                            $importData_arr[$i][] = $filedata[$c];
                        }
                        $i++;
                    }
                    fclose($file);

                    // echo '<pre>';print_r($importData_arr);exit();

                    // Insert into database
                    foreach ($importData_arr as $importData) {
                        // $storeData = 0;
                        // if(isset($importData[5]) == "Carry In") $storeData = 1;

                        $insertData = array(
                            "pkms_no" => isset($importData[0]) ? $importData[0] : null,
                            "abvp_no" => isset($importData[1]) ? $importData[1] : null,
                            "member_name" => isset($importData[2]) ? $importData[2] : null,
                            "father_or_husband_name" => isset($importData[3]) ? $importData[3] : null,
                            "gender" => isset($importData[4]) ? $importData[4] : null,
                            "dob" => isset($importData[5]) ? date('Y-m-d',strtotime($importData[5])) : null,
                            "aadhar_no" => isset($importData[6]) ? $importData[6] : null,
                            "qualification" => isset($importData[7]) ? $importData[7] : null,
                            "blood_group" => isset($importData[8]) ? $importData[8] : null,
                            "address" => isset($importData[9]) ? $importData[9] : null,
                            "city" => isset($importData[10]) ? $importData[10] : null,
                            "pin_code" => isset($importData[11]) ? $importData[11] : null,
                            "mobile_mo" => isset($importData[12]) ? $importData[12] : null,
                            "email" => isset($importData[13]) ? $importData[13] : null,
                            "password" => Hash::make('123')
                        );
                        // echo '<pre>';print_r($insertData);exit();
                        User::insertData($insertData);
                    }
                    Session::flash('message', 'Import Successful.');
                } else {
                    Session::flash('message', 'File too large. File must be less than 50MB.');
                }
            } else {
                Session::flash('message', 'Invalid File Extension. supported extensions are ' . implode(', ', $valid_extension));
            }
        } else {
            Session::flash('message', 'No file found.');
        }

        return redirect()->route('user.product.data.list');
    }
    // csv upload
}
