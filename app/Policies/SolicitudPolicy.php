<?php

namespace App\Policies;

use App\Models\SolicitudTipo;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SolicitudPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, SolicitudTipo $solicitudTipo): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, SolicitudTipo $solicitudTipo): bool
    {
        // Verificar si el usuario es administrador
        if ($user->hasRole('administrador')) {
            return true; // Permitir la actualización para los administradores
        }

        // Si no es administrador, verificar si el usuario es el propietario de la solicitud tipo
        return $user->id === $solicitudTipo->user_id;
    }


    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, SolicitudTipo $solicitudTipo): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, SolicitudTipo $solicitudTipo): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, SolicitudTipo $solicitudTipo): bool
    {
        //
    }
}
