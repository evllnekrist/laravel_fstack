<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Carbon\Carbon;
use Cookie;

class UserController extends Controller
{
    public function __construct()
	{
		parent::__construct();
    }

    public function api_get_list(Request $request)
    {
        if($request->ajax()) {
            // DB::enableQueryLog();
            $list_item = User::orderBy('updated_at', 'DESC')
                            ->orderBy('created_at', 'DESC')
                            ->groupBy('id')->get()->toArray();
            // dd(DB::getQueryLog());
            // dd($list_item);
            $json_data = array(
                'meta' => array(
                    "page" => 1,
                    "pages" => 1,
                    "perpage" => -1,
                    "total" => count($list_item),
                    "sort" => "desc",
                    "field" => "updated_at",
                ),
                'data' => $list_item
            );

            return json_encode($json_data);
        }
    }

}
