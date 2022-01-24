<?php 
namespace App\Repositories;
use Illuminate\Http\Request;
use App\Interfaces\TicketInterface;
use App\Models\Ticket;
use App\Models\TicketReplay;
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
        $ticket = Ticket::with('service','category','priority','customer','lastReply')->where('status',1)->get();
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
    private function generateUniqueId(){
         $ticket = sprintf("%06d", mt_rand(1, 999999));
         return $ticket;
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
        $ticket->uniqueId = $this->generateUniqueId();
        if ($files = $req->file('photo')) {
            $path = 'public/images/ticket/';
            $fimage = uniqid() . "." . $files->getClientOriginalExtension();
            $files->move($path, $fimage);
            $ticket->image = $path.$fimage;
       }
        $ticket->save();
        $this->sendTicketMail($ticket,Auth::user()->email);
        return $ticket;
    }
    public function findById($id){
        return $ticket = Ticket::with('service','category','priority','customer','lastReply','comments')->findorfail($id);

    }
    public function changeStatus($id,$status){
        $ticket = $this->findById($id);
        $ticket->status = $status;
        $ticket->save();
        return $ticket;
    }

    public function ticketDetails($id){
        return $ticket = $this->findById($id);
    }

    public function ticketReplaySave(Request $req){
        $reply = new TicketReplay();
        $reply->reply=$req->reply;
        if ($files = $req->file('photo')) {
            $path = 'public/images/ticket/';
            $fimage = uniqid() . "." . $files->getClientOriginalExtension();
            $files->move($path, $fimage);
            $reply->image = $path.$fimage;
        }
        $reply->ticket_id = $req->ticketID;	
        $reply->user_id	= Auth::user()->id;
        $reply->save();
        if(!Auth::user()->hasRole('customer')){
            $ticket = $this->findById($req->ticketID);
            $ticket->last_replay_by =Auth::user()->id;
            $ticket->save();
        }
        return $reply;
    }

    public function countTicket(){
        $open =count($this->getAllOpenTicket());
        $reopen =count($this->getAllReOpenTicket());
        $resolved =count($this->getAllCloseSolvedTicket());
        $unsolved =count($this->getAllCloseUnSolvedTicket());
        return [
            'open'=>$open,
            'reopen'=>$reopen,
            'resolved'=>$resolved,
            'unsolved'=>$unsolved,
        ];
    }
    public function countTicketByCustomer(){
        $open =count($this->getAllOpenTicketByCustomer());
        $reopen =count($this->getAllReOpenTicketByCustomer());
        $resolved =count($this->getAllCloseSolvedTicketByCustomer());
        $unsolved =count($this->getAllCloseUnSolvedTicketByCustomer());
        return [
            'open'=>$open,
            'reopen'=>$reopen,
            'resolved'=>$resolved,
            'unsolved'=>$unsolved,
        ];
    }

    public function sendTicketMail($ticket,$send_mail){
        dispatch(new \App\Jobs\SendEmailJob($send_mail,$ticket));
    }
}