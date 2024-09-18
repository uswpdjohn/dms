<?php

namespace App\Http\Controllers;

use App\Actions\Ticket\TicketAdminListAction;
use App\Actions\Ticket\TicketDownloadAction;
use App\Actions\Ticket\TicketReopenAction;
use App\Actions\Ticket\TicketCreateAction;
use App\Actions\Ticket\TicketDestroyAction;
use App\Actions\Ticket\TicketGetAction;
use App\Actions\Ticket\TicketListAction;
use App\Actions\Ticket\TicketShowAction;
use App\Actions\Ticket\TicketUpdateAction;
use App\Http\Requests\CreateTicketRequest;
use App\Http\Requests\TicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Interfaces\Ticket\DeleteTicketInterface;
use App\Interfaces\Ticket\DownloadTicketInterface;
use App\Interfaces\Ticket\GetTicketInterface;
use App\Interfaces\Ticket\ListAdminTicketInterface;
use App\Interfaces\Ticket\ListTicketInterface;
use App\Interfaces\Ticket\ReopenTicketInterface;
use App\Interfaces\Ticket\ShowTicketInterface;
use App\Interfaces\Ticket\StoreTicketInterface;
use App\Interfaces\Ticket\UpdateTicketInterface;
use App\Models\Service;
use App\Models\Ticket;
use App\Notifications\TicketNotification;
use Illuminate\Http\Request;

class TicketController extends Controller
{

    public function index(Request $request, ListTicketInterface $interface)
    {
        $tickets=$interface->execute([],$request->has('page_count') ? $request->page_count : config('paginate.page_count'),'DESC');
        return view('ticket.index', ['tickets'=>$tickets]);
    }

    public function adminIndex(Request $request, ListAdminTicketInterface $interface)
    {
        if (auth()->guard('web')->user()->can('create.support_ticket') || auth()->guard('web')->user()->can('edit.support_ticket') ||
            auth()->guard('web')->user()->can('view.support_ticket') || auth()->guard('web')->user()->can('delete.support_ticket'))
        {
//            $tickets=(new TicketAdminListAction())->execute('DESC',$request->has('page_count') ? $request->page_count : config('paginate.page_count'));
            $tickets=$interface->execute([],'DESC',$request->has('page_count') ? $request->page_count : config('paginate.page_count'));
            if ($request->ajax()){
                return $tickets;
            }
//            return $tickets;
            return view('ticket.adminIndex', ['tickets'=>$tickets]);
        }else {
            abort(403, 'You do not have access to this action!');
        }

    }

    public function create()
    {
        //
    }
    public function edit($slug, GetTicketInterface $interface){
        if (auth()->guard('web')->user()->can('edit.support_ticket')) {
            $ticket = $interface->execute(['slug' => $slug]);
            return view('ticket.manage', ['ticket'=>$ticket]);
        }else {
            abort(403, 'You do not have access to manage the ticket.');
//            return $response  = array('abort' => '403','message'=> 'Oops! Access has been restricted.');
        }
    }


    public function store(CreateTicketRequest $request, StoreTicketInterface $interface)
    {
        $response = $interface->execute($validatedData=$request->validated());


        if (key_exists('success', $response)){
            return redirect()->route('dashboard')->with('success','Ticket Submitted Successfully');
        }elseif (key_exists('send_mail', $response)){
            return redirect()->route('dashboard')->with('error','An error occurred. Please try again after sometime');
        }
    }
    public function storeFromFaq(CreateTicketRequest $request,StoreTicketInterface $interface)
    {
        $response = $interface->execute($validatedData=$request->validated());
        if (response($response)->getStatusCode() == 200){
            return $response  = array('success' => '1', 'response'=>$response, 'message'=> 'Ticket No. '.$response->ticket_no.' was created successfully. Admin will get back to you within 2 - 5 workings days.');
        }
//        return $response  = array('success' => '0',);
//        return redirect()->route('customer-support.index')->with('success','');
    }

    public function show($slug,ShowTicketInterface $interface)
    {
        try {
            $response = $interface->execute(['slug' => $slug]);
            return response()->json($response);
        }catch (\Exception $exception){
            return $exception->getMessage();
        }
    }


    public function reopen($id, ReopenTicketInterface $interface)
    {
        try {
            $response =$interface->execute(['id'=>$id]);
            return redirect()->route('ticket.edit',$response->slug);
//            return response()->json($response);
        }catch (\Exception $exception){
            return $exception->getMessage();
        }
    }
    public function update(UpdateTicketRequest $request,$id, UpdateTicketInterface $interface){
        try {
            $response =$interface->execute($validatedData=$request->validated() + ['id' =>$id]);
            return redirect()->route('admin.support.ticket')->with('success', 'Ticket Updated Successfully');
//            return response()->json($response);
        }catch (\Exception $exception){
            return $exception->getMessage();
        }
    }


    public function destroy($slug, DeleteTicketInterface $interface)
    {
        try {
            $response = $interface->execute(['slug' => $slug]);
            return response()->json($response);
        }catch (\Exception $exception){
            return $exception->getMessage();
        }
    }

    public function downloadTicket($id, DownloadTicketInterface $interface)
    {
        $response= $interface->execute(['id' => $id]);
        return response()->download($response);
    }
}
