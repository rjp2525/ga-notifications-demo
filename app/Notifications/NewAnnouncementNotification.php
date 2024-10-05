<?php

namespace App\Notifications;

use App\Models\Announcement;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;

class NewAnnouncementNotification extends Notification
{
    public function __construct(
        public Announcement $announcement
    ) {}

    public function via(object $notifiable): array
    {
        return ['database', 'broadcast'];
    }

    public function broadcastType(): string
    {
        return 'broadcast.message';
    }

    public function toBroadcast(object $notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'title' => $this->announcement->title,
            'posted' => $this->announcement->created_at,
            'author_name' => $this->announcement->author->name,
        ]);
    }

    public function toArray(object $notifiable): array
    {
        return [
            'announcement_id' => $this->announcement->id,
            'title' => $this->announcement->title,
            'slug' => $this->announcement->slug,
            'posted' => $this->announcement->created_at,
            'author_name' => $this->announcement->author->name,
        ];
    }
}
