<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $operator
     *
     * @return bool
     */
    public function create(User $operator): bool
    {
        return $operator->authority_type->isAdministrator();
    }

    /**
     * @param User $operator
     * @param User $user
     *
     * @return bool
     */
    public function view(User $operator, User $user): bool
    {
        return $this->isUserInSameCompanyAsOperator($operator, $user);
    }

    /**
     * @param User $operator
     * @param User $user
     *
     * @return bool
     */
    public function update(User $operator, User $user): bool
    {
        return $this->canUpdateByThemselves($operator, $user)
            || $this->canUpdateByAdministrator($operator, $user);
    }

    /**
     * @param User $operator
     * @param User $user
     *
     * @return bool
     */
    public function delete(User $operator, User $user): bool
    {
        return $this->update($operator, $user);
    }

    /**
     * @param User $operator
     * @param User $user
     *
     * @return bool
     */
    private function canUpdateByThemselves(User $operator, User $user): bool
    {
        return $operator->id === $user->id;
    }

    /**
     * @param User $operator
     * @param User $user
     *
     * @return bool
     */
    private function canUpdateByAdministrator(User $operator, User $user): bool
    {
        return $operator->authority_type->isAdministrator()
            && $this->isUserInSameCompanyAsOperator($operator, $user);
    }

    /**
     * @param User $operator
     * @param User $user
     *
     * @return bool
     */
    private function isUserInSameCompanyAsOperator(User $operator, User $user): bool
    {
        if (!$operator->funeralCompany || !$user->funeralCompany) {
            return false;
        }

        return $operator->funeralCompany->id === $user->funeralCompany->id;
    }
}
