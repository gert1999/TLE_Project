<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<link rel="stylesheet" href="{{ public_path('css/font-awesome/css/font-awesome.min.css') }}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link href="{{ asset('css/opmaak.css') }}" rel="stylesheet">
<style>
    .btn {
        background-color: #f5d142;
        border: none;
        color: white;
        padding: 8px;
        font-size: 15px;
        cursor: pointer;
    }
    .btn:hover {
        background-color: RoyalBlue;
    }
    .switch3 {
        display: none;
    }

    #switch4 {
        display: none;
        background-color: #3155ed;
        border: none;
        color: white;
        padding: 9px;
        text-align: center;
        text-decoration: none;
        font-size: 14px;
        margin: 10px 2px;
        cursor: pointer;
        float: right;
        border-radius: 4px;
    }
    #switch3{
        background-color: #3155ed;
        border: none;
        color: white;
        padding: 9px;
        text-align: center;
        text-decoration: none;
        font-size: 14px;
        margin: 10px 2px;
        cursor: pointer;
        float: right;
        border-radius: 4px;
    }

    #switch2 {
        display: none;
        background-color: #3155ed;
        border: none;
        color: white;
        padding: 9px;
        text-align: center;
        text-decoration: none;
        font-size: 14px;
        margin: 10px 2px;
        cursor: pointer;
        float: right;
        border-radius: 4px;
    }
    #switch{
        background-color: #3155ed;
        border: none;
        color: white;
        padding: 9px;
        text-align: center;
        text-decoration: none;
        font-size: 14px;
        margin: 10px 2px;
        cursor: pointer;
        float: right;
        border-radius: 4px;
    }

    #switch_inactief{
        display:none;
    }


</style>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
{{--    Offset seen from top--}}
    <div class="container" style="margin-top:100px;">
    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Volledige naam</th>
                <th scope="col">E-mailadres</th>
                <th scope="col">Aangemaakt op</th>
                <th scope="col">Acties</th>
                <th scope="col">Status</th>

            </tr>
            </thead>
            <tbody>
            <button id="switch">Toon alle leerlingen</button>
            <button id="switch2">Toon eigen klas</button>

            <button id="switch3">Toon inactieve leerlingen</button>
            <button id="switch4">Toon actieve leerlingen</button>
            {{--    student list when active and own students are set--}}
            @foreach($students as $row)
                @if($row->status == 'active')
                    <tr class="switch1">
                        <th scope="row">{{$row->id}}</th>
                        <td>{{$row->first_name}} {{$row->last_name}} </td>
                        <td>{{$row->email}}</td>
                        <td>{{$row->created_at}}</td>
                        <td>
                            <a href="{{route('info', $row->id)}}"> <button class="btn"><i class="fa fa-address-card"></i></button></a>
                            <a href="{{route('show', $row->id)}}"><button class="btn"><i class="fa fa-signal"></i></button></a>
                            <button class="btn"><i class="fa fa-edit"></i></button>
                            <a href="{{url("/delete/$row->id")}}"><button class="btn" onclick="return confirm('Are you sure you want to delete this usere?');"><i class="fa fa-times"></i></button></a>
                        </td>
                        @if ($feeling[$row->id] >= 3)
                            <td data-toggle="tooltip" title="de leerling heeft {{$feeling[$row->id]}} opeenvolgende negatieve reacties geplaatst">⚠️</td>
                        @else
                            <td data-toggle="tooltip" title="het gaat goed met de leerling">✔️</td>
                        @endif
                    </tr>
                @else

                @endif
            @endforeach
            {{--    student list when students are set and all students are set.--}}
            @foreach($studentNumber as $row1)
                <tr class="switch3">
                    <th scope="row">{{$row1->id}}</th>
                    <td>{{$row1->first_name}} {{$row1->last_name}} </td>
                    <td>{{$row1->email}}</td>
                    <td>{{$row1->created_at}}</td>
                    <td>
                        <a href="{{route('info', $row1->id)}}"> <button class="btn"><i class="fa fa-address-card"></i></button></a>
                        <a href="{{route('show', $row1->id)}}"><button class="btn"><i class="fa fa-signal"></i></button></a>
                        <button class="btn"><i class="fa fa-edit"></i></button>
                        <a href="{{url("/delete/$row->id")}}"><button class="btn"><i class="fa fa-times"></i></button></a>
                    </td>

                    @if ($feeling[$row1->id] >= 3)
                        <td data-toggle="tooltip" title="de leerling heeft {{$feeling[$row1->id]}} opeenvolgende negatieve reacties geplaatst">⚠</td>
                    @else
                        <td data-toggle="tooltip" title="het gaat goed met de leerling">✔️</td>
                    @endif
                </tr>
            @endforeach
            {{--    student list when students are set to inactive--}}
            @foreach($students as $row)
                @if($row->status == 'inactive')
                    <tr id="switch_inactief">
                        <th scope="row">{{$row->id}}</th>
                        <td>{{$row->first_name}} {{$row->last_name}} </td>
                        <td>{{$row->email}}</td>
                        <td>{{$row->created_at}}</td>
                        <td>
                            <a href="{{url("/active/$row->id")}}"><button class="btn">Actief maken</button></a>
                        </td>

                        @if ($feeling[$row->id] >= 3)
                            <td data-toggle="tooltip" title="de leerling heeft {{$feeling[$row->id]}} opeenvolgende negatieve reacties geplaatst">⚠️</td>
                        @else
                            <td data-toggle="tooltip" title="het gaat goed met de leerling">✔️</td>
                        @endif
                    </tr>
                @else

                @endif
            @endforeach
            </tbody>
        </table>
    </div>
    </div>
    {{--    this creates the happy footer--}}
        <footer class="page-footer">
        <div class="footer-copyright text-center py-3">© 2020 HAPPY
        </div>
    </footer>
    {{--    these scripts allow the buttons switching between list states to work--}}
        <script>
            $(document).ready(function(){
                $('[data-toggle="tooltip"]').tooltip();
            });

            $(document).ready(function(){
                $('#switch').click(function() {
                    $('.switch1').hide();
                    $('#switch').hide();
                    $('.switch3').show();
                    $('#switch2').show();
                    $('#switch_inactief').hide();
                })
                $('#switch2').click(function() {
                    $('.switch1').show();
                    $('#switch').show();
                    $('.switch3').hide();
                    $('#switch2').hide();
                    $('#switch_inactief').hide();
                })
                $('#switch3').click(function() {
                    $('#switch_inactief').show();
                    $('#switch4').show();
                    $('#switch3').hide();
                    $('.switch1').hide();
                    $('.switch3').hide();
                })
                $('#switch4').click(function() {
                    $('.switch1').show();
                    $('#switch3').show();
                    $('#switch4').hide();
                    $('#switch_inactief').hide();
                })
            });

            function alert() {
                if (confirm('Are you sure you want to save this thing into the database?')) {
                    // Save it!
                    console.log('Thing was saved to the database.');
                    window.location.assign("/delete/@foreach($students as $row) {{$row->id}} @endforeach");
                } else {
                    // Do nothing!
                    console.log('Thing was not saved to the database.');
                }
            }
        </script>
</x-app-layout>

