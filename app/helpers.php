<?php
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

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