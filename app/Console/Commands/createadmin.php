<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class createadmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this will create admin account ';



    public function handle()
    {
        if(!User::where(['email' => 'admin@gmail.com'])->first()){
            User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('admin')
            ]);
            $this->info("Admin account created successfullly!");
        }else{
            $this->error("Already Exist!");
        }
    }
}
