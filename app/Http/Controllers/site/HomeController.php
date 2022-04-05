<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Config;
use App\Models\SeoPage;
use App\Models\Category;
use App\Http\Controllers\Helpers\captcha;
use App\Models\Service;
use App\Models\Products;
use App\Models\Standard;
use App\Models\News;
use App\Models\Photo;
use App\Models\Recruit;
use App\Models\NewsTranslation;
use App\Models\Review;
use App\Models\ServiceTranslation;
use App\Models\PageTranslation;
use App\Models\Video;
use File;
use App\Models\Region;
use App\Models\StandardTranslation;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Artisan;

class HomeController extends Controller
{
    public function siteMap()
    {       
        Artisan::call('sitemap:create');
    }
    
    public function index()
    { 
        // echo App::currentLocale();
        $settings = Config::all(['name', 'value'])
            ->keyBy('name')
            ->transform(function ($setting) {
                return $setting->value; // return only the value
            })
            ->toArray();
        $image = json_decode(json_encode([
            "mimeType" => "image/png",
            "width" => 110,
            "height" => 110,
        ]));
        $locale = Session::get('locale');
        $nhaDatNB = Products::select('products.slug','products.photo','products.name','tinhthanhpho.name AS tinh','quanhuyen.name AS quan','products.price','products.area','products.created_at','types_house.title')
        ->join('tinhthanhpho','tinhthanhpho.matp','=','products.city')
        ->join('quanhuyen','quanhuyen.maqh','=','products.district')
        ->join('types_house','types_house.id','=','products.type_house_id')
        ->where('products.type', 1)->where('products.status', 1)->where('products.noi_bac', 1)->paginate(6);

        // $nhaDatKV = Products::select('products.photo','tinhthanhpho.name AS tinh','products.price','products.area','products.created_at','types_house.title')
        // ->join('tinhthanhpho','tinhthanhpho.matp','=','products.city')
        // ->where('products.type', 1)->where('products.status', 1)->take(6)->get();
        $regionArray = array();
        $region = Region::get();
        foreach ($region as $key => $value) {
           $regionArray[$key] = $value->tp_id;
        }
        $regionArray = array_unique($regionArray);
        
        $nhaDat = Products::where('type', 1)->where('status', 1)->orderBy('id','DESC')->take(6)->get();
        $duAn = NewsTranslation::join('news','news.id','=','news_translations.news_id')->where('news_translations.locale',$locale)
        ->where('news.status', 1)->where('news.noi_bac', 1)->where('news.type', 'du-an')->orderBy('news.id', 'DESC')->take(6)->get();
        $serviceGri = ServiceTranslation::join('services','services.id','=','service_translations.service_id')->where('service_translations.locale',$locale)
        ->where('services.status', 1)->where('services.noi_bac', 1)->orderBy('services.id', 'DESC')->paginate(5);
        $review = Review::where('status',1)->where('noi_bac',1)->get();
        $slider = Photo::where('status',1)->where('type','slide')->orderBy('stt','ASC')->get();
        $album = Photo::where('status',1)->where('type','album')->orderBy('stt','ASC')->get();
       
        $video = Video::where('status',1)->where('noi_bac',1)->orderBy('id','DESC')->get();
        $news = News::where('status', 1)->where('noi_bac', 1)->where('type','news')->orderBy('id', 'DESC')->take(6)->get();
        $partner = Photo::where('type','partner')->where('status',1)->get();
        $standard = StandardTranslation::join('standards','standards.id','=','standard_translations.standard_id')->where('standard_translations.locale',$locale)
        ->where('standards.status', 1)->where('standards.status', 1)->orderBy('standards.stt', 'ASC')->get();
        $pageGT = PageTranslation::join('pages','pages.id','=','page_translations.page_id')->where('page_translations.locale',$locale)->where('pages.slug','gioi-thieu')->first();
        $category = Category::where('status', 1)->orderBy('stt', 'ASC')->get();
        // $recruit = RecruitTranslation::join('recruits','recruits.id','=','recruit_translations.recruit_id')->where('recruit_translations.locale',$locale)
        //->where('recruits.status', 1)->where('recruits.noi_bac', 1)->orderBy('recruits.id', 'DESC')->first();
        // $cate_product = Products::select('products.id','products.name','products.price','products.view','products.photo','categories.name AS category_name')
        // ->join('categories', 'categories.id','=','products.category_id')
        // $products = Products::join('services','services.id','=','service_translations.service_id')->where('service_translations.locale',$locale)
        // ->where('services.status', 1)->where('services.noi_bac', 1)->orderBy('services.id', 'DESC')->paginate(6);
        // ->where('categories.id',$category_noibac[0]['id'])->where('products.type',0)->where('products.status',1)->orderBy('categories.stt', 'ASC')->paginate($settings['PHAN_TRANG_PRODUCT']);
        return view('site.home.index', compact('regionArray','news','nhaDatNB','nhaDat','video','album','partner','slider','settings', 'image', 'pageGT', 'standard', 'duAn', 'serviceGri'));
    }

    public function showMap(Request $request)
    {
        $nhaDat = Products::where('status', 1)->where('noi_bac', 1)->where('id', $request->id)->where('type', 1)->first();

        if (isset($nhaDat)) {
            return response()->json([
                'status' => true,
                'data' => $nhaDat,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'msg' => 'get failed',
            ]);
        }
    }

    public function getProductByCategory(Request $request){
        $settings = Config::all(['name', 'value'])
            ->keyBy('name')
            ->transform(function ($setting) {
                return $setting->value; // return only the value
            })
            ->toArray();
        $output = "";
        $p ="";
        $cate_product = Products::select('products.id','products.name','products.price','products.view','products.slug','products.photo','categories.name AS category_name')
        ->join('categories', 'categories.id','=','products.category_id')
        ->where('categories.id',$request->id)->where('products.type',0)->where('products.noi_bac',1)->where('products.status',1)->orderBy('stt', 'ASC')->paginate($settings['PHAN_TRANG_PRODUCT']);
        $output .= '<div class="row">';
        foreach ($cate_product as $key => $item) {
            if($item->price == NULL){
                $p = '<p class="product-price">Giá: <a href="tel:'.$settings['PHONE'].'" class="contact-product">Liên hệ</a> </p>';
            }else{
                $p = '<p class="product-price">Giá: <a href="/san-pham/'.$item->slug.'" class="contact-product">'.number_format($item->price, 0, ',', '.').' đ</a> </p>';
            }
            $output .= '
            <div class="col-md-3 col-6 img-flu">
                <div class="border-col">
                <div class="detail-product-link">
                    <a href="/san-pham/'.$item->slug.'"><img src="public/upload/images/product/thumb/'.$item->photo.'" alt="">
                    </a>
                    </div>
                    <a href="/san-pham/'.$item->slug.'"><h6 class="product-name">'.$item->name.'</h6></a>
                    
                    <div class="price-view">
                        '.$p.'
                        <p class="product-views">Lượt xem: '.$item->view.'</p>
                    </div>
                </div>
        </div>';
        }
        $output .= "</div>";

        echo $output;
    }

    public function readMore(Request $request)
    {
        $locale = Session::get('locale');
        $format = new Captcha();
        $output = "";
        $page = $request->page;
        $productPage = 6;
        $form = ($page - 1) * $productPage;
        $nhaDat = Products::select('products.photo','products.name','products.slug','tinhthanhpho.name AS tinh','quanhuyen.name AS quan','products.price','products.area','products.created_at','types_house.title')
        ->join('tinhthanhpho','tinhthanhpho.matp','=','products.city')
        ->join('quanhuyen','quanhuyen.maqh','=','products.district')
        ->join('types_house','types_house.id','=','products.type_house_id')
        ->where('products.type', 1)->where('products.status', 1)->where('products.noi_bac', 1)->paginate($productPage);

        foreach ($nhaDat as $key => $item) {
            $output .= '<div class="col col-md-4">
            <div class="box-product">
                <a href="/bds/'.$item->slug.'">
                    <img class="card-img-top"
                        src="'.asset('public/upload/images/nhaDat/thumb/'.$item->photo).'"
                        alt="{{ $item->title }}">
                </a>
                <p class="home-title"><a href="/bds/'.$item->slug.'">'.$item->name.'</a></p>
                <div class="box-price-bds">
                    <img style="width: 25px;height: 25px; margin-right: 10px; margin-top: -6px;"
                        src="'.asset('public/site/images/house-money.png').'">
                    <span id="box-inner-price">'.$format->jam_read_num_forvietnamese($item->price).'</span>
                    <span>-&nbsp;'.$item->area.'m<sup>2</sup></span>
                    <div class="date-post">
                        <svg width="24px" height="24px" viewBox="0 0 24 24" id="Layer_1" data-name="Layer 1"
                            xmlns="http://www.w3.org/2000/svg" class="clock-eight">
                            <path
                                d="M12,6a.99974.99974,0,0,0-1,1v4.38379L8.56934,12.60693a.99968.99968,0,1,0,.89843,1.78614l2.98145-1.5A.99874.99874,0,0,0,13,12V7A.99974.99974,0,0,0,12,6Zm0-4A10,10,0,1,0,22,12,10.01146,10.01146,0,0,0,12,2Zm0,18a8,8,0,1,1,8-8A8.00917,8.00917,0,0,1,12,20Z" />
                        </svg>
                        '.$item->created_at->format('d-m-Y').'
                    </div>
                </div>
                <div class="box-time-bds" style="width: 100%; text-align: right; padding-top: 7px; ">
                    <span>'.$item->title.'</span>
                </div>
                <div class="box-adress-bds"><span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" class="map">
                            <path
                                d="M168.3 499.2C116.1 435 0 279.4 0 192C0 85.96 85.96 0 192 0C298 0 384 85.96 384 192C384 279.4 267 435 215.7 499.2C203.4 514.5 180.6 514.5 168.3 499.2H168.3zM192 256C227.3 256 256 227.3 256 192C256 156.7 227.3 128 192 128C156.7 128 128 156.7 128 192C128 227.3 156.7 256 192 256z" />
                        </svg>
                        '.$item->tinh . ', ' . $item->quan.'</span></div>
            </div>
        </div>';
        }
        return $output;

    }

    public function Search(Request $request)
    {
        $search = $request->q;

        $locale = Session::get('locale');
        $data = ServiceTranslation::join('services','services.id','=','service_translations.service_id')
        ->where("title", "like", '%' . $request->q . '%')
        ->where('service_translations.locale',$locale)
        ->where('services.status', 1)->orderBy('services.id', 'DESC')->paginate(8);;

        $settings = Config::all(['name', 'value'])
            ->keyBy('name')
            ->transform(function ($setting) {
                return $setting->value; // return only the value
            })
            ->toArray();
        $seoPage = SeoPage::where('type', 'san-pham')->first();
          
        return view('site.product.search', compact('data', 'seoPage', 'settings','search'));

    }

    public function showProductInCategoryLV1($id){
        $settings = Config::all(['name', 'value'])
            ->keyBy('name')
            ->transform(function ($setting) {
                return $setting->value; // return only the value
            })
            ->toArray();
        $output = "";
        $p ="";
        $cate_lv1_show_product = DB::table('categories_lv1')->select('products.name','products.slug','products.view','products.photo','products.price','products.id')
        ->leftJoin('categories','categories.category_lv1_id','=','categories_lv1.id')
        ->leftJoin('products','products.category_id','=','categories.id')->where('categories_lv1.noi_bac',1)->where('categories_lv1.status',1)->where('categories_lv1.id',$id)->where('categories.status',1)->where('products.status',1)->where('products.noi_bac',1)->where('products.type',0)->orderBy('categories.stt','ASC')->limit(4)->get();
        $output .= '<div class="row">';
        foreach ($cate_lv1_show_product as $key => $item) {
            if($item->price == NULL){
                $p = '<p class="product-price">Giá: <a href="tel:'.$settings['PHONE'].'" class="contact-product">Liên hệ</a> </p>';
            }else{
                $p = '<p class="product-price">Giá: <a href="/san-pham/'.$item->slug.'" class="contact-product">'.number_format($item->price, 0, ',', '.').' đ</a> </p>';
            }
            $output .= '
            <div class="col-md-3 col-6 img-flu">
                <div class="border-col">
                <div class="detail-product-link">
                    <a href="/san-pham/'.$item->slug.'"><img src="public/upload/images/product/thumb/'.$item->photo.'" alt="">
                    </a>
                    </div>
                    <a href="/san-pham/'.$item->slug.'"><h6 class="product-name">'.$item->name.'</h6></a>
                    
                    <div class="price-view">
                        '.$p.'
                        <p class="product-views">Lượt xem: '.$item->view.'</p>
                    </div>
                </div>
        </div>';
        }
        $output .= "</div>";

        echo $output;
    }

    public function hoverCategoryLV1(Request $request){

        $cate_slide = DB::table('categories')
            ->select('categories.name', 'categories.slug', 'categories.id')
            ->join('categories_lv1', 'categories_lv1.id', '=', 'categories.category_lv1_id')
            ->where('categories.status', 1)
            ->where('categories_lv1.id', $request->id)
            ->orderBy('categories.stt', 'ASC')
            ->get();
        $output = "";
        foreach ($cate_slide as $key => $item) {
            $output .= '<a href="/danh-muc/'.$item->slug.'">'.$item->name.'</a>';
        }
        echo $output;
    }
}
