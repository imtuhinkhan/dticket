<?php 
namespace App\Repositories;
use Illuminate\Http\Request;
use App\Interfaces\TicketInterface;
use App\Models\Ticket;
use App\Models\TicketReplies;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Repositories\CategoryRepository;
use Auth;
class TicketRepository implements TicketInterface{
    public function getAllTicket(){
        $ticket = Ticket::with('service','category','priority','customer','lastReply')->get();
        return $ticket;
    }

    public function getAllOpenTicket(){
        $ticket = Ticket::with('service','category','priority','customer','lastReply')->where([['status'=>1]])->get();
        return $ticket;
    }

    public function getAllReOpenTicket(){
        $ticket = Ticket::with('service','category','priority','customer','lastReply')->where('status',2)->get();
        return $ticket;
    }

    public function getAllCloseSolvedTicket(){
        $ticket = Ticket::with('service','category','priority','customer','lastReply')->where('status',3)->get();
        return $ticket;
    }

    public function getAllCloseUnSolvedTicket(){
        $ticket = Ticket::with('service','category','priority','customer','lastReply')->where('status',4)->get();
        return $ticket;
    }

    //customer wise ticket
    public function getAllTicketByCustomer(){
        $ticket = Ticket::with('service','category','priority','customer','lastReply')->where(['customer_id'=> Auth::user()->id])->get();
        return $ticket;
    }
    public function getAllOpenTicketByCustomer(){

        $ticket = Ticket::with('service','category','priority','customer','lastReply')->with('service','category','priority','customer','lastReply')->where(['customer_id'=>Auth::user()->id,'status'=>1])->get();
        return $ticket;
    }

    public function getAllReOpenTicketByCustomer(){
        $ticket = Ticket::with('service','category','priority','customer','lastReply')->where(['customer_id'=>Auth::user()->id,'status'=>2])->get();
        return $ticket;
    }

    public function getAllCloseSolvedTicketByCustomer(){
        $ticket = Ticket::with('service','category','priority','customer','lastReply')->where(['customer_id'=>Auth::user()->id,'status'=>3])->get();
        return $ticket;
    }

    public function getAllCloseUnSolvedTicketByCustomer(){
        $ticket = Ticket::with('service','category','priority','customer','lastReply')->where(['customer_id'=>Auth::user()->id,'status'=>4])->get();
        return $ticket;
    }
    private function getLastTicketId(){
        return $ticket = Ticket::orderby('id','DESC')->first()->id;
    }
    public function addTicket(Request $req){
        $categoryRepository =new CategoryRepository();
        $ticket = new Ticket();
        $ticket->title = $req->title;
        $ticket->description = $req->description;
        $ticket->service_id = $req->service;
        $ticket->category_id = $req->category;
        $ticket->priority_id = $req->priority;
        $ticket->customer_id = Auth::user()->id;
        $ticket->last_replay_by = 0;
        $ticket->status = 1;
        $ticket->uniqueId = $categoryRepository->findById($req->category)->name.'-'.$this->getLastTicketId();
        if ($files = $req->file('photo')) {
            $path = 'images/ticket/';
            $fimage = uniqid() . "." . $files->getClientOriginalExtension();
            $files->move($path, $fimage);
            $ticket->image = $path.$fimage;
       }
        $ticket->save();
        return $ticket;
    }
}