<?php

namespace App\Http\Controllers\Passport;

use App\Models\ThirdPartyUser;
use Illuminate\Http\Request;
use Nyholm\Psr7\Response as Psr7Response;
use \Laravel\Passport\Http\Controllers\ApproveAuthorizationController as PassportApproveAuthorizationController;

class ApproveAuthorizationController extends PassportApproveAuthorizationController
{
    /**
     * Approve the authorization request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function approve(Request $request)
    {
        $this->assertValidAuthToken($request);
        if ($request->user()) {
            $authRequest = $this->getAuthRequestFromSession($request);
        } else {
            $user = ThirdPartyUser::findOrFail($request->get('user_id'));
            $request->setUserResolver(function () use ($user) {
                return $user;
            });
            $authRequest = $this->getAuthRequestFromSession($request);
        }


        return $this->convertResponse(
            $this->server->completeAuthorizationRequest($authRequest, new Psr7Response)
        );
    }
}
