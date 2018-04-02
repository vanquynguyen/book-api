<?php
namespace App\Helpers;
class Helper
{
    public static function importFile($file, $path)
    {
        if (isset($file)) {
            $file_name = $file->hashName();
            $file->move($path, $file_name);
            return $file_name;
        }
    }

    public static function messageException($error = false, $data = [], $message = [], $status = '200')
    {
        return [
            'error' => $error,
            'data' => $data,
            'message' => $message,
            'status' => $status,
        ];
    }
    
    public static function upload($file, $path)
    {
        if (!$file) {
            $filename = config('settings.defaultAvatar');
        } else {
            $filename = $file->getClientOriginalName();
            $file->move($path, $filename);
        }
        return $filename;
    }
}
