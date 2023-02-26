<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\UploadHelper;
use App\Models\Commodity;
use App\Models\Processor;
use App\Models\User;
use App\Models\Farmer;

use App\Models\State;
use App\Models\District;
use App\Models\Feedback;
use App\Models\Fpo;
use App\Models\SubDistrict;
use App\Models\Village;
use App\Models\StackholderProcurementCenterInfo;
use App\Models\Trade;
use App\Models\UserProcurement;
use App\Models\WarehouseType;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Symfony\Component\Process\Process;
use Yajra\DataTables\Facades\DataTables;

class ReportController extends Controller
{
    public function index()
    {
        $warehouse_types = WarehouseType::get();
        $states = State::get();
        $districts = District::get();
        $sub_districts = SubDistrict::get();
        $villages = Village::get();
        $result = [];

        $query = UserProcurement::query();
        $centerReport = $query->with('user', 'warehouseType', 'state', 'district', 'subDistrict', 'village')->get();

        foreach ($centerReport as $report) {
            $result[] = array(
                'name' => $report->user ? $report->user->name : $report->user->company_name,
                'mobile' => $report->user ? $report->user->mobile_number : '',
                'warehouse_address' => $report->warehouse_address,
                'warehouse_capacity' => $report->warehouse_capacity,
                'warehouse_type_uid' => $report->warehouseType ? $report->warehouseType->warehouse_type_name : '',
                'state_uid' => $report->state ? $report->state->state_name : '',
                'district_uid' => $report->district ? $report->district->district_name : '',
                'sub_district_uid' => $report->subDistrict ? $report->subDistrict->sub_district_name : '',
                'village_uid' => $report->village ? $report->village->village_name : '',
                'added_on' => date('d/m/Y', strtotime($report->created_at)),
            );
        }

        return view('admin.report.index', compact('warehouse_types', 'states', 'districts', 'sub_districts', 'villages', 'result'));
    }

    public function filter(Request $request)
    {
        $warehouse_types = WarehouseType::get();
        $states = State::get();
        $districts = District::get();
        $sub_districts = SubDistrict::get();
        $villages = Village::get();
        $result = [];

        $user_type = $request->user_type;
        $warehouse_type_uid = $request->warehouse_type_uid;
        $state_uid = $request->state_uid;
        $district_uid = $request->district_uid;
        $sub_district_uid = $request->sub_district_uid;
        $village_uid = $request->village_uid;
        $from_date = $request->from_date;
        $to_date = $request->to_date;

        $query = UserProcurement::query();

        if (!empty($warehouse_type_uid)) {
            $query->where('warehouse_type_uid', $warehouse_type_uid);
        }

        if (!empty($user_type)) {
            $query->where('user_type', $user_type);
        }

        if (!empty($state_uid)) {
            $query->where('state_uid', $state_uid);
        }

        if (!empty($district_uid)) {
            $query->where('district_uid', $district_uid);
        }

        if (!empty($sub_district_uid)) {
            $query->where('sub_district_uid', $sub_district_uid);
        }

        if (!empty($village_uid)) {
            $query->where('village_uid', $village_uid);
        }

        if (!empty($from_date)) {
            $query->whereDate('created_at', '>=', $from_date);
        }

        if (!empty($to_date)) {
            $query->whereDate('created_at', '<=', $to_date);
        }

        $centerReport = $query->with('user', 'warehouseType', 'state', 'district', 'subDistrict', 'village')->get();

        foreach ($centerReport as $report) {
            $result[] = array(
                'name' => $report->user ? $report->user->name : $report->user->company_name,
                'mobile' => $report->user ? $report->user->mobile_number : '',
                'warehouse_address' => $report->warehouse_address,
                'warehouse_capacity' => $report->warehouse_capacity,
                'warehouse_type_uid' => $report->warehouseType ? $report->warehouseType->warehouse_type_name : '',
                'state_uid' => $report->state ? $report->state->state_name : '',
                'district_uid' => $report->district ? $report->district->district_name : '',
                'sub_district_uid' => $report->subDistrict ? $report->subDistrict->sub_district_name : '',
                'village_uid' => $report->village ? $report->village->village_name : '',
                'added_on' => date('d/m/Y', strtotime($report->created_at)),
            );
        }

        return view('admin.report.index', compact('warehouse_types', 'states', 'districts', 'sub_districts', 'villages', 'result', 'user_type', 'warehouse_type_uid', 'state_uid', 'district_uid', 'sub_district_uid', 'village_uid', 'from_date', 'to_date'));
    }


    public function feedbackList()
    {
        $datas = Feedback::orderBy('id', 'desc')->get();
        // if (request()->ajax()) {
        //     $feedbacks = Feedback::orderBy('id', 'desc')->get();

        //     $datatable = DataTables::of($feedbacks)
        //         ->addIndexColumn()

        //         ->editColumn('user_type', function ($row) {
        //             if ($row->user_type == 'farmer') {
        //                 return 'Farmer';
        //             } else if ($row->user_type == 'fpo') {
        //                 return 'FPO';
        //             } else if ($row->user_type == 'trader') {
        //                 return 'Trader';
        //             } else if ($row->user_type == 'processor') {
        //                 return 'Processor';
        //             }
        //         })
        //         ->editColumn('rate', function ($row) {
        //             return $row->rate;
        //         })
        //         ->editColumn('message', function ($row) {
        //             return $row->message;
        //         })
        //         ->editColumn('created_at', function ($row) {
        //             return $row->created_at ? $row->created_at->format('d/m/Y') : '';
        //         });
        //     $rawColumns = ['action', 'user_type', 'rate', 'message', 'created_at'];
        //     return $datatable->rawColumns($rawColumns)
        //         ->make(true);
        // }
        return view('admin.report.feedback.index',compact('datas'));
    }
}
