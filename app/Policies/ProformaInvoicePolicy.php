<?php

namespace App\Policies;

use App\Models\ProformaInvoice;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProformaInvoicePolicy
{

    public function view(User $user): bool
    {
        return $user->role->permissions->contains('permission_name', 'view-proforma-invoice');
    }

    public function create(User $user): bool
    {
        return $user->role->permissions->contains('permission_name', 'create-proforma-invoice');
    }

    public function update(User $user, ProformaInvoice $proformaInvoice): bool
    {
        return $user->role->permissions->contains('permission_name', 'update-proforma-invoice');
    }

    public function delete(User $user, ProformaInvoice $proformaInvoice): bool
    {
        return false;
    }

}
