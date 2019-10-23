<?php

namespace App\Helper;

class Helper
{
    public function getController($path)
    {
        $controller = strtolower($path);
        $controller = ucfirst($controller);
        $controller = "App\Controller\\" . $controller . "Controller";
        return $controller;
    }

    public static function validateFile($file)
    {
        $error = [];
        $html = '';
        if (empty($_FILES)){
            $html .= 'Field file is required';
            array_push($error, $html);
            return $html;
        }else {
            $size = ($file['fileToUpload']['size']);
            $max_size = 30000;
            if ($size > $max_size) {
                $html = '';
                $html .= "File size is too big";
                array_push($error, $html);
            }
            $acceptedExtensions = ['csv','txt','xlsx','xls'];
            $resume = ($_FILES['fileToUpload']['name']);
            $extension = strtolower(substr($resume, strpos($resume, '.') + 1));
//           strpos(original_str, search_str, start_pos)
//           substr(string_name, start_position, string_length_to_cut)
            if (!in_array($extension, $acceptedExtensions)){
                $html = '';
                $html .= 'Image file type is not allowed';
                array_push($error, $html);
            }
        }
        return $error;
    }
}