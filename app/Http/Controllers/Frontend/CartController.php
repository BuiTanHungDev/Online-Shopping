<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;

use ShoppingCart;
use Illuminate\Http\Request;
use Illuminate\Support\Js;


class CartController extends Controller
{
    public function cart()
    {
        return view('frontend/pages.cart.index');
    }


    public function cartStore(Request $request)
    {
        $product_qty = $request->input('product_qty');
        $product_id = $request->input('product_id');
        $product = Product::getProductByCart($product_id);
        $price = $product[0]['offer_price'];

        $cart_array = [];
        foreach (Cart::instance('shopping')->content() as $item) {
            $cart_array[] = $item->id;
        }

        $result = Cart::instance('shopping')->add($product_id, $product[0]['title'], $product_qty, $price)->associate('App\Models\Product');

        if ($result) {
            $response['status'] = true;
            $response['product_id'] = $product_id;
            $response['total'] = Cart::subtotal();
            $response['cart_count'] = Cart::instance('shopping')->count();
            $response['message'] = "Add success";
        }

        if ($request->ajax()) {
            $header = view('frontend.layouts.header')->render();
            $response['header'] = $header;
            return response()->json($response);
        }

        return $response;
    }


    //delete
    public function cartDelete(Request $request)
    {

        $id = $request->input('cart_id');
        Cart::instance('shopping')->remove($id);
        $response['status'] = true;
        $response['message'] = "Cart deleted successfully";
        $response['total'] = Cart::subtotal();
        $response['cart_count'] = Cart::instance('shopping')->count();

        if ($request->ajax()) {
            $header = view('frontend.layouts.header')->render();
            $response['header'] = $header;
        }
        return json_encode($response);
    }


    // public function cartUpdate(Request $request)
    // {
    //     $this->validate($request, [
    //         'product_qty' => 'required|numeric',
    //     ]);

    //     $rowId = $request->input('rowId');
    //     $request_quantity = $request->input('product_qty');
    //     $productQuantity = $request->input('productQuantity');

    //     if ($request_quantity > $productQuantity) {
    //         $message = "We currently do not have enough items in stock";
    //         $response['status'] = false;
    //     } elseif ($request_quantity < 1) {
    //         $message = "You can't add less than 1 item";
    //         $response['status'] = false;
    //     } else {
    //         Cart::instance('shopping')->update($rowId, $request_quantity);
    //         $message = "Quantity was updated successfully";

    //         $item = Cart::get($rowId);
    //         $response['price'] = $item->subtotal();
    //         $response['total'] = Cart::subtotal();
    //         $response['cart_count'] = Cart::instance('shopping')->count();
    //         $response['status'] = true;
    //     }

    //     if ($request->ajax()) {
    //         $header = view('frontend.layouts.header')->render();
    //         $cart_list = view('frontend.layouts._cart-list')->render();

    //         $response['header'] = $header;
    //         $response['cart_list'] = $cart_list;
    //         $response['message'] = $message;
    //     }

    //     return json_encode($response);
    // }
    public function cartUpdate(Request $request)
    {
        $this->validate($request, [
            'product_qty' => 'required|numeric',
        ]);

        $rowId = $request->input('rowId');
        $request_quantity = $request->input('product_qty');
        $productQuantity = $request->input('productQuantity');

        if ($request_quantity > $productQuantity) {
            $message = "We currently do not have enough items in stock";
            $response['status'] = false;
        } elseif ($request_quantity < 1) {
            $message = "You can't add less than 1 item";
            $response['status'] = false;
        } else {
            $cart = Cart::instance('shopping');

            $item = $cart->get($rowId);
            $cart->update($rowId, $request_quantity);

            $message = "Quantity was updated successfully";

            $item = $cart->get($rowId);
            $response['price'] = $item->subtotal();
            $response['total'] = $cart->subtotal();
            $response['cart_count'] = $cart->count();
            $response['status'] = true;
        }

        if ($request->ajax()) {
            $header = view('frontend.layouts.header')->render();
            $cart_list = view('frontend.layouts._cart-list')->render();

            $response['header'] = $header;
            $response['cart_list'] = $cart_list;
            $response['message'] = $message;
        }

        return json_encode($response);
    }






    // Coupon
    public function addCoupon(Request $request)
    {
        $couponCode = $request->input('code');
        $coupon = Coupon::where('code', $couponCode)->first();

        if (!$coupon) {
            return back()->with('error', 'Invalid coupon code. Please enter a valid coupon code.');
        }

        $subtotal = floatval(\Gloudemans\Shoppingcart\Facades\Cart::subtotal());
        $couponValue = $coupon->discount($subtotal);

        session()->put('coupon', [
            'id' => $coupon->id,
            'code' => $coupon->code,
            'value' => $couponValue,
        ]);

        return back()->with('success', 'Coupon applied successfully.');
    }
}
