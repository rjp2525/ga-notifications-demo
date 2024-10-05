<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function __invoke(Request $request): Response
    {
        // Get the unread notification announcement IDs
        $announcementIds = $request->user()
            ->unreadNotifications
            ->pluck('data.announcement_id');

        // Retrieve the viewed announcements from the pivot
        $viewedAnnouncementIds = $request->user()
            ->viewedAnnouncements()
            ->pluck('announcement_id')
            ->toArray();

        return Inertia::render('Dashboard', [
            'unread_announcements' => fn () => Announcement::whereIn('id', $announcementIds)
                ->orderBy('created_at', 'DESC')
                ->paginate(3, ['*'], 'new_page')
                ->through(fn (Announcement $announcement) => [
                    'id' => $announcement->id,
                    'slug' => $announcement->slug,
                    'title' => $announcement->title,
                    'posted' => $announcement->created_at,
                    'author' => $announcement->author->name,
                ]),
            'past_announcements' => fn () => Announcement::whereNotIn('id', $announcementIds)
                ->orderBy('created_at', 'DESC')
                ->paginate(3, ['*'], 'past_page')
                ->through(fn (Announcement $announcement) => [
                    'id' => $announcement->id,
                    'slug' => $announcement->slug,
                    'title' => $announcement->title,
                    'posted' => $announcement->created_at,
                    'author' => $announcement->author->name,
                    'viewed' => in_array($announcement->id, $viewedAnnouncementIds),
                ]),
        ]);
    }
}
