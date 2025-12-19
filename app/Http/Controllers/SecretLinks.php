<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SecretLink;
use Illuminate\Support\Str;
use App\Mail\SecretLinkMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class SecretLinks extends Controller
{
    public function viewHomepage()
    {

        return view('home');
    }

    public function createSecretLink(Request $request)
    {
        $request->validate([
            'secret_text' => 'required',
            'expires_at' => 'required|in:1,3,7,15,30',
        ]);
        if ($request->filled('website')) {
            abort(403, 'Bot detected');
        }
        $slug = Str::random(16);
        $expiresAt = now()->addDays($request->expires_at);

        $link = SecretLink::create([
            'secret_text' => $request->secret_text,
            'slug' => $slug,
            'expires_at' => $expiresAt,
        ]);
        if ($link) {
            return redirect()->route('show-password', $slug);
        } else {
            return back()->with('error', 'Something went wrong while saving the link.');
        }
    }

    public function show($slug)
    {
        $link = SecretLink::where('slug', $slug)->firstOrFail();
 
        $daysLeft = Carbon::parse($link->expires_at)->diffInDays(now());
        if ($link->is_burned  || now()->greaterThan($link->expires_at)) { 
            // dd('eee');
           return view('return-page');
        } 
        if ($link->first_url == 0) {
            DB::table('secret_links')->where('id', $link->id)->update([
                'first_url' => 1,
            ]); 
            return view('show-password', compact('link', 'daysLeft'));
        } else { 
            return view('show-password', compact('link', 'daysLeft'));
             
        }
    }

    public function view($slug)
    {
        $link = SecretLink::where('slug', $slug)->first();

        if (now()->greaterThan($link->expires_at)) {

            return view('return-page');
        }

        if ($link->is_burned || $link->viewed_at) {
            return view('return-page');
        }

        return view('view-password', compact('link'));
    }

    public function showSecretCode($encodedId)
    {
        $slug = base64_decode($encodedId);
        $link = SecretLink::where('slug', $slug)->first();

        if (!$link || $link->is_burned) {
            return response()->json(['message' => 'Link expired or already used.'], 404);
        }

        $link->update([
            'viewed_at' => now(),
            'is_burned' => true,
        ]);

        return response()->json([
            'secret_text' => $link->secret_text
        ]);
    }

    public function sendSecret(Request $request, $slug)
    {
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
        ]);

        try {
            $secretLink = SecretLink::where('slug', $slug)->firstOrFail();

            Mail::to('enter@youmailhere.com')->send(new SecretLinkMail(
                $request->first_name,
                $request->last_name,
                route('view-password', $secretLink->slug)
            ));

            return response()->json(['message' => 'Email sent successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Email not sent. Please try again later.'], 500);
        }
    }

    public function burnLink($encodedId)
    {
        $id = base64_decode($encodedId);

        $data = DB::table('secret_links')->where('id', '=', $id)->update(['is_burned' => '1']);

        if ($data) {
            return redirect()
                ->route('home')
                ->with('error', 'Your one-time link has been burnt.');
        }
    }
}
