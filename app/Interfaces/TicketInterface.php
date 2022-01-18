<?php 
namespace App\Interfaces;
use Illuminate\Http\Request;

interface TicketInterface{
    public function getAllTicket();
    public function getAllOpenTicket();
    public function getAllReOpenTicket();
    public function getAllCloseSolvedTicket();
    public function getAllCloseUnSolvedTicket();
    public function getAllTicketByCustomer();
    public function getAllOpenTicketByCustomer();
    public function getAllReOpenTicketByCustomer();
    public function getAllCloseSolvedTicketByCustomer();
    public function getAllCloseUnSolvedTicketByCustomer();
    public function addTicket(Request $request);
    public function ticketReplaySave(Request $request);
    public function changeStatus($id,$status);
    public function ticketDetails($id);
}