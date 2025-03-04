<?php
namespace App\Http\Controllers;

use App\User;
use Modules\Hotel\Models\Hotel;
use Modules\Location\Models\LocationCategory;
use Modules\Page\Models\Page;
use Modules\News\Models\NewsCategory;
use Modules\News\Models\Tag;
use Modules\News\Models\News;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Modules\User\Models\Subscriber;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function about() {

        $home_page_id = setting_item('home_page_id');

        if($home_page_id && $page = Page::where("id",10)->where("status","publish")->first())
        {
            $this->setActiveMenu($page);
            $translation = $page->translate();
            $seo_meta = $page->getSeoMetaWithTranslation(app()->getLocale(), $translation);
            $seo_meta['full_url'] = url("/");
            $seo_meta['is_homepage'] = true;
            $data = [
                'row'=>$page,
                "seo_meta"=> $seo_meta,
                'translation'=>$translation,
                'is_home' => true,
            ];
            return view('home.about',$data);
        }
        return view('home.about');
    }
    
    public function termsAndConditions() {

        return view('home.terms-and-conditions');
    }

    public function faq() {
        $home_page_id = setting_item('home_page_id');

        if($home_page_id && $page = Page::where("id",12)->where("status","publish")->first())
        {
            $this->setActiveMenu($page);
            $translation = $page->translate();
            $seo_meta = $page->getSeoMetaWithTranslation(app()->getLocale(), $translation);
            $seo_meta['full_url'] = url("/");
            $seo_meta['is_homepage'] = true;
            $data = [
                'row'=>$page,
                "seo_meta"=> $seo_meta,
                'translation'=>$translation,
                'is_home' => true,
            ];
            return view('home.faq',$data);
        }
        return view('home.faq');
    }
    public function index()
    {
        $home_page_id = setting_item('home_page_id');

        if($home_page_id && $page = Page::where("id",$home_page_id)->where("status","publish")->first())
        {
            $this->setActiveMenu($page);
            $translation = $page->translate();
            $seo_meta = $page->getSeoMetaWithTranslation(app()->getLocale(), $translation);
            $seo_meta['full_url'] = url("/");
            $seo_meta['is_homepage'] = true;
            $data = [
                'row'=>$page,
                "seo_meta"=> $seo_meta,
                'translation'=>$translation,
                'is_home' => true,
            ];
            return view('home.index',$data);
        }
        $model_News = News::where("status", "publish");
        $data = [
            'rows'=>$model_News->paginate(5),
            'model_category'    => NewsCategory::where("status", "publish"),
            'model_tag'         => Tag::query(),
            'model_news'        => News::where("status", "publish"),
            'breadcrumbs' => [
                ['name' => __('News'), 'url' => url("/news") ,'class' => 'active'],
            ],
            "seo_meta" => News::getSeoMetaForPageList()
        ];
        return view('News::frontend.index',$data);
    }

    public function checkConnectDatabase(Request $request){
        $connection = $request->input('database_connection');
        config([
            'database' => [
                'default' => $connection."_check",
                'connections' => [
                    $connection."_check" => [
                        'driver' => $connection,
                        'host' => $request->input('database_hostname'),
                        'port' => $request->input('database_port'),
                        'database' => $request->input('database_name'),
                        'username' => $request->input('database_username'),
                        'password' => $request->input('database_password'),
                    ],
                ],
            ],
        ]);
        try {
            DB::connection()->getPdo();
            $check = DB::table('information_schema.tables')->where("table_schema","performance_schema")->get();
            if(empty($check) and $check->count() == 0){
                return $this->sendSuccess(false , __("Access denied for user!. Please check your configuration."));
            }
            if(DB::connection()->getDatabaseName()){
                return $this->sendSuccess(false , __("Yes! Successfully connected to the DB: ".DB::connection()->getDatabaseName()));
            }else{
                return $this->sendSuccess(false , __("Could not find the database. Please check your configuration."));
            }
        } catch (\Exception $e) {
            return $this->sendError( $e->getMessage() );
        }
    }

    public function subscribe(Request $request){
        $request->validate([
            'email' => 'required|email',
        ]);

        $email = $request->input('email');
        $check = Subscriber::where('email',$email)->first();
        if($check) {
            return $this->sendError( __("Email already exists") );
        }

        $subscriber = new Subscriber();
        $subscriber->email = $email;
        $subscriber->save();
        return $this->sendSuccess( "Thank you for subscribing" );
    }
}
