<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<link rel="stylesheet" href="{{ public_path('css/font-awesome/css/font-awesome.min.css') }}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="{{ asset('css/opmaak.css') }}" rel="stylesheet">

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    {{--    This is the student's profile page. It is accessable through the first button on the main page's student list--}}
    <div class="container" style="margin-top:100px;">

        <div class="container">
            @foreach($students as $row)
                {{--    this shows the avatar the student chose--}}
                <div class="row rowcard">
                    <div class="col-4">
                    <div class="card">
                        <div class="col-8">
                            @if($row->avatar == 'monster-1')
                                <img src="/images/avatar/1 Avatar.png" style="width:100%">
                            @elseif($row->avatar == 'monster-2')
                                <img src="/images/avatar/2 Avatar.png" style="width:100%">
                            @elseif($row->avatar == 'monster-3')
                                <img src="/images/avatar/3 Avatar.png" style="width:100%">
                            @elseif($row->avatar == 'monster-4')
                                <img src="/images/avatar/4 Avatar.png" style="width:100%">
                            @elseif($row->avatar == 'monster-5')
                                <img src="/images/avatar/5 Avatar.png" style="width:100%">
                            @elseif($row->avatar == 'monster-6')
                                <img src="/images/avatar/6 Avatar.png" style="width:100%">
                            @elseif($row->avatar == 'monster-7')
                                <img src="/images/avatar/7 Avatar.png" style="width:100%">
                            @elseif($row->avatar == 'monster-8')
                                <img src="/images/avatar/8 Avatar.png" style="width:100%">
                            @elseif($row->avatar == '')
                                <img src="{{asset('images/nopicture.png')}}" style="width:100%">
                            @endif
                        </div>
                    </div>
                </div>
                    {{--    this shows the student's name at the top--}}
                    <div class="col-8">
                        <div class="card2">
                            <h1>Profiel :{{$row->first_name}} {{$row->last_name}}</h1>
                        </div>
                    </div>
                    <div class="col-4">
                    </div>
                    {{--    all the student's info is shown in this part.--}}
                <div class="col-3">
                    <div class="card1">
                        <p>Nickname: </p>
                        <p>Email:</p>
                        <p>Color:</p>
                        <p>Hobby's:</p>
                        <p>Aangemaakt op: </p>
                        <br>
                    </div>
                </div>
                    <div class="col-5">
                        <div class="card1">
                            <p> </p>
                            <p>{{$row->nickname}}</p>
                            <p>{{$row->email}}</p>
                            <p>{{$row->color}}</p>
                            <p>{{$row->interests}}</p>
                            <p>{{$row->created_at}}</p>
                            <br>
                        </div>
                    </div>
                </div>
        @endforeach
        </div>
    </div>
    <footer class="page-footer">
        <div class="footer-copyright text-center py-3">© 2020 HAPPY
        </div>
    </footer>
</x-app-layout>
