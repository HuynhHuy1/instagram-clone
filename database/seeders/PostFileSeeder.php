<?php

namespace Database\Seeders;

use App\Models\PostFile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostFileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            $data = [
                [
                    'post_id' => 109,
                    'post_file' => '60248b6a-c7d1-4977-bcc1-17451f47ed61_image769900c7-c6ba-44b7-914c-570f75451e73',
                ],
                [
                    'post_id' => 111,
                    'post_file' => '7ce100f6-db95-487a-a2dd-a449e0c852f2_image84fd7d6c-d8ee-49fe-b9c5-ed6a51bf23fa',
                ],
                [
                    'post_id' => 112,
                    'post_file' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1a/24701-nature-natural-beauty.jpg/1600px-24701-nature-natural-beauty.jpg?20160607144903',
                ],
                [
                    'post_id' => 114,
                    'post_file' => 'https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885_1280.jpg',
                ],
                [
                    'post_id' => 115,
                    'post_file' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1a/24701-nature-natural-beauty.jpg/1600px-24701-nature-natural-beauty.jpg?20160607144903',
                ],
                [
                    'post_id' => 116,
                    'post_file' => 'https://media.istockphoto.com/id/1283852667/vi/anh/chạm-vào-rêu-tươi-trong-rừng.jpg?s=612x612&w=0&k=20&c=1NAbpO5PSxYA4FzHdRrd4zODtLni9pzNUtwx3zHYfwU=',
                ],
                [
                    'post_id' => 117,
                    'post_file' => 'https://media.istockphoto.com/id/1254474165/vi/anh/lá-nhiệt-đới-kết-cấu-lá-xanh-trừu-tượng-nền-thiên-nhiên.jpg?s=612x612&w=0&k=20&c=tqpQLxlJ0Ik8vYs3vTt9DiOXYKf7',
                ],
                [
                    'post_id' => 118,
                    'post_file' => 'https://media.istockphoto.com/id/844226534/vi/anh/nền-lá.jpg?s=612x612&w=0&k=20&c=gdqfdXdO60sSpGvXAZA8-1iwf47nMavIIpA0HN-q5kU=',
                ],
                [
                    'post_id' => 120,
                    'post_file' => 'https://media.istockphoto.com/id/1280157339/vi/anh/nhìn-từ-trên-cao-của-rừng-cỏ-xanh-với-những-cây-thông-cao-và-dòng-sông-uốn-cong-màu-xanh-chảy.jpg?s=612x612&w',
                ],
                [
                    'post_id' => 121,
                    'post_file' => 'https://media.istockphoto.com/id/1327919661/vi/anh/khái-niệm-ngày-trái-đất-thế-giới-năng-lượng-xanh-tài-nguyên-tái-tạo-và-bền-vững-chăm-sóc-môi.jpg?s=612x612&w',
                ],
                [
                    'post_id' => 122,
                    'post_file' => '40b3f02c-11bf-4fa2-b0a3-71e210fd828f_image040ec479-dec9-40d9-ae96-a715dd0c2bd1',
                ],
                [
                    'post_id' => 123,
                    'post_file' => 'f98890e1-a137-4710-8c39-dc531b9257f3_image9a1aee70-1bbe-4f61-97e8-002ab1a6d855',
                ],
                [
                    'post_id' => 124,
                    'post_file' => 'bc7efea3-cd0b-43c8-9bfc-53bd79ef723d_image5e016d1e-d50b-4b4b-8e37-10b1cd8f7d38',
                ],
                [
                    'post_id' => 125,
                    'post_file' => 'c1acc231-a96e-4ae2-aef6-22fb7119d92b_imagef4efb1ec-6827-45fb-a3f8-97bf501992b9',
                ],
                [
                    'post_id' => 127,
                    'post_file' => '52eadbea-8be8-4e31-b383-e012359e11f5_imaged7b4c4c1-0a40-4ee1-b3db-560825fb7fd7',
                ],
                [
                    'post_id' => 128,
                    'post_file' => 'f7259bb1-3655-4d09-88ea-aaec1c3a365a_image03219dc9-36d4-4b78-ac88-dd9d90d32c5b',
                ],
                [
                    'post_id' => 129,
                    'post_file' => '9cadfdb0-6869-40d7-89ec-991a58c10f67_image6175b28d-4d3f-47db-bdde-d1a695d72532',
                ],
                [
                    'post_id' => 130,
                    'post_file' => '462a22f0-a823-4e23-9515-4bdb8a36f318_image45a602ca-3a22-4e41-8bab-03de87e50d64',
                ],
            ];
            PostFile::insert($data);
    }
}
