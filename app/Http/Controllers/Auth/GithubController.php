<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GithubController extends Controller
{
    const NAME = 'GITHUB';

    protected User $user;

    public function __invoke(): RedirectResponse
    {
        try {
            $githubUser = Socialite::driver('github')->user();
            DB::transaction(function () use ($githubUser) {
                $this->user = User::query()->updateOrCreate([
                    'email' => $githubUser->email,
                ], [
                    'name' => $githubUser->name,
                    'password' => Hash::make(Str::random(7)),
                ])->load('interest', 'preference');

                Profile::query()->updateOrCreate([
                    'user_id' => $this->user->id,
                ], [
                    'provider' => self::NAME,
                    'provider_user_id' => $githubUser->id,
                    'nickname' => $githubUser->nickname,
                    'avatar' => $githubUser->avatar,
                    'data' => json_encode($githubUser->user),
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
