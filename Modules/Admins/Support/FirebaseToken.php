<?php

namespace Modules\Admins\Support;

use Firebase\Auth\Token\Verifier;
use Illuminate\Support\Facades\Config;
use Illuminate\Auth\AuthenticationException;

class FirebaseToken
{
    /**
     * Get the valid phone number from access token.
     *
     * @param string $accessToken
     * @throws AuthenticationException
     * @return string
     */
    public function getPhoneNumber($accessToken)
    {
        $projectId = Config::get('admins.firebase_project_id');

        $verifier = new Verifier($projectId);
        try {
            $verifiedIdToken = $verifier->verifyIdToken($accessToken);

            return $verifiedIdToken->getClaim('phone_number');
        } catch (\Throwable $e) {
            throw new AuthenticationException('Invalid access token!');
        }
    }
}
