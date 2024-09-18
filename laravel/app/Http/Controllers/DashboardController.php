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
        if (Auth::user()->hasRole('Company User')) {
            $company_id = CompanyUserSession::where('key', 'company_id')->first();
            if($company_id->value==null){
                $response=(new SessionAction())->execute();
            }
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
        return $interface->execute();
    }

    private function getTickets($ticketCount, $orderBy)
    {
        return Ticket::orderBy('id', $orderBy)->take($ticketCount)->get();
    }
}
