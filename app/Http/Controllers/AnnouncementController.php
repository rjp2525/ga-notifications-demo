<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\LaravelMarkdown\MarkdownRenderer;

class AnnouncementController extends Controller
{
    public function __invoke(Announcement $announcement, Request $request)
    {
        // Mark this notification read for the current user
        $request->user()
            ->unreadNotifications()
            ->where('data->announcement_id', $announcement->id)
            ->update(['read_at' => now()]);

        // Mark the announcement viewed by the current user
        $request->user()->viewedAnnouncements()->syncWithoutDetaching([
            $announcement->id => ['viewed_at' => now()],
        ]);

        return Inertia::render('Announcement', [
            'announcement' => [
                'title' => $announcement->title,
                'author' => $announcement->author->name,
                'posted' => $announcement->created_at->format('l, M j, Y'),
                'body' => app(MarkdownRenderer::class)->toHtml($announcement->body),
            ],
        ]);
    }
}
