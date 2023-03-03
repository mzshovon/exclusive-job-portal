<?php

namespace App\Http\Services;

use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

class ApiUserAuthorizationService
{
    public function __construct(private User $user)
    {
    }

    /**
     * @param string $mobile_number
     * @param string $otp
     *
     * @return [type]
     */
    public function checkUserAvailablity($mobile_number, $otp)
    {
        $check = $this->checkUserExists($mobile_number);
        if (!$check) {
            return Response::HTTP_UNAUTHORIZED;
        }
        $send_otp =
    }

    /**
     * @param string $mobile_number
     * @param string $otp
     *
     * @return [type]
     */
    public function authorizeUser($mobile_number, $otp)
    {
        $check = $this->checkUserExists($mobile_number);
        if (!$check) {
            return Response::HTTP_UNAUTHORIZED;
        }
        // $authenticate
    }

    private function checkUserExistsAndSendOtp($mobile_number)
    {
        $check_user = $this->user->whereMobile($mobile_number);
        if ($check_user->count() == 1) {
            return $this->sendOtp($check_user);
        }
        $insert_user = $this->user->create(['mobile' => $mobile_number]);
        if ($insert_user) {
            return $this->sendOtp($check_user);
        }
        return false;
    }

    private function authenticateUser($mobile_number, $password)
    {
    }

    private function sendOtp($user)
    {
        $otp = rand(12110,9991);
        return $user->update(['otp'=>$otp]);
    }
}
