<?php

namespace App\Service;

use App\Repository\LikeRepository;
use App\Repository\MessageRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MessageService
{
    protected $messageRepository;
    public function __construct(MessageRepository $messageRepository)
    {
        $this->messageRepository = $messageRepository;
    }

    public function insertMessage(Request $request): bool
    {
        DB::beginTransaction();
        try {
            $user_send = $request->input('sender_id');
            $user_reciver = $request->input('receiver_id');
            $message = $request->input('message');
            $result = $this->messageRepository->insertMessage($message, $user_send, $user_reciver);
            DB::commit();
            return $result;
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function getUserChat(int $userLoginId): array
    {
        try {
            $listUser = $this->messageRepository->getUserChat($userLoginId);
            return $listUser;
        } catch (\Throwable $e) {
            Log::error($e);
            throw $e;
        }
    }

    public function getChatDetail(int $senderId,int $receiverId): array
    {
        try {
            $listMessage = $this->messageRepository->getChatDetail($receiverId,$senderId);
            return $listMessage;
        } catch (\Throwable $e) {
            Log::error($e);
            throw $e;
        }
    }
}
