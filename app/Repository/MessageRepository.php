<?php

namespace App\Repository;

use App\Models\Follow;
use App\Models\Messages;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MessageRepository
{
    public function insertMessage(string $message, int $userSend, int $userReciver): bool
    {
        DB::beginTransaction();
        try {
            $result = Messages::create(
                [
                    'message' => $message,
                    'sender_id' => $userSend,
                    'receiver_id' => $userReciver,
                ]
            );
            DB::commit();
            return $result != null;
        } catch (\Throwable  $e) {
            DB::rollBack();
            Log::error($e);
            throw $e;
        }
    }

    public function getUserChat(int $userLoginId): array
    {
        try {
            $listUserChat = DB::select(
                "   SELECT u.avatar,u.id,u.name
                    FROM users u
                    INNER JOIN messages m on u.id = m.sender_id
                    where m.receiver_id = $userLoginId
                    GROUP BY u.avatar,u.id,u.name
                    UNION
                    SELECT u.avatar,u.id,u.name
                    FROM users u
                    INNER JOIN messages m on u.id = m.receiver_id
                    where m.sender_id = $userLoginId
                    GROUP BY u.avatar,u.id,u.name
                "
            );
            return $listUserChat;
        } catch (\Throwable  $e) {
            Log::error($e);
            throw $e;
        }
    }

    public function getChatDetail(int $receiverId, int $senderId): array
    {
        try {
            $listMessage = DB::select(
                "SELECT m.message,u.name,m.sender_id,u.avatar
                FROM `messages` m
                INNER JOIN users u ON u.id = m.sender_id 
                WHERE ( m.sender_id = $senderId and m.receiver_id =$receiverId ) or ( m.sender_id =  $receiverId AND m.receiver_id = $senderId) "
            );
            return $listMessage;
        } catch (\Throwable  $e) {
            Log::error($e);
            throw $e;
        }
    }
}
