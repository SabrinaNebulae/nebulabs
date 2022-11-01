<div>
    @if ($comments ->isNotEmpty())
        <div class="comments-container relative space-y-6 pt-4 md:ml-22 my-8 mt-1">

            @foreach ($comments as $comment)
                <livewire:idea-comment 
                    :key="$comment->id"
                    :comment="$comment"
                    :ideaUserId="$idea->user->id"
                />
            @endforeach
        </div><!-- End comments container -->

        <div class="my-8 md:ml-22">
            {{  $comments->links() }}
        </div>
    @else
        <div class="text-center text-gray-400 font-normal text-xl mt-5">{{ __('global.No comments yet for this idea...') }}</div>  
    @endif
</div>
