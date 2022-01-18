<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\TicketRepository;
use App\Models\Service;
use App\Models\Category;
use App\Models\Priority;
use Auth;
use Alert;
class TicketController extends Controller
{
    public $ticketRepository;

    public function __construct(TicketRepository $ticketRepository )
    {
        $this->ticketRepository = $ticketRepository;
        $this->middleware('auth');   
    }
    public function openTicketList(){
        if(Auth::user()->hasRole('customer')){
            $ticket = $this->ticketRepository->getAllOpenTicketByCustomer();
        }else{
            $ticket = $this->ticketRepository->getAllOpenTicket();
        }
        $tag='Open Tickets';
        return view('ticket.ticket',compact('ticket','tag'));
    }

    public function reOpenTicketList(){
        if(Auth::user()->hasRole('customer')){
            $ticket = $this->ticketRepository->getAllReOpenTicketByCustomer();
        }else{
            $ticket = $this->ticketRepository->getAllReOpenTicket();
        }
        $tag='Open Tickets';
        return view('ticket.ticket',compact('ticket','tag'));
    }

    public function closeSolved(){
        if(Auth::user()->hasRole('customer')){
            $ticket = $this->ticketRepository->getAllCloseSolvedTicketByCustomer();
        }else{
            $ticket = $this->ticketRepository->getAllCloseSolvedTicket();
        }
        $tag='Open Tickets';
        return view('ticket.ticket',compact('ticket','tag'));
    }

    public function closeUnsolved(){
        if(Auth::user()->hasRole('customer')){
            $ticket = $this->ticketRepository->getAllCloseUnSolvedTicketByCustomer();
        }else{
            $ticket = $this->ticketRepository->getAllCloseUnSolvedTicket();
        }
        $tag='Open Tickets';
        return view('ticket.ticket',compact('ticket','tag'));
    }
    


    public function addTicketForm(){
        $service = Service::where('is_active',1)->get();
        $category = Category::where('is_active',1)->get();
        $priority = priority::where('is_active',1)->get();
        return view('ticket.form',compact('priority','category','service'));
    }

    public function saveTicket(Request $req){
        $formData = $req->all();
        $validator = \Validator::make($formData,[
            'title' =>'required',
            'service' =>'required',
            'category' =>'required',
            'priority' =>'required',
            'description' =>'required',
        ]);

        if($validator->fails()){
            Alert::error('Something Went Wrong', $validator->getMessageBag()->first());
            return redirect()->back();
        }
        $ticket = $this->ticketRepository->addTicket($req);
        if(!$ticket){
            Alert::error('Error','Something Went Wrong');
            return redirect()->back();

        }else{
            return redirect()->route('ticket');
        }
    }

    public function changeStatus($id,$status){
        $ticket = $this->ticketRepository->changeStatus($id,$status);
        if($ticket){
            Alert::success('Success','Ticket mark as '. ticketStatus($status));
            return redirect()->back();
        }
    }

    public function ticketDetails($id){
        $ticket = $this->ticketRepository->ticketDetails($id);
        if(Auth::user()->hasRole('customer') && Auth::user()->id!=$ticket->customer_id){
            return redirect('/unauthorized');
        }

        return view('ticket.details',compact('ticket'));
    }

    public function ticketReplaySave(Request $req){
        $ticket = $this->ticketRepository->ticketReplaySave($req);
        Alert::success('Success','Reply Send');
            return redirect()->back();
    }
}
