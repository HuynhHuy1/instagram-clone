<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Service\ProfileService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class ProfileController extends Controller
{
    protected $profileService;
    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    public function index(int $userId): View
    {
        $profile = $this->profileService->getByID($userId);
        return view('home.profile', [
            'profile' => $profile
        ]);
    }

    public function showFormUpdatePassword()
    {
        return view('home.edit-password', [
            'version' => Auth::user()->version
        ]);
    }
    public function showFormUpdateProfile()
    {
        return view('home.edit-profile', [
            'user' => Auth::user(),
            'version' => Auth::user()->version
        ]);
    }
    public function search(string $userName): JsonResponse
    {
        try {
            if ($userName != "") {
                $users = $this->profileService->search($userName);
                return response()->json([
                    'status' => 'success',
                    'data' => $users,
                    'message' => 'Lấy thành công danh sách'
                ]);
            } else {
                return response()->json([
                    'status' => 'failed',
                    'data' => null,
                    'message' => 'Lấy danh sách thất bại'
                ]);
            }
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json([
                'status' => 'failed',
                'data' => null,
                'message' => 'Lấy danh sách thất bại'
            ]);
        }
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        $userId = Auth::user()->id;
        $request->validate(
            [
                'password' => 'required|min:8',
                'old_password' => 'required|min:8',
            ]
        );
        try {
            $result = $this->profileService->updateByID($userId, $request);
            if ($result) {
                return redirect()->route('home')
                    ->with('success', 'Cập nhật thông tin thành công');
            } else {
                return back()->withInput()->with('error', ' Mập khẩu không hợp lệ');
            }
        } catch (\Exception $e) {
            Log::error($e);
            return back()->withInput()->with('error', $e->getMessage());
        }
    }
    public function updateProfile(Request $request) : RedirectResponse
    {
        $userId = Auth::user()->id;
        dd($request->all());
        $request->validate(
            [
                'password' => 'required|min:8',
                'old_password' => 'required|min:8',
            ]
        );
        try {
            $result = $this->profileService->updateByID($userId, $request);
            if ($result) {
                return redirect()->route('home')
                    ->with('success', 'Cập nhật thông tin thành công');
            } else {
                return back()->withInput()->with('error', ' Mập khẩu không hợp lệ');
            }
        } catch (\Exception $e) {
            Log::error($e);
            return back()->withInput()->with('error', $e->getMessage());
        }
    }
}
