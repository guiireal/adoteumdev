<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Profile;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    const NAME = 'GOOGLE';

    protected User $user;

    public function __invoke(): RedirectResponse
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            DB::transaction(function () use ($googleUser) {
                $this->user = User::query()->updateOrCreate([
                    'email' => $googleUser->email,
                ], [
                    'name' => $googleUser->name,
                    'password' => Hash::make(Str::random(7)),
                ])->load('interest', 'preference');

                Profile::query()->updateOrCreate([
                    'user_id' => $this->user->id,
                ], [
                    'provider' => self::NAME,
                    'provider_user_id' => $googleUser->id,
                    'nickname' => $googleUser->nickname,
                    'avatar' => $googleUser->avatar,
                    'data' => json_encode($googleUser->user),
                ]);
            }, 3);

            Auth::login($this->user);

            if (is_null($this->user->interest)) {
                return redirect()->route('app.interests');
            }

            if (is_null($this->user->preference)) {
                return redirect()->route('app.preferences');
            }

            return redirect()->route('app.developers');
        } catch (Exception $exception) {
            DB::rollback();
            dd($exception->getMessage());
        }
    }
}
