
@if(isset($token))
    <div class="btn-group" role="group" aria-label="Basic example">
         <a href="{{ route('posts.show', [$post->id]) }}" title="View Post Details" data-id="{{ $post->id }}" target="_blank">
            {{$post->topic}}
        </a>
    </div>
@else
    @if(isset($post))
        @if(!$post->trashed())
        <div class="btn-group" role="group" aria-label="Basic example">
        <a href="{{ route('posts.edit', [$post->id]) }}" title="Edit Post"><i class="icon-pencil5 mr-1 icon-1x"></i></a>
        <a data-toggle="modal" data-target="#exampleModal" style="cursor: pointer;" title="Suspend Post" class="delete-row delete-color" data-id="{{ $post->id }}"><i class="icon-bin mr-1 icon-1x" style="color:red;"></i></a>
            <p class="d-none">{!!$post->id!!}</p>
        <a href="{{ route('posts.show', [$post->id]) }}" title="View Post Details" class="delete-row delete-color" data-id="{{ $post->id }}">
            <i class="fa fa-eye text-info" aria-hidden="true"></i>
        </a>
        </div>
        @else
        <div class="btn-group" role="group" aria-label="Basic example">
            <a href="javascript:restore('posts/restore/{{$post->id}}')" title="Restore Post" class="restore-row restore-color" data-id="{{ $post->id }}"><i
                    class="icon-loop3"></i></a>
            <a href="javascript:permanent('posts/deletePermanently/{{$post->id}}')" title="Delete Permanently" class="delete-permanently-row delete-color" data-id="{{ $post->id }}"><i
                    class="icon-cancel-square2" style="color: red;"></i></a>
         </div>
         
        @endif
    @endif
@endif

<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Alert!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a  href="" class="btn btn-danger confirm">Confirm</a>
      </div>
    </div>
  </div>
</div>