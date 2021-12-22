<?php

namespace App\Listeners;

use App\Mail\WelcomeMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
Use Illuminate\Support\Facades\Mail;

class UserRegisteredListener
{


    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $user = $event->user;

        $pass = str_replace(' ', '', $event->name);
        $obj = User::create([
            'name' => $event->name,
            'email' => $event->email,
            'role' => 'teacher',
            'password' => Hash::make($pass),

        ]);
        $user->update([
            'user_id' => $obj->id,
        ]);

        // Mail::to($event->user)->send(new WelcomeMail($event));

        return redirect('admin/teacher/index')->with([
            'message'=> 'Teacher Created',
            'classes'=> 'green rounded'
        ]);

    }
}
