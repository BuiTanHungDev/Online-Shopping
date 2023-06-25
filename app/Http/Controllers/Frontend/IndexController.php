<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Frontend\logout;
use App\Models\Brand;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\URL;

class IndexController extends Controller
{
    public function home()
    {
         $new_products = Product::where(['status' => 'active', 'condition' => 'new'])
            ->orderBy('id', 'desc')
            ->limit(8)
            ->get();
            $featured_products = Product::where(['status' => 'active', 'is_featured' => 1])
            ->orderBy('id', 'desc')
            ->limit(6)
            ->get();

        $banners = Banner::where(['status' => 'active', 'condition' => 'banner'])->orderby('id', 'desc')->limit(3);
        $categories = Category::where(['status' => 'active', 'is_parent' => 1])->limit(3)->orderby('id', 'desc')->get();
        return view('frontend.index', compact(['banners', 'categories','new_products','featured_products']));
    }


    // Auto Search + Search

    public function autoSearch(Request $request){
        $query = $request->get('term','');

        $products = Product::where('title','LIKE','%'.$query.'%')->get();

        $data= array();

        foreach($products as $product){
            $data[] = array('value'=>$product->title,'id'=>$product->id);
        }


        if(count($data)){
            return $data;
        }
        else{
            return ['value'=>'No Result Found','id'=>''];
        }
    }

    public function Search(Request $request){
        $query = $request->input('query');
        $products = Product::where('title','LIKE','%'.$query.'%')->orderBy('id','DESC')->paginate(12);

        $brands = Brand::where('status','active')->orderBy('title','ASC')->with('products')->get();
        $categories = Category::where(['status' => 'active', 'is_parent' => 1])->with('products')->orderBy('title', 'ASC')->get();

        return view('frontend.pages.product.shop', compact('products','categories','brands'));

    }



    // End Section Search

    // Section Shop
    public function shop(Request $request)
    {
        $products = Product::query();
        //category
        if (!empty($_GET['category'])) {
            $slugs = explode(',', $_GET['category']);
            $cat_ids = Category::select('id')->whereIn('slug', $slugs)->pluck('id')->toArray();
            $products = $products->whereIn('cat_id', $cat_ids);
        }

        // brand
        if (!empty($_GET['brand'])) {
            $slugs = explode(',', $_GET['brand']);
            $brand_ids = Brand::select('id')->whereIn('slug', $slugs)->pluck('id')->toArray();
            $products =  $products->whereIn('brand_id', $brand_ids);
        }
        /// Size
        if (!empty($_GET['size'])) {
           $products = $products->where('size',$_GET['size']);
        }

        //SortBy
        if (!empty($_GET['sortBy'])) {
            if ($_GET['sortBy'] == 'priceAsc') {
                $products =  $products->where(['status' => 'active'])->orderBy('offer_price', 'ASC');
            } 
            if ($_GET['sortBy'] == 'priceDesc') {
                $products =   $products->where(['status' => 'active'])->orderBy('offer_price', 'DESC');
            } 
            if ($_GET['sortBy'] == 'titleAsc') {
                $products =  $products->where(['status' => 'active'])->orderBy('title', 'ASC');
            } 
            if ($_GET['sortBy'] == 'titleDesc') {
                $products = $products = $products->where(['status' => 'active'])->orderBy('title', 'DESC');
            } 
            if ($_GET['sortBy'] == 'discountAsc') {
                $products =   $products->where(['status' => 'active'])->orderBy('discount', 'asc');
            } 
            if ($_GET['sortBy'] == 'discountDesc') {
                $products = $products->where(['status' => 'active'])->orderBy('discount', 'desc');
            }
            
        }
    
        if (!empty($_GET['price'])) {
            $price = explode('-', $_GET['price']);
            $price[0] = floor(floatval($price[0]));
            $price[1] = ceil(floatval($price[1]));
            $products =   $products->whereBetween('offer_price', $price);
        }
    
        $perPage = 12;
        $products = $products->where('status', 'active')->paginate($perPage)->appends($request->all());
    
        $brands = Brand::where('status','active')->orderBy('title','ASC')->with('products')->get();
        $categories = Category::where(['status' => 'active', 'is_parent' => 1])->with('products')->orderBy('title', 'ASC')->get();
        return view('frontend.pages.product.shop', compact('products', 'categories','brands'));
    }
    public function shopFilter(Request $request)
    {
        $data= $request->all();
        //category filter
        $catUrl='';
        if(!empty($data['category'])){
            foreach($data['category'] as $category){
                if(empty($catUrl)){
                    $catUrl.='&category='.$category;

                }
                else{
                    $catUrl .=','.$category;
                }
            }

        }
        // sortby filter

        $sortByUrl='';
        if(!empty($data['sortBy'])){
            $sortByUrl.='&sortBy='.$data['sortBy']; 
        }

        // Price filter

        $price_range_Url='';
        if(!empty($data['price_range'])){
            $price_range_Url.='&price='.$data['price_range'];
        }
        //filter brand
        $brandUrl='';
        if(!empty($data['brand'])){
            foreach($data['brand'] as $brand){
                if(empty($brandUrl)){
                    $brandUrl.='&brand='.$brand;

                }
                else{
                    $brandUrl .=','.$brand;
                }
            }

        }
        //filter size

        $sizeUrl='';
        if(!empty($data['size'])){
            $sortByUrl.='&size='.$data['size']; 
        }

        // /--------------------------/
        // $params = [];
    
        // if (!empty($request->input('category'))) {
        //     $params['category'] = implode(',', $request->input('category'));
        // }
    
        // if (!empty($request->input('sortBy'))) {
        //     $params['sortBy'] = $request->input('sortBy');
        // }
        // // filter price
        // if (!empty($request->input('price_range'))) {
        //     $params['price'] = $request->input('price_range');
        // }
        // // filter brand
     
        // if (!empty($request->input('brand'))) {
        //     $params['brand'] = implode(',', $request->input('brand'));
        // }
    
        return \redirect()->route('shop', $catUrl.$sortByUrl.$price_range_Url.$brandUrl.$sizeUrl);
    }
    



    // end section Shop


    public function productCategory(Request $request, $slug)
    {
        $categories = Category::with(['products'])->where('slug', $slug)->first();
        $sort = '';
        if ($request->sort != null) {
            $sort = $request->sort;
        }
        if ($categories == null) {
            return view('error.404');
        } else {
            if ($sort == 'priceAsc') {
                $products = Product::where(['status' => 'active', 'cat_id' => $categories->id])->orderBy('offer_price', 'ASC')->paginate(8);
            } elseif ($sort == 'priceDesc') {
                $products = Product::where(['status' => 'active', 'cat_id' => $categories->id])->orderBy('offer_price', 'DESC')->paginate(8);
            } elseif ($sort == 'titleAsc') {
                $products = Product::where(['status' => 'active', 'cat_id' => $categories->id])->orderBy('title', 'ASC')->paginate(8);
            } elseif ($sort == 'titleDesc') {
                $products = Product::where(['status' => 'active', 'cat_id' => $categories->id])->orderBy('title', 'DESC')->paginate(8);
            } elseif ($sort == 'discountAsc') {
                $products = Product::where(['status' => 'active', 'cat_id' => $categories->id])->orderBy('discount', 'asc')->paginate(8);
            } elseif ($sort == 'discountDesc') {
                $products = Product::where(['status' => 'active', 'cat_id' => $categories->id])->orderBy('discount', 'desc')->paginate(8);
            } else {
                $products = Product::where(['status' => 'active', 'cat_id' => $categories->id])->paginate(12);
            }
        }
        $route = 'product-category';
        if ($request->ajax()) {
            $view = view('frontend.layouts._single-product', compact('products'))->render();
            return response()->json(['html' => $view]);
        }

        return view('frontend.pages.product.product-category', compact(['categories', 'route', 'products']));
    }



    public function productDetail($slug)
    {
        $product = Product::with('rel_products')->where('slug', $slug)->first();

        if ($product) {
            return view('frontend.pages.product.product-detail', compact(['product']));
        } else {
            return 'Product detail not found';
        }
    }


    // User Authentication
    public function userAuth()
    {
        Session::put('user.intendend', URL::previous());
        return view('frontend.auth.auth');
    }
    public function loginSubmmit(Request $request)
    {
        $this->validate($request, [
            'email' => 'email|required|exists:users,email',
            'password' => 'required|min:4',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => 'active'])) {
            Session::put('user', $request->email);
            if (Session::get('url.intended')) {
                return Redirect::to(Session::get('url.intended'));
            } else {
                return redirect()->route('home')->with('success', 'Successful login');
            }
        } else {
            return back()->with('error', 'Invalid email & password');
        }
    }

    public function registerSubmmit(Request $request)
    {

        $this->validate($request, [

            'full_name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'min:4|required|confirmed'
        ]);
        $data = $request->all();

        $check = $this->create($data);
        Session::put('user', $data['email']);
        Auth::login($check);
        if ($check) {
            return redirect()->route('home');
        } else {
            return back();
        }
    }
    public function create(array $data)
    {
        return User::create([

            'full_name' => $data['full_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),

        ]);
    }

    public function userLogout()
    {
        Session::forget('user');
        Auth::logout();
        return \redirect()->route('home')->with('success','Logout Successfully');
    }


    //User Dashboard

    public function userDashboard()
    {
        $user = Auth::user();

        return view('frontend.users.dashboard', compact('user'));
    }
    public function userOrder()
    {
        $user = Auth::user();

        return view('frontend.users.order', compact('user'));
    }
    public function userAddress()
    {
        $user = Auth::user();

        return view('frontend.users.address', compact('user'));
    }

    public function userAccount()
    {
        $user = Auth::user();
        return view('frontend.users.account-detail', compact('user'));
    }

    public function billingAddress(Request $request, $id)
    {

        $user = User::where('id', $id)->update(['country' => $request->country, 'city' => $request->city, 'postcode' => $request->postcode, 'state' => $request->state, 'address' => $request->address]);
        if ($user) {
            return back()->with('success', 'Billing successful ');
        } else {
            return back()->with('error', 'Something went wrong');
        }
    }
    public function shippingAddress(Request $request, $id)
    {

        $user = User::where('id', $id)->update(['scountry' => $request->scountry, 'scity' => $request->scity, 'spostcode' => $request->spostcode, 'sstate' => $request->sstate, 'saddress' => $request->saddress]);
        if ($user) {
            return back()->with('success', 'Shipping successful ');
        } else {
            return back()->with('error', 'Something went wrong');
        }
    }

    ///////
    public function updateAccount(Request $request, $id)
    {
        $this->validate($request, [
            'new_password' => 'nullable|min:4',
            'old_password' => 'nullable|min:4',
            'full_name' => 'string|required',
            'username' => 'nullable|string',
            'phone' => 'nullable|min:8'
        ]);

        $hash_password = Auth::user()->password;

        if (!empty($request->old_password) && !empty($request->new_password)) {
            if (Hash::check($request->old_password, $hash_password)) {
                if ($request->old_password === $request->new_password) {
                    return back()->with('error', 'New password cannot be the same as the old password');
                }

                User::where('id', $id)->update([
                    'full_name' => $request->full_name,
                    'username' => $request->username,
                    'password' => Hash::make($request->new_password)
                ]);

                return back()->with('success', 'Account updated successfully');
            } else {
                return back()->with('error', 'Old password does not match');
            }
        } else {
            User::where('id', $id)->update([
                'full_name' => $request->full_name,
                'username' => $request->username,
                'phone' => $request->phone
            ]);

            return back()->with('success', 'Account updated successfully');
        }
    }
}
