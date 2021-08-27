<?php

namespace App\Http\Controllers;

use App\Http\Requests\saveProduct;
use App\Http\Requests\updateProduct;
use App\Models\brand_product;
use App\Models\category_post;
use App\Models\category_product;
use App\Models\Gallery;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Products extends Controller
{
//add_product
    public function addProduct(){
        $category = category_product::get();
        return view('admin.product.add_product', compact('category'));
    }
    public function saveProduct(saveProduct $request){
        $data = $request->all();
        $product = new product();
        $product_price = filter_var($data['product_price'], FILTER_SANITIZE_NUMBER_INT);
        $product_cost = filter_var($data['product_cost'], FILTER_SANITIZE_NUMBER_INT);
        $product->product_name = $data['product_name'];
        $product->product_slug = $data['product_slug'];
        $product->product_price = $product_price;
        $product->product_cost = $product_cost;
        $product->product_content = $data['product_content'];
        $product->product_desc = $data['product_desc'];
        $product->product_number = $data['product_number'];
        $product->product_status = $data['product_status'];
        $product->category_id = $data['product_cate'];
        $product->brand_id = $data['product_brand'];
        $product->product_image = $data['product_image'];
        $size=$request->input('size');
        if($size){
            $data['size']=implode(',',$size);
        }
        else{
            $data['size']='';
        }
        $product->product_size = $data['size'];
        $product->save();
        return redirect()->route('allproduct')->with('mess', 'Thêm sản phẩm thành công');

    }
//all_product

    public function allProduct(){
        $allproduct = product::join('category_products', 'products.category_id', '=', 'category_products.category_id')
                             ->join('brand_products', 'products.brand_id', '=', 'brand_products.brand_id')
                             ->select(['brand_products.brand_name', 'category_products.category_name',
                              'products.*'])
                            ->paginate(4);

        return view('admin.product.all_product', compact('allproduct'));
    }
//edit_product
    public function editProduct(Request $request ,$product_id){
        $category = category_product::get();
        $edit_product = product::findOrFail($product_id);
        return view('admin.product.edit_product', compact('edit_product','category'));

    }
    public function updateProduct(updateProduct $request, $product_id){
        $data = $request->all();
        $edit_product = product::findOrFail($product_id);
        $product_price = filter_var($data['product_price'], FILTER_SANITIZE_NUMBER_INT);
        $product_cost = filter_var($data['product_cost'], FILTER_SANITIZE_NUMBER_INT);
        $edit_product->product_name = $data['product_name'];
        $edit_product->product_slug = $data['product_slug'];
        $edit_product->product_price = $product_price;
        $edit_product->product_cost = $product_cost;
        $edit_product->product_content = $data['product_content'];
        $edit_product->product_desc = $data['product_desc'];
        $edit_product->product_number = $data['product_number'];
        $edit_product->product_status = $data['product_status'];
        $edit_product->category_id = $data['product_cate'];
        $edit_product->brand_id = $data['product_brand'];
        $edit_product->product_image = $data['product_image'];
        $size=$request->input('size');
        if($size){
            $data['size']=implode(',',$size);
        }
        else{
            $data['size']='';
        }
        $edit_product->product_size = $data['size'];
        $edit_product->save();
        return redirect()->route('allproduct')->with('mess', 'Cập nhật sản phẩm thành công');

    }
//delete_product
    public function deleteProduct($product_id){
        $delete_product = product::findOrFail($product_id);
        $delete_product->delete();
        return redirect()->route('allproduct')->with('mess', 'Bạn đã xóa sản phẩm thành công');
    }
//active and unactive
    public function activeProduct($product_id){
         DB::table('products')->where('product_id', $product_id)->update(['product_status'=> 0]);
        return redirect()->route('allproduct')->with('mess', 'Không kích hoạt sản phẩm');
    }
    public function unactiveProduct($product_id){
        DB::table('products')->where('product_id', $product_id)->update(['product_status'=>1]);
        return redirect()->route('allproduct')->with('mess', 'Kích hoạt sản phẩm');
    }
    public function addGallery($product_id){
        $pro_id = $product_id;
        return view('admin.product.add_gallery', compact('pro_id'));
    }
    public function selectGallery(Request $request){
        $product_id= $request->pro_id;
        $gallery = Gallery::where('product_id', $product_id)->get();
        $gallery_count = $gallery->count();
        $output = '<form>
                    '.csrf_field().'
                    <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Stt</th>
                            <th>Tên hình ảnh</th>
                            <th>Hình ảnh</th>
                            <th>Quản lý</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>';
        if ($gallery_count>0) {
            $i = 0;
            foreach ($gallery as $gal){
                $i++;
                $output.='<tr>
                            <td>'.$i.'</td>
                            <td contenteditable class="edit_gal_id" data-gal_id = "'.$gal->gallery_id.'">'.$gal->gallery_name.'</td>
                            <td><img src="'.asset($gal->gallery_image).'" height="100" width="100" ></td>
                            <td><button data-gal_id= "'.$gal->gallery_id.'" type = "button" class="btn btn-danger m-b-10 m-l-5 delete_gallery">Xóa</button></td>
                            <td></td>
                        </tr>';
            }
        }else{
            $output.='Khong co anh nao';
        }
        $output.= '</tbody>
            </table>
            </form>';
        echo $output;
    }
    public function insertGallery(Request $request, $pro_id){
        $data = $request->all();
        $gallery = new Gallery();
            $gallery->gallery_name = 'Giay';
            $gallery->gallery_image= $data['file'];
            $gallery->product_id = $pro_id;
            $gallery->save();
        return redirect()->back()->with('mess','Thêm thư viện ảnh thành công');
    }
    public function updateGallery(Request $request){
        $gal_id = $request->gal_id;
        $gal_text = $request->gal_text;
        $gallery = Gallery::findorFail($gal_id);
        $gallery->gallery_name = $gal_text;
        $gallery->save();

    }
    public function deleteGallery(Request $request){
        $gal_id = $request->gal_id;
        $gallery = Gallery::findorFail($gal_id);
        // unlink($gallery->gallery_image);
        $gallery->delete();


    }












}

