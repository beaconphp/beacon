<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

final class CreateBaseAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:admin-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Makes base admin user';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        User::query()
            ->create([
                'name' => 'Admin',
                'email' => 'admin@beacon.com',
                'password' => bcrypt('admin'),
                'is_global_admin' => true,
            ]);
    }
}
