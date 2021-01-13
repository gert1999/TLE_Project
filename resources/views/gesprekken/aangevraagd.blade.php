<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ public_path('css/font-awesome/css/font-awesome.min.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ asset('css/opmaak.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>


    <style>
        /* The popup form - hidden by default */
        .form-popup {
            display: none;
            position: fixed;
            bottom: 0;
            right: 15px;
            border: 3px solid #f1f1f1;
            z-index: 9;
        }

        /* Add styles to the form container */
        .form-container {
            max-width: 300px;
            height:300px;
            padding: 10px;
            background-color: white;
        }

        /* Full-width input fields */
        .form-container input[type=text], .form-container input[type=password] {
            width: 100%;
            padding: 15px;
            margin: 5px 0 22px 0;
            border: none;
            background: #f1f1f1;
        }

        /* When the inputs get focus, do something */
        .form-container input[type=text]:focus, .form-container input[type=password]:focus {
            background-color: #ddd;
            outline: none;
        }

        /* Set a style for the submit/login button */
        .form-container .btn {
            background-color: #4CAF50;
            color: white;
            padding: 16px 20px;
            border: none;
            cursor: pointer;
            width: 100%;
            margin-bottom:10px;
            opacity: 0.8;
        }

        /* Add a red background color to the cancel button */
        .form-container .cancel {
            background-color: red;
        }

        /* Add some hover effects to buttons */
        .form-container .btn:hover, .open-button:hover {
            opacity: 1;
        }
    </style>
</head>
<body>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Aangevraagde gesprekken') }}
        </h2>
    </x-slot>
    <div class="container" style="margin-top:100px;">
        <div class="container">
            @if($students_count == 0)
                <h1>Op dit moment zijn er geen aangevraagde gesprekken.</h1>
            @else
                @foreach($students as $row)
                    <div class="row rowcard" style="margin-top:30px;">
                        <div class="col-4">
                            <div class="card" style="border:none!important">
                                <div class="col-8">
                                    @if($row->avatar == 'monster-1')
                                        <img src="/images/avatar/1 Avatar.png" style="width:60%">
                                    @elseif($row->avatar == 'monster-2')
                                        <img src="/images/avatar/2 Avatar.png" style="width:60%">
                                    @elseif($row->avatar == 'monster-3')
                                        <img src="/images/avatar/3 Avatar.png" style="width:60%">
                                    @elseif($row->avatar == 'monster-4')
                                        <img src="/images/avatar/4 Avatar.png" style="width:60%">
                                    @elseif($row->avatar == 'monster-5')
                                        <img src="/images/avatar/5 Avatar.png" style="width:60%">
                                    @elseif($row->avatar == 'monster-6')
                                        <img src="/images/avatar/6 Avatar.png" style="width:60%">
                                    @elseif($row->avatar == 'monster-7')
                                        <img src="/images/avatar/7 Avatar.png" style="width:60%">
                                    @elseif($row->avatar == 'monster-8')
                                        <img src="/images/avatar/8 Avatar.png" style="width:60%">
                                    @elseif($row->avatar == '')
                                        <img src="{{asset('images/nopicture.png')}}" style="width:60%">
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="card1" style="position:relative;top:13px;">
                                <p><b>Voornaam:</b> {{$row->first_name}}</p>
                                <p><b>Achternaam:</b> {{$row->last_name}}</p>
                                <p><b>Email:</b> {{$row->email}}</p>
                                <p><b>Onderwerp:</b> {{$row->subject}}</p>
                                <p><b>Bericht:</b> {{$row->message}}</p>
                                <br>
                            </div>
                        </div>
                        <form action="{{route('edit_aangevraagd')}}" method="post" class="form-container">
                            @csrf
                            <div class="col-12">
                                <div class="card1">
                                    <p><b>Datum:</b><input type="date" id="email_insert" placeholder="Enter Email" name="datum_aangevraagd" value="<?php echo date('Y-m-d'); ?>" required style="border:1px solid black; margin-left:15px;"><br /></p>
                                    <p><b>Start tijd:</b><input type="time" id="time_start_insert" placeholder="Enter Email" name="start_time_aangevraagd" value="" required step="900" style="border:1px solid black"><br /></p>
                                    <p><b>Eind tijd:</b><input type="time" id="time_end_insert" placeholder="Enter Email" name="end_time_aangevraagd" value="" required step="900" style="border:1px solid black; margin-left:1px;"><br /></p>
                                    <br>
                                    <input type="text" id="student_id5" placeholder="Enter student" name="student_id_aangevraagd" value="{{$row->id}}" required autocomplete="off" hidden>
                                    <button><p style="font-size:16px;">Afspraak plannen <i class="fa fa-arrow-circle-o-right"></i></p></button>
                                </div>
                            </div>
                        </form>
                    </div>
                @endforeach
            @endif
        </div>
        </div>
</x-app-layout>
</body>
</html>
