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
    $path = $_POST['directoryPath'];
    if(file_exists($path))
    {
        DirectoryTraversal($path);
        if($imageSize != 0)
        {
            $percentage = $imageSize / $dirSize;
            echo("Percentage = $percentage");
        }
        else
        {
            echo "This directory doesn't have image files";
        }
    }
    else
    {
        echo "Enter correct directory!";
    }
    //var_dump("Directory size  = $dirSize ");
    //var_dump("Image size = $imageSize ");


    function DirectoryTraversal($dirName)
    {
        global $dirSize,$imageSize;
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        if($handle = opendir($dirName))
        {
            while(FALSE !== ($file = readdir($handle)))
            {
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
        finfo_close($finfo);
    }
?>