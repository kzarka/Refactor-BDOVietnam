<?php

namespace App\Http\Controllers\Simsimi;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class SimController extends BaseController
{
    public function chat(Request $request)
    {
        if($request->get('text')) {
            $hoi = $request->get('text');
            try {
                $response =  file_get_contents("http://ghuntur.com/simsim.php?lc=vn&deviceId=&bad=0&txt=".urlencode($hoi));
            } catch(\Exception $e) {
                return 'Em bị lỗi rồi';
            }
            
            $dap = isset($response)?$response:null;
            if($dap != null) {
                $replace = array(
                    'simsi' => 'Black Spirit',
                    'Simsi' => 'Black Spirit',
                    'Simsi' => 'Black Spirit',
                    'simsimi' => 'Black Spirit',
                    'sim' => 'Black Spirit',
                    'Talk with random person: https://play.google.com/store/apps/details?id=www.speak.com' => 'Truy cập website của chúng tôi: bdovietnam.com',

                );
                $text = str_replace(array_keys($replace),array_values($replace),$dap);
                if(preg_match("/play.google.com/i", $text)) {
                    $text = 'Truy cập website của chúng tôi: bdovietnam.com';
                }
                return $text;
            }
            return 'Em bị lỗi rồi';
        }
    }
}
