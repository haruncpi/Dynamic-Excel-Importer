@extends('app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <br>
                <img src="{{asset("public/images/home-image.png")}}" alt="hero">
            </div>
            <div class="col-md-offset-1 col-md-8">
                <br>
                <br>
                <h1>Dynamic Excel Importer</h1>
                <h3>Import your csv,xls,xlsx file's data to your any database's table</h3>
                <p>Let's see what we can do</p>
                <ul>
                    <li>Support CSV,XLS,XLSX file format.</li>
                    <li>Automatically fetch all database from your database connection.</li>
                    <li>Auto list table from selected database.</li>
                    <li>Import data to any database's table.</li>
                    <li>Import data by mapping table column.</li>
                    <li>Ajax functionality.</li>
                </ul>
                <br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="{{route('importRoute')}}" class="btn btn-warning btn-lg">LET'S TRY</a>
            </div>
        </div>
    </div>
@endsection



