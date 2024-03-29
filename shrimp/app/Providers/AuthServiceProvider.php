<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
  /**
   * The model to policy mappings for the application.
   *
   * @var array<class-string, class-string>
   */
  protected $policies = [
    // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    App\Models\Post::class => App\Policies\PostPolicy::class,
    App\Models\User::class => App\Policies\UserPolicy::class,
  ];

  /**
   * Register any authentication / authorization services.
   *
   * @return void
   */
  public function boot()
  {
    $this->registerPolicies();

    // ↓管理者限定Gate
    Gate::define("admin",function($user){
foreach ($user->roles as $role) {
  if($role->name=="admin"){
return true;
  }
}
return false;
    });
    // ↑管理者限定Gate

// ↓登録者限定Gate
    Gate::define("user", function ($user) {
      foreach ($user->roles as $role) {
        if ($role->name == "admin" || $role->name == "user") {
          return true;
        }
      }
      return false;
    });
// ↑登録者限定Gate


  }
}