<?php

namespace App\Policies;

use App\Present;
use App\User;
use App\Wish;
use Illuminate\Auth\Access\HandlesAuthorization;
use TCG\Voyager\Policies\BasePolicy;

class PresentPolicy extends BasePolicy
{
    public function add(User $user, Present $present) {
        return $present->wish && in_array($present->wish->state, [Wish::STATE_OPEN])
            && $this->checkPermission($user, $present, 'add');
    }
}
