<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
  use HandlesAuthorization;

  /**
   * Determine whether the user can view any models.
   *
   * @param  \App\Models\User  $user
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function viewAny(User $user)
  {
    //
  }

  /**
   * Determine whether the user can view the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\User  $model
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function view(User $user, User $model)
  {
    //
  }

  /**
   * Determine whether the user can create models.
   *
   * @param  \App\Models\User  $user
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function create(User $user)
  {
    //
  }

  /**
   * Determine whether the user can update the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\User  $model
   * @return \Illuminate\Auth\Access\Response|bool
   */



  public function update(User $user, User $model)
  {
    // ↓本人はプロフィール編集画面閲覧可&編集可
    if ($user->id == $model->id) {
      return true;
    }
    // ↑本人はプロフィール編集画面閲覧可&編集可

    // ↓管理者はプロフィール編集画面閲覧可
    foreach ($user->roles as $role) {
      if ($role->name == "admin") {
        return true;
      }
    }
    // ↑管理者はプロフィール編集画面閲覧可

    return false;
  }

  /**
   * Determine whether the user can delete the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\User  $model
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function delete(User $user, User $model)
  {
    //
  }

  /**
   * Determine whether the user can restore the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\User  $model
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function restore(User $user, User $model)
  {
    //
  }

  /**
   * Determine whether the user can permanently delete the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\User  $model
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function forceDelete(User $user, User $model)
  {
    //
  }
}