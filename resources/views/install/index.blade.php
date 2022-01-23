@extends('install.layout')
@section('content')
    <form action="{{url('/')}}/installtion/step1" method="POST">
        @csrf
        <h1>DTICKET INSTALLATION</h1>
        <h3 style="text-align: center">Database Configuration</h3>
        <div class="formcontainer">
        <hr/>
        <div class="container">
        <label for="uname"><strong>Database Host</strong></label>
        <input type="text" placeholder="Enter Database Host" name="dbhost" required>
        <label for="psw"><strong>Database Name</strong></label>
        <input type="password" placeholder="Enter Database Name" name="dbname" required>

        <label for="uname"><strong>Database User</strong></label>
        <input type="text" placeholder="Enter Database user" name="uname" required>
        <label for="psw"><strong>Database Password</strong></label>
        <input type="password" placeholder="Enter Database Password" name="psw" required>
        </div>
        <button type="submit">Next</button>
    </form>   
@endsection
    
