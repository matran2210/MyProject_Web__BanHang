@foreach($binhluan as $cmt)
    <!-- Comment -->
    <input type="hidden" name="hidden_id_remove" id="hidden_id_remove" value="{{$cmt->id}}" />
    <div  class="media">
        <a class="pull-left">
            <img style="width: 50px;height: 50px;border-radius: 50%;" class="media-object" src="source/images/user/{{$cmt->user_comment->Avatar}}" alt="avatar">
        </a>

        <div class="media-body">
            <h4 class="media-heading">{{$cmt->user_comment->name}}
                <small>{{$cmt->created_at}}</small>
                @if(Auth::check())
                    @if(Auth::user()->id ==$cmt->user_comment->id)
                        <small>
                            <a data-toggle="modal" data-target="#confirmModal" id="remove_cmt" data-id="{{$cmt->id}}" class="remove_cmt glyphicon glyphicon-remove">


                            </a>

                        </small>



                    @endif

                @endif
            </h4>
            {{$cmt->noiDung}}
        </div>
    </div>




@endforeach


