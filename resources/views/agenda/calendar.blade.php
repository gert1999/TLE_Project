<?php
//index.php




?>
    <!DOCTYPE html>
<html>
<head>
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
            height:430px;
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
    <script>

        $(document).ready(function() {
            var calendar = $('#calendar').fullCalendar({
                editable:true,
                header:{
                    left:'prev,next today',
                    center:'title',
                    right:'month,agendaWeek,agendaDay'
                },
                events: '{{route('load_calendar')}}',
                selectable:true,
                selectHelper:true,
                select: function(start, end, allDay)
                {
                    document.getElementById("myForm").style.display = "block";
                    document.getElementById("myForm_edit").style.display = "none";
                    document.getElementById("email_insert").value = $.fullCalendar.formatDate(start, "Y-MM-DD");
                    document.getElementById("time_start_insert").value = $.fullCalendar.formatDate(start, "HH:mm:ss");
                    document.getElementById("time_end_insert").value = $.fullCalendar.formatDate(end, "HH:mm:ss");
                    // var title = prompt("Enter Event Title");
                    {{--if(title)--}}
                    {{--{--}}
                    //     console.log($.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss"));
                        // var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
                    {{--    $.ajax({--}}
                    {{--        url:"{{asset('php/insert.php')}}",--}}
                    {{--        type:"POST",--}}
                    {{--        data:{title:title, start:start, end:end},--}}
                    {{--        success:function()--}}
                    {{--        {--}}
                    {{--            calendar.fullCalendar('refetchEvents');--}}
                    {{--            alert("Added Successfully");--}}
                    {{--        }--}}
                    {{--    })--}}
                    {{--}--}}
                },
                editable:true,
                eventResize:function(event)
                {
                    var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                    var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                    var title = event.title;
                    var id = event.id;
                    $.ajax({
                        url:"{{asset('php/update.php')}}",
                        type:"POST",
                        data:{title:title, start:start, end:end, id:id},
                        success:function(){
                            calendar.fullCalendar('refetchEvents');
                            alert('Event Update');
                        }
                    })
                },

                eventDrop:function(event)
                {
                    var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                    var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                    var title = event.title;
                    var id = event.id;
                    $.ajax({
                        url:"{{asset('php/update.php')}}",
                        type:"POST",
                        data:{title:title, start:start, end:end, id:id},
                        success:function()
                        {
                            calendar.fullCalendar('refetchEvents');
                            alert("Event Updated");
                        }
                    });
                },

                eventClick:function(event)
                {
                    document.getElementById("myForm_edit").style.display = "block";
                    document.getElementById("myForm").style.display = "none";
                    document.getElementById("email_insert2").value = $.fullCalendar.formatDate(event.start, "Y-MM-DD");
                    document.getElementById("time_start_insert2").value = $.fullCalendar.formatDate(event.start, "HH:mm:ss");
                    document.getElementById("time_end_insert2").value = $.fullCalendar.formatDate(event.end, "HH:mm:ss");
                    document.getElementById("student_id").value = event.student_id;
                    document.getElementById("student_id2").value = event.id;
                    document.getElementById("student_id3").value = event.id;
                },


            });
        });

    </script>
</head>
<body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Agenda afspraken') }}
            </h2>
        </x-slot>
        <div class="container">
            <div id="calendar" style="margin-top:80px;"></div>
        </div>
        <div class="form-popup" id="myForm">
            <form action="{{route('insert_calendar')}}" method="post" class="form-container">
                @csrf
                <h1>Afspraak maken</h1>
            <div class="form-group">
                <label for="psw"><b>Student</b></label>
                <input type="text" id="country_name" placeholder="Enter student" name="student" required autocomplete="off">
                <div id="countryList"></div>
            </div>
                {{csrf_field()}}
            <div class="form-group">
                <label for="email"><b>Datum</b></label>
                <input type="date" id="email_insert" placeholder="Enter Email" name="datum" value="" required><br />
            </div>
            <div class="form-group">
                <label for="email"><b>Start tijd</b></label>
                <input type="time" id="time_start_insert" placeholder="Enter Email" name="start_time" value="" required step="900"><br />
            </div>
            <div class="form-group">
                <label for="email"><b>Eind tijd</b></label>
                <input type="time" id="time_end_insert" placeholder="Enter Email" name="end_time" value="" required step="900"><br />
            </div>
            <div class="form-group">
                <button type="submit" id="btn-inplannen" onclick="setTimeout(myFunction, 100);" class="btn">Afspraak inplannen</button>
                <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
            </div>
            </form>
        </div>

        <div class="form-popup" id="myForm_edit">
            <form action="{{route('edit_calendar')}}" method="post" class="form-container">
                @csrf
                <h1 style="padding-bottom:20px;">Afspraak bewerken</h1>
                <div class="form-group">
                    <label for="email"><b>Datum</b></label>
                    <input type="date" id="email_insert2" placeholder="Enter Email" name="datum2" value="" required><br />
                </div>
                <div class="form-group">
                    <label for="email"><b>Start tijd</b></label>
                    <input type="time" id="time_start_insert2" placeholder="Enter Email" name="start_time2" value="" required step="900"><br />
                </div>
                <div class="form-group">
                    <label for="email"><b>Eind tijd</b></label>
                    <input type="time" id="time_end_insert2" placeholder="Enter Email" name="end_time2" value="" required step="900"><br />
                    <input type="text" id="student_id" placeholder="Enter student" name="student_id" required autocomplete="off" hidden>
                    <input type="text" id="student_id3" placeholder="Enter student" name="student_id3" required autocomplete="off" hidden>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn">Afspraak bewerken</button>
                    <button type="button" class="btn cancel" onclick="closeForm2()">Close</button>
                </div>
            </form>
            <form action="{{route('delete')}}" method="post">
                @csrf
                <input type="text" id="student_id2" placeholder="Enter student" name="student_id2" required autocomplete="off" hidden>
                <button type="submit" style="padding:20px;text-align:center;width:100%;color:red;background-color:white;">Afspraak verwijderen</button>
            </form>
        </div>

    </x-app-layout>
</body>
<script>
    function closeForm() {
        document.getElementById("myForm").style.display = "none";
    }

    function closeForm2() {
        document.getElementById("myForm_edit").style.display = "none";
    }

    $(document).ready(function(){
        $('#country_name').keyup(function(){
            var query = $(this).val();

            if(query !== ''){
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url:"{{route('fetch')}}",
                    method:"POST",
                    data:{query:query, _token:_token},
                    success:function(data){
                        $('#countryList').fadeIn();
                        $('#countryList').html(data);
                    }
                })
            }
            if(query === '') {
                $('#countryList').fadeOut();
            }
        })
        $(document).on('click', 'li', function(){
            $('#country_name').val($(this).text());
            $('#countryList').fadeOut();
        })


    });

    function myFunction() {
        document.getElementById("btn-inplannen").disabled = true;
    }
</script>
</html>
