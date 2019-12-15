<?php
namespace App\Helpers;

class FileHelper {

    const CURRENT_B = 1;
    const CURRENT_KB = 2;
    const CURRENT_MB = 3;
    const CURRENT_GB = 4;
    const CURRENT_TB = 5;

    const BUFFER_SIZE = 30; //MB

    /**
     * Get file usage in MB
     * @return string
     */
    public static function getUsageSize() {
        $file_size = 0;
        $f = base_path();
        try {
		    $io = popen ( '/usr/bin/du -sk ' . $f, 'r' );
		    $size = fgets ( $io, 4096);
		    $size = substr ( $size, 0, strpos ( $size, "\t" ) );
		    pclose ( $io );
		    $file_size = $size;
        } catch (\Exception $e) {
        	$file_size = 0;
        }
        if(!$file_size || $file_size == '') $file_size = 0;
	    return number_format($file_size / 1024,2);
    }

    public static function getDiskInformations() {
    	$disk_used = self::getUsageSize() + self::BUFFER_SIZE;
    	$disk_space = config('library.disk_size');
    	$used_percent = ($disk_used) ? ceil(($disk_used/$disk_space)*100) : 0;
    	return [
    		'used' => self::getSizeFormatText($disk_used),
    		'total' => self::getSizeFormatText($disk_space),
    		'used_percent' => $used_percent
    	];
    }

    public static function getSizeFormatText($size, $current = self::CURRENT_MB)
    {
    	$subfix = [1 => 'B', 2 => 'kB', 3 => 'MB', 4 => 'GB', 5 => 'TB'];
    	while($size >= 1024 && $current < self::CURRENT_TB) {
    		$size = round($size/1024, 1);
    		$current = $current + 1;
    	}
    	while($size < 1 && $current > self::CURRENT_B) {
    		$size = round($size*1024, 1);
    		$current = $current - 1;
    	}
    	return $size . $subfix[$current];
    }
}