<?php

namespace App\Observers;

use App\Models\Announcement;
use App\Models\User;
use App\Notifications\NewAnnouncementNotification;
use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

class AnnouncementObserver implements ShouldHandleEventsAfterCommit
{
    // Set the slug attribute when creating a new announcement
    public function creating(Announcement $announcement): void
    {
        if (! $announcement->slug) {
            $announcement->slug = Str::slug($announcement->title);
        }
    }

    // Send a notification to users when a new announcement is posted
    public function created(Announcement $announcement): void
    {
        Notification::send(User::all(), new NewAnnouncementNotification($announcement));
    }
}
