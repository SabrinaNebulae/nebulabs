<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use App\Models\Comment;
use Livewire\Component;
use App\Jobs\NotifyAllVoters;
use Illuminate\Http\Response;
use App\Notifications\IdeaStatusUpdated;

class SetStatus extends Component
{
    public $idea;
    public $status;
    public $comment;
    public $notifyAllVoters;

    public function mount(Idea $idea)
    {
        $this->idea = $idea;
        $this->status = $this->idea->status_id;
    }

    public function setStatus()
    {
        if (! auth()->check() || ! auth()->user()->isAdmin()) {
            abort(Response::HTTP_FORBIDDEN);
        }

        if ($this->idea->status_id === (int) $this->status) {
            $this->emit('statusWasUpdatedError', __('global.Status is the same!'));

            return;
        }
        
        $this->idea->status_id = $this->status;
        $this->idea->save();

        if ($this->notifyAllVoters){
            NotifyAllVoters::dispatch($this->idea);
        }

        

        $newComment = Comment::create([
            'user_id' => auth()->id(),
            'idea_id' => $this->idea->id,
            'status_id' => $this->status,
            'body' => $this->comment ? $this->comment : __('global.An administator changed this idea status.'),
            'is_status_update' => true,
        ]);

        $this->reset(('comment'));

        $this->idea->user->notify(new IdeaStatusUpdated($newComment));

        $this->emit('statusWasUpdated', __('global.Status was updated successfully!'));
    }

    public function render()
    {
        return view('livewire.set-status');
    }

}
