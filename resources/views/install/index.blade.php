@extends('install.layout')
@section('content')
    <form action="/action_page.php">
        <h1>DTICKET INSTALLATION</h1>
        <h3 style="text-align: center">Database Configuration</h3>
        <div class="formcontainer">
        <hr/>
        <div class="container">
        <label for="uname"><strong>Database Host</strong></label>
        <input type="text" placeholder="Enter Username" name="uname" required>
        <label for="psw"><strong>Database Name</strong></label>
        <input type="password" placeholder="Enter Password" name="psw" required>

        <label for="uname"><strong>Database User</strong></label>
        <input type="text" placeholder="Enter Username" name="uname" required>
        <label for="psw"><strong>Database Password</strong></label>
        <input type="password" placeholder="Enter Password" name="psw" required>
        </div>
        <button type="submit">Next</button>
    </form>   
@endsection
    
