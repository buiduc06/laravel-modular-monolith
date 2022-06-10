<?php

namespace Laracon\Order\Application\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Laracon\Order\Domain\Models\Order;
use UI\Admin\Models\User;

class OrderPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Order $order)
    {
        return $user->id === $order->user_id;
    }
}
