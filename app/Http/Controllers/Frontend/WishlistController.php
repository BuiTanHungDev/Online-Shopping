<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Frontend\formatCurrency;

class WishlistController extends Controller
{
    public function wishlist()
    {

        return view('frontend.pages.wishlist');
    }

    public function wishlistStore(Request $request)
    {
        $product_id = $request->input('product_id');
        $product_qty = $request->input('product_qty');

        $product = Product::getProductByCart($product_id);

        $price = $product[0]['offer_price'];
        $wishlist_array = [];
        foreach (Cart::instance('wishlist')->content() as $item) {
            $wishlist_array[] = $item->id;
        }
        if (in_array($product_id, $wishlist_array)) {
            $response['percent'] = true;
            $response['message'] = "Item has saved in wishlist";
        } else {
            $result = Cart::instance('wishlist')->add($product_id, $product[0]['title'], $product_qty, $price)->associate('App\Models\Product');

            if ($result) {
                $response['status'] = true;
                $response['message'] = "Item has saved in wishlist";
                $response['wishlist_count'] = Cart::instance('wishlist')->count();
            }
        }

        return json_encode($response);
    }




    //end chính
    public function moveToCart(Request $request)
    {
        $response = [];
        $rowId = $request->input('rowId');
        $item = Cart::instance('wishlist')->get($rowId);

        if ($item) {
            $existingCartItem = Cart::instance('shopping')->search(function ($cartItem, $rowId) use ($item) {
                return $cartItem->id === $item->id;
            });

            if ($existingCartItem->isNotEmpty()) {
                // Sản phẩm đã tồn tại trong giỏ hàng, cộng số lượng lên
                $existingRowId = $existingCartItem->first()->rowId;
                $result = Cart::instance('shopping')->update($existingRowId, $existingCartItem->first()->qty + 1);
                if ($result) {
                    Cart::instance('wishlist')->remove($rowId); // Xóa sản phẩm từ wishlist
                }
            } else {
                // Sản phẩm chưa có trong giỏ hàng, thêm mới
                $result = Cart::instance('shopping')->add($item->id, $item->name, 1, $item->price)->associate('App\Models\Product');
                if ($result) {
                    Cart::instance('wishlist')->remove($rowId); // Xóa sản phẩm từ wishlist
                }
            }

            if ($result) {
                $response['status'] = true;
                $response['message'] = "Item has been added to cart";
                $response['cart_count'] = Cart::instance('shopping')->count();
                $response['wishlist_count'] = Cart::instance('wishlist')->count();

            }
        } else {
            $response['status'] = false;
            $response['message'] = "Item not found";
        }

        if ($request->ajax()) {
            $wishlist = view('frontend.layouts._wishlist')->render();
            $response['wishlist_list'] = $wishlist;
        }

        return response()->json($response);
    }
    //đã ok 


    
    

  


    private function removeFromWishlist($rowId)
    {
        Cart::instance('wishlist')->remove($rowId);
    }
}
