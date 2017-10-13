<?php

class AssetsModel extends AppModel {
    
    public function display($cacheid, $url, $forceDownload=false, $filename='') {
        
        // Search for the extension of the file
        $ext = substr($url, 0, strpos($url, "?"));
        $ext = substr($ext, strrpos($ext, ".") + 1); 
        
        // Read the data from the cache
        $data = Cache::read($cacheid);
        if (empty($data)) {
            $data = $this->_getContainer($url);
            Cache::write($cacheid, $data);
        }
        
        // Send the correct Content-Type header
        if ($ext == "jpg"){
            header('Content-type: image/jpeg');
        } else if ($ext == "gif") {
            header('Content-type: image/gif');
        } else if (substr($data, 0, 2) == "PK") {
            header('Content-type: application/zip');
            $ext = 'zip';
        } else {
            header("Content-Type: application/pdf");
            $ext = 'pdf';
        }
        
        // Set the filename if specified in the template
        if (!empty($filename)) {
            $filename .= '.' . $ext;
            if ($forceDownload) {
                header("Content-Description: File Transfer");
                header("Content-Disposition: attachment; filename=$filename");
                header("Content-Transfer-Encoding: binary");
            } else {
                header("Content-Disposition: inline; filename=$filename");
            }
        }
        
        // Display the file data
        echo($data);
        
    }
    
}
