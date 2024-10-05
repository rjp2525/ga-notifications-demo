<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAnnouncementRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class CreateAnnouncementController extends Controller
{
    public function create(Request $reqest): Response
    {
        return Inertia::render('NewAnnouncement');
    }

    public function store(CreateAnnouncementRequest $request)
    {
        $announcement = $request->user()
            ->announcements()
            ->create($request->validated());

        return redirect()->route('announcement.view', ['announcement' => $announcement]);
    }
}
