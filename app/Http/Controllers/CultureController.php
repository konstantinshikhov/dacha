<?php

namespace App\Http\Controllers;

use App\Models\Culture;
use App\Models\Filter_attr_value;
use App\Models\Section;
use App\Models\Sort;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Filter_attributes;




class CultureController extends Controller
{
    /**
     * @SWG\Post(
     *     path="/culture/index",
     *     operationId="Get cultures",
     *     description="Get cultures",
     *     summary="Get cultures",
     *     produces={"application/json"},
     *     tags={"Cultures"},
     *     @SWG\Parameter(name="section_id", required=true, in="query", type="integer"),
     *     @SWG\Parameter(name="page", required=false, in="query", type="integer"),
     *     @SWG\Parameter(name="filter", required=false, description="25 26 45 85  6-7 - attribute values",  in="query", type="string"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function index(Request $request)
    {
        $itemsperpage=15;
        $this->validate($request, [
            'section_id' => 'integer|required',
            'page'=>'integer',
        ]);
        $section_id=request()->get('section_id');
        //select id
        $section=Section::find($section_id);
        if(!isset($section)){
            return response()->json([
                'success' => false,
                'success-message' => [],
                'errors-message' => ['this section is not exist'],
                'cultures' => [],
            ], 200);
        }
        $filter_request=request()->get('filter');
        $filter_attributes_values_id=explode(' ', request()->get('filter'));
        $filter_attributes_values=Filter_attr_value::whereIN('id', $filter_attributes_values_id)
            ->get();
        $filter_attributes = Filter_attr_value::select('attribute_id')
            ->whereIn('id', $filter_attributes_values_id)
            ->distinct()
            ->get();
        $item_ides=array();
        if (isset($filter_request)){
            $sql='SELECT DISTINCT  cultures.id FROM cultures JOIN filter_attr_entities ON cultures.id = filter_attr_entities.entity_id WHERE filter_attr_entities.entity_type="culture" AND cultures.section_id='.$section_id;
            foreach ($filter_attributes as $filter_attribute) {
                $sql2=$sql.' AND ( filter_attr_entities.attribute_value IN (';
                foreach ($filter_attributes_values as $filter_attributes_value){
                    if ($filter_attributes_value->attribute_id==$filter_attribute->attribute_id){
                        $sql2=$sql2." $filter_attributes_value->id,";
                    }
                }
                $sql2=substr($sql2, 0, -1);
                $sql2=$sql2."))";
                $bd_items = DB::select($sql2);
                $items_array=array();
                foreach ($bd_items as $bd_item){
                    array_push($items_array, $bd_item->id);
                }
                array_push($item_ides, $items_array);
            }
            $arr_count=count($item_ides);
            for ($i=1; $i<$arr_count; $i++){
                $item_ides[0]=array_intersect($item_ides[0], $item_ides[$i]);
            }
            $item_ides=$item_ides[0];
            if(count($item_ides)==0){
                return response()->json([
                    'success' => true,
                    'success-message' => [],
                    'errors-message' => [],
                    'cultures' => [],
                    'sql'=>$sql,
                ], 200);
            }
        }

        //create sql
        $sql="select `id`, `name`, `photo`, `section_id`, `slug` from `cultures` WHERE cultures.section_id=".$section_id;
        if (count($item_ides)>0){
            $sql=$sql." and cultures.id IN (".implode(", ", $item_ides).")";
        }
        $sql=$sql." ORDER BY cultures.name";
        $limit =$itemsperpage;
        $page =1;
        if(request('page') > 1){
            $page=request('page');
        }
        //calculate pages
        $cultures=DB::select($sql);
        $pages=ceil(count($cultures)/$itemsperpage);
        $skip=($page-1)*$itemsperpage;
        $sql =$sql."  limit ".$limit." offset ".$skip;

        $cultures=DB::select($sql);
        if (count($cultures)>0) {
            foreach ($cultures as $culture) {
                //$photo['path']="1";
                if (isset($culture->photo))
                    $culture->photo = $_ENV['PHOTO_FOLDER'] . $culture->photo;
                $culture->sorts_count=Sort::where('culture_id',$culture->id)->count();
            }
        }
        return response()->json([
            'success' => true,
            'success-message' => [],
            'errors-message' => [],
            'section_id'=>$section_id,
            'pages'=>$pages,
            'page' => $page,
            'cultures' => $cultures,
            'sql'=>$sql,
        ], 200);
    }
//Route::post('showfilter', 'CultureController@showfilter');
    /**
     * @SWG\Post(
     *     path="/culture/showfilter",
     *     operationId="show culture filter",
     *     description="show culture filter",
     *     summary="show culture filter",
     *     produces={"application/json"},
     *     tags={"Cultures"},
     *     @SWG\Parameter(name="section_id", required=true, in="query", type="integer"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function showfilter(Request $request){
        $this->validate($request, [
            'section_id' => 'required|integer',
        ]);
        $section=Section::find($request->input('section_id'));
        if(!isset($section)){
            return response()->json([
                'success' => false,
                'success-message' => [],
                'errors-message' => ['this section is not exist'],
                'cultures' => [],
            ], 200);
        }

        $filter=Filter_attributes::where('type', 'culture')
            ->where('section_id', $request->input('section_id'))
            ->with('attr_values')
            ->get();
        return response()->json([
            'success' => $filter ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'filter'=>$filter,
        ], 200);
    }

}
