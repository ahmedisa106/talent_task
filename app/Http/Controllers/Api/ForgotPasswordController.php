<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Repositories\UserRepo;
use App\Helpers\Traits\NotificationTrait;
use App\Helpers\Traits\ResetTokenTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;

class ForgotPasswordController extends Controller
{
    use ResetTokenTrait, NotificationTrait;

    /**
     * @param ForgotPasswordRequest $request
     * @return JsonResponse
     */
    public function forgotPassword(ForgotPasswordRequest $request): JsonResponse
    {
        $user = (new UserRepo())->find('email', $request->email);
        $this->checkIfUserHasResetToken($request->email);
        $token = $this->generateResetToken();
        $this->insertNewRecord($request->email, $token);

        try {
            $this->sendNotificationToUser($user, $token);
        } catch (\Exception $exception) {
            return final_response(status: $exception->getCode(), message: $exception->getMessage());
        }
        return final_response(message: __('custom.check_email'));

    }// end of forgotPassword function

    /**
     * @param ResetPasswordRequest $request
     * @return JsonResponse
     */
    public function resetPassword(ResetPasswordRequest $request): JsonResponse
    {
        $user_email = $this->find('token',$request->token)->first()->email;
        $user = (new UserRepo())->find('email', $user_email);
        $user->update([
            'password' => bcrypt($request->password)
        ]);
        $user = UserResource::make($user);
        $this->deleteRow('token', $request->token);
        return final_response(message: __('mail.reset_successfully'), data: $user);

    }// end of resetPassword function


}
