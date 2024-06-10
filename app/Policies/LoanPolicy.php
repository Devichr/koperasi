<?php

namespace App\Policies;

use App\Models\Loan;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class LoanPolicy
{
    use HandlesAuthorization;


    public function view(User $user, Loan $loan)
    {
        return $user->id === $loan->memberId || $user->role === 'bendahara' || $user->role === 'ketua';
    }


}
