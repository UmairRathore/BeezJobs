<?php

namespace App\Http\Controllers\Admin;
use App\Models\Message;

?>

    <div class="col-xl-4">
        <div class="msgs-list mb30">
            <div class="msg-title1">
                <div class="srch_br">
                    <input class="list_search" type="text" placeholder="Search by name" id="searchNameInput">
                    <i class="fas fa-search list_srch_icon"></i>
                </div>
            </div><!--msg-title end-->
            <div id="messages-List" class="messages-list scrollstyle_4">
                <ul>
{{--                    {{dd($leftwallmessages)}}--}}
                    @foreach($leftwallmessages as $data)

                        <li class="active message-item" data-firstname="{{ $data->first_name }}">
                            <div class="usr-msg-details">
                                <a id="seen-message" href="{{route('freelancer_texting',[$data->id])}}">
                                    <div class="usr-ms-img">
{{--                                        @if($data->profile_image)--}}
{{--                                            <img src="{{asset($data->profile_image)}}" alt="">--}}
{{--                                        @else--}}
                                            <img src="{{asset('images/user-dp-1.jpg')}}" alt="">
{{--                                        @endif--}}
                                        <span class="msg-status"></span>
                                    </div>
                                    <div class="usr-mg-info">
                                        <h3>{{ $data->first_name .' '.$data->last_name}}</h3>
                                        <?php
                                        $latestMessage = Message::select('messages.created_at','messages.message')
                                            ->whereIn('sender_id', [$data->id,Auth()->user()->id])
                                            ->whereIn('receiver_id',[$data->id,Auth()->user()->id])
                                            ->orderby('created_at', 'desc')
                                            ->where('message','!=',Null)
                                            ->first();
                                        ?>
                                        <p>{{ $latestMessage->message }}</p>
                                    <span style="color: black">{{\Carbon\Carbon::parse($latestMessage->created_at)->diffForHumans()}}</span>
                                    </div><!--usr-mg-info end-->
                                </a>
                            </div><!--usr-msg-details end-->
                        </li>
                    @endforeach
                </ul>
            </div><!--messages-list end-->
        </div><!--msgs-list end-->
    </div>

