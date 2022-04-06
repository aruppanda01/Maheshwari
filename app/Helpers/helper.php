<?php

function randomGenerator()
{
    return uniqid() . '' . date('ymdhis') . '' . uniqid();
}

function imageUpload($image, $folder = 'image')
{
    $random = randomGenerator();
    $image->move('upload/' . $folder . '/', $random . '.' . $image->getClientOriginalExtension());
    $imageurl = 'upload/' . $folder . '/' . $random . '.' . $image->getClientOriginalExtension();
    // dd($imageurl);
    return $imageurl;
}


function createNotification($user,$type)
{
	$title = '';
	$message = '';
	$route = '';
	switch ($type) {
		case 'profile_update':
			$title = 'Profile updated';
			$message = 'Profile update successfully';
			break;
        case 'registration_success':
                $title = 'Registration successfully';
                $message = 'You have successfully registered';
                break;
	}
	$notification = [];
    $notification[] = [
        'user_id' => $user,
        'type' => $type,
        'title' => $title,
        'message' => $message,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
    ];
	if (count($notification) > 0) {
		\App\Models\Notification::insert($notification);
	}
	return $notification;
}