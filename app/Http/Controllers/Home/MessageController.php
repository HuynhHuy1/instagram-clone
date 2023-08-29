<?php

namespace App\Http\Controllers\Home;

use App\Service\MessageService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class MessageController extends Controller
{
    public $messageServices;
    public function __construct(MessageService $messageServices)
    {
        $this->messageServices = $messageServices;
    }
    public function index(): View
    {
        try {
            $userLoginId = Auth::user()->id;
            $listUser = $this->messageServices->getUserChat($userLoginId);
            return view('home.chat')->with('listUser', $listUser);
        } catch (Exception $e) {
            Log::error($e);
            dd($e);
        }
    }
    public function create(Request $request): JsonResponse
    {
        try {
            $result = $this->messageServices->insertMessage($request);
            if ($result) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Them thanh cong'
                ]);
            } else {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Them that bai'
                ]);
            }
        } catch (Exception $e) {
            Log::error($e);
            return response()->json([
                'status' => 'failed',
                'message' => $e
            ]);
        }
    }

    public function chatDetail(int $receiverId)
    {
        try {
            $sender = Auth::user()->id;
            $listMessage = $this->messageServices->getChatDetail($sender, $receiverId);
            return response()->json([
                'status' => 'success',
                'message' => 'Lấy danh sách thành công',
                'data' => $listMessage
            ]);
        } catch (Exception $e) {
            Log::error($e);
            return response()->json([
                'status' => 'failed',
                'message' => $e
            ]);
        }
    }
}
