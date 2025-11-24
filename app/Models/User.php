<?php

declare(strict_types=1);

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\UserRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

final class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_global_admin' => 'boolean',
    ];

    /** @return BelongsToMany<Workspace, $this> */
    public function workspaces(): BelongsToMany
    {
        return $this->belongsToMany(Workspace::class);
    }

    /** @return HasMany<Workspace, $this> */
    public function ownedWorkspaces(): HasMany
    {
        return $this->hasMany(Workspace::class, 'author_id');
    }

    /** @return BelongsToMany<Workspace, $this> */
    public function adminWorkspaces(): BelongsToMany
    {
        return $this->workspaces()->wherePivotIn('role', [
            UserRole::OWNER->value,
            UserRole::ADMIN->value,
        ]);
    }

    /** @return BelongsTo<Workspace, $this> */
    public function currentWorkspace(): BelongsTo
    {
        return $this->belongsTo(Workspace::class);
    }

    public function isCurrentWorkspace(Workspace $workspace): bool
    {
        return $workspace->id === $this->currentWorkspace?->id;
    }

    public function belongsToWorkspace(Workspace $workspace)
    {
        return $this->workspaces->contains(fn ($t): bool => $t->id === $workspace->id);
    }

    /** @return HasMany<Ticket, $this> */
    public function createdTickets(): HasMany
    {
        return $this->hasMany(Ticket::class, 'author_id');
    }

    /** @return HasMany<Ticket, $this> */
    public function assignedTickets(): HasMany
    {
        return $this->hasMany(Ticket::class, 'assigned_to');
    }

    public function currentWorkspaceRole(): ?UserRole
    {
        if (! $this->currentWorkspace) {
            return null;
        }

        $role = $this->currentWorkspace
            ->users()
            ->where('id', $this->id)
            ->first()
            ->membership
            ->role;

        return UserRole::tryFrom($role);
    }

    public function canAccessDashboard(): bool
    {
        if (! $this->currentWorkspace) {
            return true;
        }

        $role = $this->currentWorkspace
            ->users()
            ->where('id', $this->id)
            ->first()
            ->membership
            ->role;

        return in_array($role, [
            UserRole::OWNER->value,
            UserRole::ADMIN->value,
        ]);
    }
}
