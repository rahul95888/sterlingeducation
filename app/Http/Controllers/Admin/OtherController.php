<?php

namespace App\Http\Controllers\Admin;

use App\Helper\UploadHelper;
use App\Http\Controllers\Controller;
use App\Models\Trade;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class OtherController extends Controller
{
    public function getAllTrades()
    {
        if (request()->ajax()) {
            $trades = Trade::orderBy('id', 'desc')->get();

            $datatable = DataTables::of($trades)
                ->addIndexColumn()
                ->addColumn(
                    'action',
                    function ($row) {
                        $html = '';
                        $html .= '<a class="btn btn-primary btn-sm me-3" title="View Trade Details" href="' . route('trade-details', $row->id) . '"><i class="bx bx-detail"></i></a>';
                        return $html;
                    }
                )
                ->editColumn('name', function ($row) {
                    return $row->user ? ($row->user->name ? $row->user->name : $row->user->company_name) : '';
                })
                ->editColumn('commodity_uid', function ($row) {
                    return $row->commodity ? $row->commodity->name : '';
                })
                ->editColumn('variety_uid', function ($row) {
                    return $row->variety ? $row->variety->variety_name : '';
                })
                ->editColumn('quantity', function ($row) {
                    return $row->quantity;
                })
                ->editColumn('price', function ($row) {
                    return $row->price;
                })
                ->editColumn('address', function ($row) {
                    return $row->address;
                });
            $rawColumns = ['action', 'name', 'commodity_uid', 'variety_uid', 'quantity', 'price', 'address'];
            return $datatable->rawColumns($rawColumns)
                ->make(true);
        }

        return view('admin.others.trades');
    }

    public function getTradeDetails($trade_id)
    {
        $trade = Trade::find($trade_id);

        if (is_null($trade)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('trades');
        }
        $trade->load('user', 'commodity', 'variety', 'state', 'city', 'pincode', 'country');
        return view('admin.others.trade-details', compact('trade'));
    }
}
