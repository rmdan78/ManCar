<?php

namespace App\Policies\Vehicle\Transaction;

use App\Models\User\User;
use App\Models\Vehicle\Transaction\Transaction;
use Illuminate\Auth\Access\Response;

class TransactionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Transaction $transaction = null): bool
    {
        return auth()->check();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->isAdministrator();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Transaction $transaction = null): bool
    {
        return $user->isAdministrator();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Transaction $transaction = null): bool
    {
        return $user->isAdministrator();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Transaction $transaction = null): bool
    {
        return $user->isAdministrator();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Transaction $transaction = null): bool
    {
        return $user->isSuperAdministrator();
    }

    /**
     * Determine whether the user can approve the model.
     */
    public function approve(User $user, Transaction $transaction = null): bool
    {
        return $user->isAdministrator();
    }

    /**
     * Determine whether the user can reject the model.
     */
    public function reject(User $user, Transaction $transaction = null): bool
    {
        return $user->isAdministrator();
    }

    /**
     * Determine whether the user can reject the model.
     */
    public function complete(User $user, Transaction $transaction = null): bool
    {
        return $user->isAdministrator();
    }
}
