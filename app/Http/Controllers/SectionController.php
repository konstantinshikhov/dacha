<?php

namespace App\Http\Controllers;

use App\Models\Section;

class SectionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api',
        ['except' =>
            [
                'index',
            ]
        ]);
    }

    /**
     * @SWG\Get(
     *     path="/section/index",
     *     operationId="Get sections",
     *     description="Get sections",
     *     summary="Get sections",
     *     produces={"application/json"},
     *     tags={"Sections"},
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function index()
    {
        $model = Section::all();

        return response()->json([
            'success' => true,
            'success-message' => [],
            'errors-message' => [],
            'sections' => $model,
        ], 200);
    }


//    public function store()
//    {
//        $file = null;
//
//        if (request()->hasFile('image')) {
//            $image = request()->file('image');
//            $file = time() . '.' . $image->getClientOriginalExtension();
//            $path = public_path('/uploads/sections');
//            $image->move($path, $file);
//        }
//
//        $model = Section::create([
//            'name' => request()->get('name'),
//            'image' => $file,
//            'slug' => request()->get('slug'),
//        ]);
//
//        return response()->json([
//            'success' => true,
//            'success-message' => [],
//            'errors-message' => [],
//            'section' => $model,
//        ], 200);
//    }
//
//    public function destroy()
//    {
//        $model = Section::destroy(request()->get('section_id'));
//
//        return response()->json([
//            'success' => $model ? true : false,
//            'success-message' => [],
//            'errors-message' => [],
//        ], 200);
//    }
}
