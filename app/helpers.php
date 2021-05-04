<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;



// this is the custom hash function to store password, $str contains the data sent from password field
// size tells how long should the hashed password be, characters contains all the possible combinations generated.
function custom_hash($str, $size = 30, $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ$.@,:-_+%')
{
    $hash_array = array();
    $hash = '';
    $size = $size + strlen($str);
    // creating a simple hash array with keys as 0
    for ($i = 0; $i < $size; $i++) {
        $hash_array[$i] = 0;
    }

    //replacing each 0 key with unique character with some logic
    for ($s = 0; $s < strlen($str); $s++) {
        for ($i = 0; $i < $size; $i++) {
            $hash_array[$i] = ($hash_array[$i] + ord($str[$s]) + $i + $s + $size) % strlen($characters);
        }
    }
    // combine all the characters
    for ($i = 0; $i < $size; $i++) {
        $hash .= $characters[$hash_array[$i]];
    }

    // return the obtained the hash
    return $hash;
}


function encrypt_string($string, $key = 5)
{
    $result = '';
    // Go through each character
    // Separate each character
    // Convert to ASCII
    // Append result and return it with encoding for extra security
    for ($i = 0, $k = strlen($string); $i < $k; $i++) {
        $char = substr($string, $i, 1);
        $keychar = substr($key, ($i % strlen($key)) - 1, 1);
        $char = chr(ord($char) + ord($keychar));
        $result .= $char;
    }
    return base64_encode($result);
}

function decrypt_string($string, $key = 5)
{
    // Decode the string
    // Go through each character
    // Separate each character
    // Convert to ASCII
    // Append result and return it
    $result = '';
    $string = base64_decode($string);
    for ($i = 0, $k = strlen($string); $i < $k; $i++) {
        $char = substr($string, $i, 1);
        $keychar = substr($key, ($i % strlen($key)) - 1, 1);
        $char = chr(ord($char) - ord($keychar));
        $result .= $char;
    }
    
    return $result;
}

if(!function_exists('storeFile')){
    function storeFile($file,$folderName='Page')
    {
//        If directory does not exist, create it
        if (!Storage::disk('public')->exists($folderName)) {
            Storage::disk('public')->makeDirectory($folderName);
        }

//        Assigns unique name to image/file
        $currentDate = Carbon::now()->toDateString();
        $filename = $currentDate . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
        $filemedia = File::get($file);
        Storage::disk('public')->put($folderName . '/' . $filename, $filemedia);
//        returns path to the image where it was stored
        return asset(Storage::url($folderName . '/' . $filename));
    }
}


if (!function_exists('renderPosts')) {
    function renderPosts($posts)
    {
        $data = '';
        foreach ($posts as $post) {
            $avatar = $post->user->avatar;
            $def = asset('assets/images/avatar.png');
            $pp = is_null($avatar) ? $def : $avatar;
            $name = $post->user->name;
            $data .= '<div class="central-meta item">';
            $data .= '<div class="user-post">';
            $data .= '<div class="friend-info">';
            if(Auth()->check() && auth()->user()->id==$post->user->id)
            {
                $data.=' <p><a href="'.route("post.delete",$post->id).'"><i class="fa fa-trash" aria-hidden="true" style="float:right"></i></a></p>';
            }
            $data .= '<figure>';
            $data .= '<img src="' . $pp . '">';
            $data .= '</figure>';
            $data .= '<div class="friend-name">';
            $data .= '<a href="' . route('timeline', $post->user->id) . '"';
            $data .= 'title="' . decrypt_string($post->user->name) . '">';
            $data .= '<b>';
            $data .= decrypt_string($name);
            $data .= '</b>';
            $data .= '</a>';

            $data .= '<span>published: ' . $post->created_at->diffForHumans() . '</span>';
            $data .= '</div>';
            $data .= '<div class="post-meta">';
            $data .= '<div class="description">';
            $data .= '<p>';

//            Decrypt the post and escape characters to show prevent sql injection
            $data .= htmlspecialchars(decrypt_string($post->post_body));
            $data .= '</p>';
            $data .= '</div>';
            $data .= '</div>';
            $data .= '</div>';

            $data .= '</div>';
            $data .= '</div>';
        }
        return $data;
    }
}
