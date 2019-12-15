<?php

namespace App\Http\Controllers\Admin\Log;

use App\Http\Controllers\Admin\BaseController;
use App\Repositories\Contracts\Log\ActivityLogRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\GameInputRequest;

class ActivityController extends BaseController
{
	protected $logRepos;

	public function __construct(ActivityLogRepositoryInterface $logRepos)
    {
        $this->logRepos = $logRepos;
        parent::__construct();
    }

    public function index(Request $request)
    {
    	$activities = $this->logRepos->getListPagination();
        return view('admin.log.activity', ['activities' => $activities]);
    }
}