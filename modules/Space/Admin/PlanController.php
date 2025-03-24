<?php
namespace Modules\Space\Admin;

use Illuminate\Http\Request;
use Modules\Core\Events\CreatedServicesEvent;
use Modules\Core\Events\UpdatedServiceEvent;
use Modules\FrontendController;
use Modules\Space\Models\SpaceDate;
use Modules\Space\Models\SpacePlans;

class PlanController extends FrontendController
{
    protected $indexView = 'Space::admin.plan.index';

    public function __construct()
    {
        parent::__construct();
        $this->space_plans = SpacePlans::class;
        $this->setActiveMenu(route('space.admin.plan.index'));
        $this->middleware('dashboard');
    }

    public function index(Request $request) {
        $plans = SpacePlans::query();
        if (!empty($search = $request->query('s'))) {
            $plans->where('name', 'LIKE', '%' . $search . '%');
        }
        $plans->orderBy('created_at', 'desc');
        $data = [
            'rows'        => $plans->get(),
            'row'         => new $this->space_plans(),
            'breadcrumbs' => [
                [
                    'name' => __('Products'),
                    'url'  => route('space.admin.index')
                ],
                [
                    'name'  => __('Plans'),
                    'class' => 'active'
                ],
            ]
        ];
        return view('Space::admin.plan.index',$data);
    }

    public function store( Request $request, $id ){
       

        if($id>0){
            $this->checkPermission('space_update');
            $row = $this->space_plans::find($id);
       
            if (empty($row)) {
                return redirect(route('space.admin.plan.index'));
            }

        }else{
            $this->checkPermission('space_create');
            $row = new $this->space_plans();
            //$row->status = "publish";
        }
     
        $row['name'] = $request['name'];
        $row['days'] = $request['days'];
        $row['partner_days'] = $request['partner_days'];
        $row->save();
        if($id > 0 ){
            //event(new UpdatedServiceEvent($row));
            return back()->with('success',  __('Pricing plan updated') );
        }else{
            //event(new CreatedServicesEvent($row));
            return redirect(route('space.admin.plan.edit',$row->id))->with('success', __('Pricing plan created') );
        }
    }

    public function edit($id) {
        $this->checkPermission('space_update');
        $row = $this->space_plans::find($id);
        if (empty($row)) {
            return redirect(route('space.admin.plan.index'));
        }
        $data = [
            'row' => $row,
            'breadcrumbs' => [
                [
                    'name' => __('Products'),
                    'url'  => route('space.admin.index')
                ],
                [
                    'name'  => __('Plans'),
                    'url' => route('space.admin.plan.index')
                ],
                [
                    'name'  => __('Edit Plan'),
                    'class' => 'active'
                ],

            ],
            'page_title'=>__("Edit: :name",['name'=>$row->name])
        ];
        return view('Space::admin.plan.detail',$data);
    }



}
