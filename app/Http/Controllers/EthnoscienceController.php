<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ethnoscience;
use App\Models\Ethnoscience_month;

class EthnoscienceController extends Controller
{
    /**
     * @SWG\Post(
     *     path="/ethnoscience/index",
     *     operationId="Get ethnocalendar",
     *     description="Get ethnocalendar",
     *     summary="Get ethnocalendar",
     *     produces={"application/json"},
     *     security={{"access_token":{}}},
     *     tags={"Ethnoscience"},
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function index()
    {
        //check is registered user
        $this->middleware('auth:api');
        $user=auth()->user();
        if (empty($user)){
            return response()->json([
                'success' =>false,
                'success-message' => [],
                'errors-message' => ['not autentificated'],
            ], 200);
        }
        $user_id = $user['id'];

        //start-end date
        $month=date('m');
        $ethnoscience = Ethnoscience_month::where('month', '=', $month)
            ->leftJoin('ethnosciences', 'ethnosciences.id', '=', 'ethnoscience_months.ethnoscience_id')
            ->get();
        return response()->json([
            'success' => $user ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'user_id'=>$user_id,
            'month'=>$month,
            'ethnoscience' =>$ethnoscience
        ], 200);
    }
}
