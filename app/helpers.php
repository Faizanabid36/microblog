<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

function encrypt_string($string, $key = 5)
{
    $result = '';
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
        if (!Storage::disk('public')->exists($folderName)) {
            Storage::disk('public')->makeDirectory($folderName);
        }

        $currentDate = Carbon::now()->toDateString();
        $filename = $currentDate . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
        $filemedia = File::get($file);
        Storage::disk('public')->put($folderName . '/' . $filename, $filemedia);
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
            $data .= '<figure>';
            $data .= '<img src="' . $pp . '">';
            $data .= '</figure>';
            $data .= '<div class="friend-name">';
            $data .= '<a href="time-line.html"';
            $data .= 'title="">';
            $data .= '<b>';
            $data .= $name;
            $data .= '</b>';
            $data .= '</a>';

            $data .= '<span>published: ' . $post->created_at->diffForHumans() . '</span>';
            $data .= '</div>';
            $data .= '<div class="post-meta">';
            $data .= '<div class="description">';
            $data .= '<p>';
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
