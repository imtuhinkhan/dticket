<?php

namespace App\Http\Controllers;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Repositories\TicketRepository;
use App\Models\Ticket;
use Carbon\Carbon;
use Auth;

class DashboardController extends Controller
{
    public function __construct(TicketRepository $ticketRepository )
    {
        $this->ticketRepository = $ticketRepository;
        $this->middleware('auth');   
    }
    public function index(){
        $user = Auth::user();
        $datename = array();
        $solved = array();
        $unsolved = array();
        $count = $this->ticketRepository->countTicket();
        if(!Auth::user()->hasRole('customer')){
            $count = $this->ticketRepository->countTicket();
        }else{
            $count = $this->ticketRepository->countTicketByCustomer();
        }
        $date = Carbon::now();
        $datename[] = $date->format('F');
        for($i=5;$i>0; $i--){
            $datename[]=$date->subMonth(1)->format('F');
        }

        foreach(array_reverse($datename) as $row=>$val){
            $month =Carbon::parse($val)->month;
            $solved[]=Ticket::whereMonth('created_at',$month)->where('status',3)->count();
            $unsolved[]=Ticket::whereMonth('created_at',$month)->where('status',4)->count();
        }

        if(Auth::user()->hasRole('customer')){
            $data[]=Ticket::where(['status'=>3,'customer_id'=>Auth::user()->id])->count();
            $data[]=Ticket::where(['status'=>4,'customer_id'=>Auth::user()->id])->count();
            $ticket=Ticket::where(['customer_id'=>Auth::user()->id])->get();
            return view('customer-dashboard',compact('count','datename','solved','unsolved','data','ticket'));

        }else{
            return view('dashboard',compact('count','datename','solved','unsolved'));
        }
    }
}
