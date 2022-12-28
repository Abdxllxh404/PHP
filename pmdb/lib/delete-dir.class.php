<?php
class DeleteDir {
      static function delete($dir) {
            if (!is_dir($dir)) { 
                  return;
            }
            
            $d = new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS);

            foreach (new RecursiveIteratorIterator($d, RecursiveIteratorIterator::CHILD_FIRST) as $filename => $file) {
                  if (is_file($filename)) {
                        unlink($filename);
                  } else { 
                        rmdir($filename);
                  }        
                  
                  @rmdir($dir);
            }
      }
}
?>
