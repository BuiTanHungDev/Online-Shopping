<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('id', 'desc')->get();
        return View('backend.category.index', compact('categories'));
    }
    public function categoryStatus(Request $request)
    {
        if ($request->mode == 'true') {
            DB::table('categories')->where('id', $request->id)->update(['status' => 'active']);
        } else {
            DB::table('categories')->where('id', $request->id)->update(['status' => 'inactive']);
        }

        return response()->json(['msg' => 'Successfully status', 'status' => true]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parent_cats = Category::where('is_parent', 1)->orderBy('title', 'asc')->get();
        return View('backend.category.create', compact('parent_cats'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'=>'string|required',
            'summary'=>'string|nullable',
            'is_parent'=>'sometimes|in:1',
            'parent_id'=>'nullable|exists:categories,id',
            'status'=>'nullable|in:active,inactive'
        ]);
        
        $data = $request->all();
        $slug = Str::slug($request->input('title'));
        $slug_count = Category::where('slug', $slug)->count();
        
        if ($slug_count > 0) {
            $slug = time() . '-' . $slug;
        }
        
        $data['slug'] = $slug;
        $data['is_parent'] = $request->input('is_parent', 0);
        
        if ($request->input('is_parent') == 1) {
            $data['parent_id'] = null;
        } else {
            $data['parent_id'] = $request->input('parent_id');
        }
        
        $status = Category::create($data);
        
        if ($status) {
            return redirect()->route('category.index')->with('success', 'Category successfully created');
        } else {
            return back()->with('error', 'Something went wrong');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        $parent_cats = Category::where('is_parent', 1)->orderBy('title', 'asc')->get();
        if ($category) {
            return View('backend.category.edit', compact(['category', 'parent_cats']));
        } else {
            return back()->with('error', 'Data not found');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        if ($category) {
            $this->validate($request, [
                'title'=>'string|required',
                'summary'=>'string|nullable',
                'is_parent'=>'sometimes|in:1',
                'parent_id'=>'nullable|exists:categories,id',
                'status'=>'require|active,inactive',
            ]);
        
            $data = $request->all();
            $data['is_parent'] = $request->input('is_parent', 0);
        
            if ($request->input('is_parent') == 1) {
                $data['parent_id'] = null;
            } 
        
            $status = $category->fill($data)->save();
        
            if ($status) {
                return redirect()->route('category.index')->with('success', 'Category successfully updated.');
            } else {
                return back()->with('error', 'Something went wrong');
            }
        } else {
            return back()->with('error', 'Data not found');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Category::find($id);
        $child_cat_id= Category::where('parent_id',$id)->pluck('id');
        if ($product) {
            $status = $product->delete();
            if ($status) {
                if(count($child_cat_id)>0){
                    Category::shiftChild($child_cat_id); 
                }
                return redirect()->route('category.index')->with('success', " Category successfully deleted");
            } else {
                return back()->with('error', 'Something went wrong! ');
            }
        } else {
            return back()->with('error', 'Data not found');
        }
    }


    public function getChildParentID(Request $request,$id){
        $category = Category::find($request->id);
       if($category){
        $child_id= Category::getChildParentID($request->id);
        if(count($child_id) <= 0){
            return response()->json([
                'status' =>false,
                'data'=>null,
                'msg' =>''
            ]);
        }
        return response()->json([
            'status' =>true,
            'data'=>$child_id,
            'msg' =>''
        ]);

       }
       else{
        return response()->json([
            'status' =>false,
            'data'=>null,
            'msg' =>'Category not found'
        ]);
       }
    }
}
