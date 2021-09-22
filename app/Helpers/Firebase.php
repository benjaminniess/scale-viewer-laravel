<?php
namespace App\Helpers;

use App\Models\User;

class Firebase
{
    /**
     * The static method to generate a user from a provider slug and a auth token coming from the provider
     *
     * @param $provider
     * @param $auth_token
     *
     * @return \App\Models\User
     */
    public static function maybe_create_user($provider, $auth_token)
    {
        return app(Firebase::class)->_maybe_create_user($provider, $auth_token);
    }

    public static function get_auth()
    {
        return app('firebase.auth');
    }

    /**
     * The singleton mirror method for maybe_create_user
     *
     * @param $provider
     * @param $auth_token
     *
     * @return mixed
     */
    public function _maybe_create_user($provider, $auth_token)
    {
        $auth = \App\Helpers\Firebase::get_auth();

        $signInResult = $auth->signInWithIdpAccessToken($provider, $auth_token);
        $user_data = $signInResult->data();

        $existing_user = \App\Models\User::where(
            'email',
            $user_data['email']
        )->first();
        if (empty($existing_user)) {
            $user = new User();
            $user->name =
                $user_data['firstName'] . ' ' . $user_data['lastName'];
            $user->email = $user_data['email'];
            $user->password = '';
            $user->save();
        }

        $existing_user = \App\Models\User::where(
            'email',
            $user_data['email']
        )->first();
        $existing_user->name =
            $user_data['firstName'] . ' ' . $user_data['lastName'];
        $existing_user->save();

        return $existing_user;
    }
}
