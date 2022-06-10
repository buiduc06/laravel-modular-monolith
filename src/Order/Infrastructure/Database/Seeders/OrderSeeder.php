<?php

declare(strict_types=1);

namespace Laracon\Order\Infrastructure\Database\Seeders;

use Illuminate\Database\Seeder;
use Laracon\Order\Domain\Models\Order;
use UI\Admin\Models\User;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory()->create();

        Order::factory(10)->for($user)->create();
    }
}
