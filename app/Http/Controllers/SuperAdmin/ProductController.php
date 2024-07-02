<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use App\Customer;
use App\Country;
use App\Company;
use App\Material;
use App\Product;
use App\ProductMaterial;
use App\ProductSize;
use App\Size;
use App\Image;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = Product::with(['images', 'productmaterial'])->orderBy('id', 'DESC')->get();
        return view('superadmin.product.view')->with(['title' => 'Product', 'data' => $data]);
    }
    public function add(Request $request)
    {
        $data = "";
        $images = "";
        $material_data = "";
        if (isset($request->id)) {
            $data = Product::where('id', $request->id)->first();
            $images = Image::where('product_id', $request->id)->get();
            $product_material = ProductMaterial::where('product_id', $request->id)->get();
            $product_size = ProductSize::where('product_id', $request->id)->get();
        } else {
            $product_material = "";
            $product_size = "";
        }

        $customer = Customer::get();
        $material = Material::get();
        $branded_products = Brand::where('is_active', 1)->get();
        $sizes = Size::get();
        // dd($sizes);
        return view('superadmin.product.add')->with(['title' => 'Product', 'data' => $data, 'branded_products' => $branded_products, "sizes" => $sizes, "customer" => $customer, 'material' => $material, 'images' => $images, "product_material" => $product_material, "product_size" => $product_size]);
    }

    public function post(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'pname' => 'required',
            'stitching_rate_a' => 'required',
        ]);
        if (isset($request->id) && !empty($request->id)) {

            $data = Product::where('id', $request->id)->update([
                'name' => @$request->pname,
                'customer_id' => @$request->customer_id,
                'stitching_rate_a' => @$request->stitching_rate_a,
                'stitching_rate_b' => @$request->stitching_rate_b,
                'commission_rate' => @$request->commission_rate,
                'elastic_commission_rate' => @$request->elastic_commission_rate,
                'magzi_commission_rate' => @$request->magzi_commission_rate,
                'individual_packing' => @$request->individual_packing,
                'bundle_packing' => @$request->bundle_packing,
                'inner_carton' => @$request->inner_carton,
                'master_carton' => @$request->master_carton,
                'unit' => @$request->unit,
                'user_id' => Auth::user()->id,
                'hs_code' => @$request->hs_code,
                'brand_id' => @$request->brand_id
            ]);

            ProductSize::where('product_id', $request->id)->delete();
            if (isset($request->sizes)) {
                $sizes = $request->sizes;
                for ($k = 0; $k < sizeof($sizes); $k++) {
                    $size = new ProductSize();
                    $size->product_id           = $request->id;
                    $size->size_id           = $request->sizes[$k];
                    $size->inner_carton_dimension  =  @$request->inner_carton_dimension[$k];
                    $size->master_carton_dimension  =  @$request->master_carton_dimension[$k];
                    $size->article_rate            =  @$request->article_rate[$k];
                    $size->net_weight_per_carton   =  @$request->net_weight_per_carton[$k];
                    $size->gross_weight_per_carton =  @$request->gross_weight_per_carton[$k];
                    $size->cbm                     =  @$request->cbm[$k];
                    $size->save();
                }
            }

            ProductMaterial::where('product_id', $request->id)->delete();

            if (isset($request->material_id)) {
                $material_id = $request->material_id;
                for ($k = 0; $k < sizeof($material_id); $k++) {
                    $material = new ProductMaterial();
                    $material->material_id          = $request->material_id[$k];
                    $material->material_hand_rate   = @$request->material_hand_rate[$k];
                    $material->material_press_rate  = @$request->material_press_rate[$k];
                    $material->consumption  = @$request->consumption[$k];
                    $material->measurement  = @$request->measurement[$k];
                    $material->usaged  = @$request->usaged[$k];
                    $material->product_id           = $request->id;
                    $material->save();
                }
            }

            if (isset($_FILES['fileToUpload']['name'][0])) {
                for ($f = 0; $f < (sizeof($_FILES['fileToUpload']['name']) - 1); $f++) {
                    $filename  = basename($_FILES['fileToUpload']['name'][$f]);
                    $extension = pathinfo($filename, PATHINFO_EXTENSION);
                    $new       = pathinfo($filename)['filename'] . "_" . time() . '.' . $extension;
                    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$f], storage_path('product') . "/{$new}");
                    $img = new Image();
                    $img->image          = @$new;
                    $img->product_id     = $request->id;
                    $img->save();
                }
            }
        } else {
            if (Product::where('name', $request->pname)->where('customer_id', $request->customer_id)->count() > 0) {
                return ["error" => "Product is alredy in used."];
            }

            $data = new Product();
            $data->name                         = $request->pname;
            $data->customer_id                  = @$request->customer_id;
            $data->stitching_rate_a             = @$request->stitching_rate_a;
            $data->stitching_rate_b             = @$request->stitching_rate_b;
            $data->commission_rate              = @$request->commission_rate;
            $data->elastic_commission_rate      = @$request->elastic_commission_rate;
            $data->magzi_commission_rate        = @$request->magzi_commission_rate;
            $data->individual_packing           = @$request->individual_packing;
            $data->bundle_packing               = @$request->bundle_packing;
            $data->inner_carton                 = @$request->inner_carton;
            $data->master_carton                = @$request->master_carton;
            $data->unit                         = @$request->unit;
            $data->user_id                      = Auth::user()->id;
            $data->hs_code                      = @$request->hs_code;
            $data->brand_id                     = @$request->brand_id;
            $data->save();

            if (isset($request->sizes)) {
                $sizes = $request->sizes;
                for ($k = 0; $k < sizeof($sizes); $k++) {
                    $size = new ProductSize();
                    $size->product_id           = $data->id;
                    $size->size_id           = $request->sizes[$k];
                    $size->inner_carton_dimension  =  @$request->inner_carton_dimension[$k];
                    $size->master_carton_dimension  =  @$request->master_carton_dimension[$k];
                    $size->article_rate            =  @$request->article_rate[$k];
                    $size->net_weight_per_carton   =  @$request->net_weight_per_carton[$k];
                    $size->gross_weight_per_carton =  @$request->gross_weight_per_carton[$k];
                    $size->cbm                     =  @$request->cbm[$k];
                    $size->save();
                }
            }

            if (isset($request->material_id)) {
                $material_id = $request->material_id;
                for ($k = 0; $k < sizeof($material_id); $k++) {
                    $material = new ProductMaterial();
                    $material->material_id          = $request->material_id[$k];

                    $material->material_hand_rate   = @$request->material_hand_rate[$k];
                    $material->material_press_rate  = @$request->material_press_rate[$k];
                    $material->consumption  = @$request->consumption[$k];
                    $material->measurement  = @$request->measurement[$k];
                    $material->usaged  = @$request->usaged[$k];
                    $material->product_id           = $data->id;
                    $material->save();
                }
            }

            if (isset($_FILES['fileToUpload']['name'][0])) {
                for ($f = 0; $f < (sizeof($_FILES['fileToUpload']['name']) - 1); $f++) {
                    $filename  = basename($_FILES['fileToUpload']['name'][$f]);
                    $extension = pathinfo($filename, PATHINFO_EXTENSION);
                    $new       = pathinfo($filename)['filename'] . "_" . time() . '.' . $extension;
                    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$f], storage_path('product') . "/{$new}");
                    $img = new Image();
                    $img->image          = @$new;
                    $img->product_id     = $data->id;
                    $img->save();
                }
            }
        }
        return ["success" => "Successfully Added.", "redirect" => route('product.view')];
    }
    public function detail(Request $request)
    {
        $data = Product::with(['productsize.size', 'images', 'productmaterial.material', 'customer'])->where('id', $request->id)->first();
        return view('superadmin.product.detail')->with(['title' => 'Product Detail', 'data' => $data]);
    }

    public function delete_image(Request $request)
    {
        $delete = File::delete(storage_path('product') . "/" . $request->file);
        Image::where('image', $request->file)->delete();
        return 'true';
    }

    public function delete(Request $request)
    {
        Product::where('id', $request->id)->delete();
        ProductMaterial::where('product_id', $request->id)->delete();
        $images = Image::where('product_id', $request->id)->get();
        foreach ($images as $img) {
            $delete = File::delete(storage_path('product') . "/" . $img->image);
            Image::where('image', $img->image)->delete();
        }
        return ["success" => "Successfully Deleted.", "redirect" => route('product.view')];
    }
}