<?php

namespace App\Http\Controllers\Auth;

use Exception;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
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
                    'github_token' => $githubUser->token
                ]);

                Profile::query()->updateOrCreate([
                    'user_id' => $this->user->id,
                ], [
                    'provider' => self::NAME,
                    'auth_id' => $githubUser->id,
                    'nickname' => $githubUser->nickname,
                    'avatar' => $githubUser->avatar,
                    'data' => json_encode($githubUser->user),
                ]);
            }, 3);

            if (is_null($this->user->interest)) {
                return redirect()->route('');
            }

            if (is_null($this->user->preference)) {
                return redirect()->route('');
            }

            return redirect()->route('');
        } catch (Exception $exception) {
            DB::rollback();
            dd($exception->getMessage());
        }
    }
}
