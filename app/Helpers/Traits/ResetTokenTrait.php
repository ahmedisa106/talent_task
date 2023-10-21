<?php

namespace App\Helpers\Traits;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

trait ResetTokenTrait
{

    /**
     * @param $column
     * @param $value
     * @return object|null
     */
    public function find($column, $value): object|null
    {
        return DB::table('password_reset_tokens')->where($column, $value);
    }// end of findRow function

    /**
     * @param $column
     * @param $value
     * @return void
     */
    public function deleteRow($column, $value): void
    {

        $this->find($column, $value)->delete();
    }// end of findRow function

    /**
     * @param $email
     * @return void
     */
    public function checkIfUserHasResetToken($email): void
    {
        $user_token = $this->find('email', $email);
        if ($user_token != null) {
            $this->deleteRow('email', $email);
        }
    }// end of checkIfUserHasResetToken function

    /**
     * @return string
     */
    public function generateResetToken(): string
    {
        return Str::random(40);
    }// end of generateResetToken function

    /**
     * @param $email
     * @param $token
     * @return void
     */
    public function insertNewRecord($email, $token): void
    {
        DB::table('password_reset_tokens')->insert([
            'email' => $email,
            'token' => $token,
            'created_at' => now()
        ]);
    }// end of insertNewRecord function

}
