<?php

namespace App\Policies;

use App\User;
use App\Wish;
use Illuminate\Auth\Access\HandlesAuthorization;
use TCG\Voyager\Policies\BasePolicy;

class WishPolicy extends BasePolicy
{

    public function edit(User $user, Wish $wish)
    {
        return $user->id == $wish->created_from_user_id || $this->checkPermission($user, $wish, 'edit');
    }

    public function unpublish(User $user, Wish $wish)
    {
        return in_array($wish->state, [ Wish::STATE_OPEN ])
                && ($user->id == $wish->created_from_user_id || $this->checkPermission($user, $wish, 'unpublish'));
    }

    public function publish(User $user, Wish $wish)
    {
        return in_array($wish->state, [ Wish::STATE_UNPUBLISHED ])
            && ($user->id == $wish->created_from_user_id || $this->checkPermission($user, $wish, 'publish'));
    }
}
