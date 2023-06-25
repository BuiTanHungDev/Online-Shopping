<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductAttribute;
use Database\Factories\ProductFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {
        $products = Product::orderBy('id', 'desc')->get();
        return View('backend.product.index', compact('products'));
    }

    public function productStatus(Request $request)
    {
        if ($request->mode == 'true') {
            DB::table('products')->where('id', $request->id)->update(['status' => 'active']);
        } else {
            DB::table('products')->where('id', $request->id)->update(['status' => 'inactive']);
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
        return View('backend.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'string|required',
            'summary' => 'string|required',
            'description' => 'string|nullable',
            'additional_info' => 'string|nullable',
            'return_cancellation' => 'string|nullable',

            'stock'=>'nullable|numeric',
            'price' =>'nullable|numeric',
            'discount'=>'nullable|numeric',
            'photo' =>'required',
            'size_guide' =>'nullable',

            'cat_id'=>'required|exists:categories,id',
            'child_cat_id'=>'nullable|exists:categories,id',
            'size'=>'nullable',
            'condition'=>'required|nullable',
            'status'=>'nullable|in:active,inactive',  
        ]);
        $data = $request->all();
        $slug = Str::slug($request->input('title'));
        $slug_count = Product::where('slug', $slug)->count();
        
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

        $data['offer_price'] = ($request->input('price') -(($request->input('price') * $request->input('discount')) / 100));
        // return $data;
        $status = Product::create($data);
        
        if ($status) {
            return redirect()->route('product.index')->with('success', 'Product successfully created');
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
        $product = Product::find($id);
        $productAttr= ProductAttribute::where('product_id',$id)->orderBy('id','desc')->get();
       
        if ($product) {
            return View('backend.product.product-attribute', compact(['product','productAttr']));
        } else {
            return back()->with('error', 'product not found');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        if ($product) {
            return View('backend.product.edit', compact(['product']));
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
        $product = Product::find($id);

        if ($product) {
            $this->validate($request, [
                'title' => 'string|required',
                'summary' => 'string|required',
                'description' => 'string|nullable',
                'additional_info' => 'string|nullable',
                'return_cancellation' => 'string|nullable',
                'stock'=>'nullable|numeric',
                'price' =>'nullable|numeric',
                'discount'=>'nullable|numeric',
                'photo' =>'required',
                'size_guide' =>'nullable',

                'cat_id'=>'required|exists:categories,id',
                'child_cat_id'=>'nullable|exists:categories,id',
                'size'=>'nullable',
                'condition'=>'required|nullable',
                'status'=>'nullable|in:active,inactive',  
            ]);
        
            $data = $request->all();
            $data['is_parent'] = $request->input('is_parent', 0);
        
            // if ($request->input('is_parent') == 1) {
            //     $data['parent_id'] = null;
            // } 
              $data['offer_price'] = ($request->input('price') -(($request->input('price') * $request->input('discount')) / 100));

        
            $status = $product->fill($data)->save();
        
            if ($status) {
                return redirect()->route('product.index')->with('success', 'Product successfully updated.');
            } else {
                return back()->with('error', 'Something went wrong');
            }
        } else {
            return back()->with('error', 'Product not found');
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
        $product = Product::find($id);
        if ($product) {
            $status = $product->delete();
            if ($status) {
                
                return redirect()->route('product.index')->with('success', " Product successfully deleted");
            } else {
                return back()->with('error', 'Something went wrong! ');
            }
        } else {
            return back()->with('error', 'Data not found');
        }
    }


    // section add attribute

    public function addProductAttribute(Request  $request,$id){
        // $this->validate($request,[
        //     'size'=>'nullable|numeric',
        //     'original_price'=>'nullable|numeric',
        //     'offer_price'=>'nullable|numeric',
        //     'stock'=>'nullable|numeric',   
        // ]);


        $data = $request->all();
         foreach ( $data['original_price'] as $key=>$val){
            if(!empty($val)){
                $attribute = new ProductAttribute;
                $attribute['original_price'] = $val;
                $attribute['offer_price']= $data['offer_price'][$key];
                $attribute['stock']= $data['stock'][$key];
                $attribute['product_id']= $id;
                $attribute['size']= $data['size'][$key];
    
                $attribute->save();
            }
         }
         return redirect()->back()->with('success','Product attribute successfully add');
    }


    public function addProductAttributeDelete($id){
        $productAttr = ProductAttribute::find($id);
        if ($productAttr) {
            $status = $productAttr->delete();
            if ($status) {
                
                return redirect()->back()->with('success', " Product attribute successfully deleted");
            } else {
                return back()->with('error', 'Something went wrong! ');
            }
        } else {
            return back()->with('error', 'Data not found');
        }
    }

}
