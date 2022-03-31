<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Password;

class UserController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function registerApi(Request $request)
    {
        return response()->json(["status" => 200]);
    }

    /**
     * Register a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'memberName' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }


        $memberName = $request->memberName;
        $email    = $request->email;
        $password = $request->password;

        $user = new User();
        $user->member_name = $memberName;
        $user->email = $email;
        $user->password = $password;
        $user->save();
        return response()->json([
            "status" => 200,
            "message" => "Registration Successful",
            "data" => $user,
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required|string',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $success['name'] =  $user->name;
            return response()->json([
                "status" => 200,
                "message" => "Login Succesfull",
                "data" => $user,
            ]);
        }
        return response()->json([
            "status" => 400,
            "message" => "Unauthorised",
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = array();
        $data['user_details'] = User::find($id);

        if (is_null($data['user_details'])) {
            return $this->sendError('Members not found');
        }

        $pkms_no = $data['user_details']->pkms_no;
        $data['family_members'] = User::where('pkms_no', $pkms_no)->where('id', '!=', $id)->get();

        return response()->json([
            "status" => 200,
            "message" => "User Details",
            "data" => $data,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // validate response
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'member_name' => 'nullable|max:255',
            'about_us' => 'nullable|max:255',
            'address' => 'nullable|max:255',
            'city' => 'nullable|max:255',
            'pin_code' => 'nullable|max:255',
            'mobile_mo' => 'nullable|digits:10',
            'pkms_no' => 'nullable|max:255',
            'abvp_no' => 'nullable|max:255',
            'father_or_husband_name' => 'nullable|max:255',
            'gender' => 'nullable|max:255',
            'dob' => 'nullable|date',
            'aadhar_no' => 'nullable|max:255',
            'qualification' => 'nullable|max:255',
            'blood_group' => 'nullable|max:255',
            'relationship' => 'nullable|max:255',
            'occupation' => 'nullable|max:255',
            'occupation_sector' => 'nullable|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg',
        ]);

        // validation check
        if ($validator->fails()) {
            return response()->json(['status' => 400, 'message' => 'Something happened', 'data' => $validator->errors()->first()]);
        } else {
            // error handling
            try {
                
                $user_details = User::find($request->id);
                if ($request->member_name) {
                    $user_details->member_name = $request->member_name; 
                }
                if ($request->pkms_no) {
                    $user_details->pkms_no = $request->pkms_no; 
                }
                if ($request->abvp_no) {
                    $user_details->abvp_no = $request->abvp_no; 
                }
                if ($request->father_or_husband_name) {
                    $user_details->father_or_husband_name = $request->father_or_husband_name; 
                }
                if ($request->gender) {
                    $user_details->gender = $request->gender;
                }
                if ($request->dob) {
                    $user_details->dob = date('Y-m-d',strtotime($request->dob));
                }
                if ($request->ma) {
                    $user_details->ma =  date('Y-m-d',strtotime($request->ma));
                }
                if ($request->aadhar_no) {
                    $user_details->aadhar_no = $request->aadhar_no;
                }
                if ($request->qualification) {
                    $user_details->qualification = $request->qualification;
                }
                if ($request->blood_group) {
                    $user_details->blood_group = $request->blood_group;
                }
                if ($request->relationship) {
                    $user_details->relationship = $request->relationship;
                }
                if ($request->occupation) {
                    $user_details->occupation = $request->occupation;
                }
                if ($request->occupation_sector) {
                    $user_details->occupation_sector = $request->occupation_sector;
                }
                if ($request->city) {
                    $user_details->city = $request->city;
                }
                if ($request->pin_code) {
                    $user_details->pin_code = $request->pin_code;
                }
                if ($request->about_us) {
                    $user_details->about_us = $request->about_us;
                }
                if ($request->mobile_no) {
                    $user_details->mobile_mo = $request->mobile_no;
                }
                if ($request->image) {
                    $user_details->image = imageUpload($request->image, 'profile_pic');
                }
                $user_details->save();
                if ($user_details) {
                    return response()->json(['status' => 200, 'message' => 'Profile updated successfully', 'data' => $user_details]);
                } else {
                    return response()->json(['status' => 400, 'message' => 'Something happened', 'data' => 'Data update failure']);
                }
            } catch (\Throwable $error) {
                return response()->json(['status' => 400, 'message' => 'Something happened', 'data' => $error]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function changePassword(Request $request)
    {
        $input = $request->all();

        $user = User::where('id', $request->id)->first();


        $validator = Validator::make(
            $request->all(),
            [
                'old_password' => 'required',
                'new_password' => 'required|min:6',
                'confirm_password' => 'required|same:new_password',
            ]
        );

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        } else {
            try {
                if ((Hash::check(request('old_password'), $user->password)) == false) {
                    return response()->json([
                        "status" => 400,
                        "data" => array(),
                        "message" => "Please enter right password."
                    ]);
                } else if ((Hash::check(request('new_password'), $user->password)) == true) {
                    return response()->json([
                        "status" => 400,
                        "data" => array(),
                        "message" => "Please enter a password which is not similar then current password."
                    ]);
                } else {
                    User::where('id', $user->id)->update(['password' => Hash::make($input['new_password'])]);
                    return response()->json([
                        "status" => 200,
                        "data" => array(),
                        "message" => "Password updated successfully."
                    ]);
                }
            } catch (\Exception $ex) {
                if (isset($ex->errorInfo[2])) {
                    $msg = $ex->errorInfo[2];
                } else {
                    $msg = $ex->getMessage();
                }
                return response()->json([
                    "status" => 400,
                    "data" => array(),
                    "message" => $msg
                ]);
            }
        }
        // return Response::json($arr);
    }
    // forget password
    public function forgot()
    {
        $credentials = request()->validate(['phone' => 'required|digits:10|integer']);

        Password::sendResetLink($credentials);

        return response()->json(["msg" => 'Reset password link sent on your phone id.']);
    }

    public function socialLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $userEmail = User::where('email', $request->email)->first();
        if ($userEmail) {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $user = Auth::user();
                $success['name'] =  $user->name;
                return response()->json([
                    "status" => 200,
                    "message" => "Login Successful",
                ]);
            }
        } else {

            $fName = $request->fName;
            $lName = $request->lName;
            $email    = $request->email;
            $password = $request->password;

            $user     = User::create([
                'fName' => $fName,
                'lName' => $lName,
                'email' => $email,
                'password' => Hash::make($password),
            ]);

            if (Auth::attempt(['email' => $email, 'password' => $password, 'fName' => $fName,  'lName' => $lName,])) {
                $user = Auth::user();
                $success['name'] =  $user->name;
                return response()->json([
                    "status" => 200,
                    "message" => "Login Succesfully",
                ]);
            }
        }

        return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
    }
}