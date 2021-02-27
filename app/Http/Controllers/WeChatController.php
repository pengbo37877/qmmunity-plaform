<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WeChatController extends Controller
{
    public function serve()
    {
        Log::info('wechat request arrived.');

        $app = app('wechat.mini_program');
        $app->server->push(function ($message) {
            return "欢迎来到 qmmunity";
        });

        return $app->server->serve();
    }

    /**
     * 登录
     * 通过微信wx.login提供的code完成用户在本系统的登录
     * 同时可以获取用户的session_key为后续获取更多用户信息做准备
     * 返回的access_token是用户在本系统的唯一凭证
     */
    public function accessToken()
    {
        $code = request()->get('code');
        $app = app('wechat.mini_program');
        $arr = $app->auth->session($code);

        if ($arr['errcode'] != 0) {
            Log::error($arr['errmsg']);
            abort(500, $arr['errmsg']);
        }

        $openId = $arr['openid'];
        $profile = UserProfile::where('open_id', $openId)->first();
        if ($profile) {
            $profile->session_key = $arr['session_key'];
            $profile->save();
            // 已经存在用户
            $user = User::find($profile->user_id);
            // 删除之前的token
            $user->tokens()->delete();
            // 创建新的token
            $token = $user->createToken('wechat-token');
            return $token->plainTextToken;
        }
        // 创建用户
        $user = new User;
        $user->save();

        // 创建UserProfile
        $profile = new UserProfile;
        $profile->open_id = $arr['openid'];
        $profile->session_key = $arr['session_key'];
        $profile->union_id = empty($arr['unionid']) ?? $arr['unionid'];
        $profile->save();

        // 创建新的token
        $token = $user->createToken('wechat-token');
        return $token->plainTextToken;
    }

    /**
     * 更新用户的微信信息
     * 微信前端调用wx.getUserInfo后访问该接口
     *（非加密信息）
     */
    public function updateUserInfo()
    {
    }

    /**
     * 更新用户的手机号
     * 微信前端给出encryptedData和iv在服务器端获取加密信息
     *（加密信息）
     */
    public function updateUserPhone()
    {
    }
}
