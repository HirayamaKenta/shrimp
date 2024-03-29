<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
  /**
   * Display the registration view.
   *
   * @return \Illuminate\View\View
   */
  public function create()
  {
    return view('auth.register');
  }

  /**
   * Handle an incoming registration request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\RedirectResponse
   *
   * @throws \Illuminate\Validation\ValidationException
   */
  public function store(Request $request)
  {

    // ↓パスコード認証追加分
    if ($request->passcode !== "05110511") {
      return redirect()->back()->with("message", "passcodeは制作者に提示されたものを打ち込んでください。");
    }
        // ↑パスコード認証追加分

    // ↓バリデーション
    $request->validate([
      'name' => ['required', 'string', 'max:255'],
      'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
      'avatar' => ['image', 'max:1024'],
      'password' => ['required', 'confirmed', Rules\Password::defaults()],
    ]);
    // ↑バリデーション
    // ↓オリジナル
    // $user = User::create([
    //   'name' => $request->name,
    //   'email' => $request->email,
    //   'password' => Hash::make($request->password),
    // ]);
    // ↑オリジナル

    // ↓変更したやつ
    // userテーブルのデータ
    $attr = [
      'name' => $request->name,
      'email' => $request->email,
      'password' => Hash::make($request->password),
    ];

    //imagesの保存
    if (request()->hasFile('avatar')) {
      $name = request()->file('avatar')->getClientOriginalName();
      $avatar = date('Ymd_His') . '_' . $name;
      request()->file('avatar')->storeAs('public/images', $avatar);
      //imagesファイル名をデータに追加
      $attr['avatar'] = $avatar;
    }

    $user = User::create($attr);
    // ↑変更したやつ



    event(new Registered($user));

    //役割付与
    $user->roles()->attach(2);

    Auth::login($user);

    return redirect(RouteServiceProvider::HOME);
  }
}