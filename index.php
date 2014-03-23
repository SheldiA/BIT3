<?php
/**
 * Created by PhpStorm.
 * User: Anna
 * Date: 20.03.14
 * Time: 0:29
 */
    include 'appearance.html';
    $dirSize = 0;
    $imageSize = 0;
    $path = 'D:/bit3';
    var_dump(file_exists($path));
    DirectoryTraversal($path);
    var_dump("Directory size  = $dirSize ");
    var_dump("Image size = $imageSize ");
    $percentage = $imageSize / $dirSize;
    var_dump("Percentage = $percentage");

    function DirectoryTraversal($dirName)
    {
        global $dirSize,$imageSize;
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        if($handle = opendir($dirName))
        {
            while(FALSE !== ($file = readdir($handle)))
            {
                echo("$file\n");
                if(is_file("$dirName/$file"))
                {
                    $type = finfo_file($finfo,"$dirName/$file");
                    if(FALSE !== stripos($type,"image"))
                    {
                        $imageSize += filesize("$dirName/$file");
                    }
                    $dirSize += filesize("$dirName/$file");
                }
                elseif(is_dir("$dirName/$file") && $file != "." && $file != "..")
                    DirectoryTraversal("$dirName/$file");
            }
        }
        closedir($handle);
    }
?>