<?php

namespace App\Notifications;

use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class IdeaStatusUpdated extends Notification
{
    use Queueable;

    public $comment;
    

    

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Comment $comment)
    {

        $this->comment = $comment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject(__('global.Vote! An administrator updated your idea'))
            ->markdown('emails.idea-status-updated', [
                'comment' => $this->comment,
            ] );
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'comment_id' => $this->comment->id,
            'comment_body' => $this->comment->body,
            'user_avatar' => $this->comment->user->getAvatar(),
            'user_name' => $this->comment->user->name,
            'idea_id' => $this->comment->idea->id,
            'idea_status' => $this->comment->idea->status->name,
            'idea_status_fr' => $this->comment->idea->status->name_fr,
            'idea_slug' => $this->comment->idea->slug,
            'idea_title' => $this->comment->idea->title,
        ];
    }
}