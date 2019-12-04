<?php

namespace App\Http\Controllers\Admin\Setting;
use App\Models\SystemVariable;
use App\Http\Controllers\Admin\BaseController;
use Illuminate\Http\Request;

class SystemVarController extends BaseController
{

    public function edit(Request $request)
    {
    	$sys_vars = SystemVariable::all();
    	return view('admin.setting.system_var', ['sys_vars' => $sys_vars]);
    }

    public function update(Request $request)
    {
    	if($request->method() == 'GET') {
    		$sys_vars = SystemVariable::all();
    		return view('admin.settings.system_var', ['vars' => $sys_vars]);
    	}
    	$result = true;
    	try {
    		$values = $request->get('values');
    		foreach($request->get('names') as $index => $name) {
	    		SystemVariable::where('name', $name)->update(['value' => $values[$index]]);
	    	}
    	} catch(\Exception $e) {
    		\Log::info($e);
    		$result = false;
    	}
    	
        if($result) {
            $this->saveSessionSuccessMessage('Updated.');
        } else {
            $this->saveSessionErrorMessage('Error');
        }
        $sys_vars = SystemVariable::all();
        return redirect()->route('admin.setting.sys_var');
    }
}
