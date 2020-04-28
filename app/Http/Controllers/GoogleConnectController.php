<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Kreait\Firebase\Value\Provider;
use Auth;

class GoogleConnectController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        if ( ! $request->ajax() ) {
            abort( 'Only for ajax use' );
        }

        $this->validate($request, [
            'accessToken' => 'required|string',
        ]);

        $user = \App\Helpers\Firebase::maybe_create_user(Provider::GOOGLE, $request->accessToken);

        Auth::loginUsingId($user->id, true);
    }
}
