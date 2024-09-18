<?php

namespace App\Http\Controllers;

use App\Actions\CompanyManagement\CompanyManagementShowAction;
use App\Actions\Dashboard\ChartAction;
use App\Actions\Dashboard\GetDashboardData;
use App\Actions\Session\SessionAction;
use App\Actions\Ticket\TicketAdminListAction;
use App\Helpers\Helper;
use App\Interfaces\Dashboard\ChartInterface;
use App\Interfaces\Ticket\ListAdminTicketInterface;
use App\Models\Category;
use App\Models\CompanyUserSession;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard(ListAdminTicketInterface $interface)
    {
//        dd(session()->all());



//        abort_unless(Auth::guard('web')->check(), 403, 'You do not have access to this action!');

        if (Auth::user()->hasRole('Company User')) {
            $company_id = CompanyUserSession::where('key', 'company_id')->first();
            if($company_id->value==null){
                $response=(new SessionAction())->execute();
            }
//            dd(Helper::auth_user_company());
//            abort_unless(
//                \session()->get('auth_user_company') != null,
//                403,
//                'Oops! We are unable to find you in any of companies. Contact with Admin to assign any of companies'
//            );

            return view('companyManagement.info',
                array(
                    'response' => (new CompanyManagementShowAction())->execute(Helper::auth_user_company()),
                    'categories' => Category::all()
                )
            );
        }
        $data=  (new GetDashboardData())->execute();
        return view('dashboard.dashboard',compact('data'));

    }
    public function getPieChartData(ChartInterface $interface)
    {
//        return (new ChartAction())->execute();
        return $interface->execute();
    }

    private function getTickets($ticketCount, $orderBy)
    {
        /*$item = Ticket::orderBy('id', $orderBy)->take($ticketCount)->get();
        return $item;*/

        return Ticket::orderBy('id', $orderBy)->take($ticketCount)->get();
    }
}
