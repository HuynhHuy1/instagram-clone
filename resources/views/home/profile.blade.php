<x-app-layout>
    @php
        $isUserLogin = $profile['isUserLogin'];
        $isFollowed = $profile['isFollowed'];
        $listPost = $profile['listPost'];
        $postCount = count($listPost);
    @endphp
    <header class="flex flex-row mb-20">
        <img src="{{ $listPost[0]->user->avatar }}" alt="" class="w-32 h-32 rounded-full basis-2/12">
        <section class="basis-10/12 pl-20 flex flex-col">
            <div class="flex flex-row pt-2">
                <h1 class="py-1">{{ $listPost[0]->user->name }}</h1>
                @if ($isUserLogin)
                    <a href="{{ route('show-form-update-profile') }}">
                        <button class="px-4 py-1 bg-slate-200 ml-10 rounded-xl hover:bg-slate-300">
                            Chỉnh sửa trang cá nhân
                        </button>
                    </a>
                @else
                    @if ($isFollowed)
                        <button class="px-4 py-1 bg-slate-200 ml-10 rounded-xl hover:bg-slate-300"
                            onclick="toggleFollow({{$listPost[0]->user_id }})" id="btn-follow">
                            Đang theo dõi
                        </button>
                    @else
                        <button class="px-4 py-1 bg-slate-200 ml-10 rounded-xl hover:bg-slate-300"
                            onclick="toggleFollow({{ $listPost[0]->user_id }})" id="btn-follow">
                            Theo dõi
                        </button>
                    @endif

                @endif
            </div>
            <div class="flex flex-row mt-8 space-x-4">
                <h1>{{ $postCount }} bài viết</h1>
                <h1>{{ $post->user->follower ?? 0 }} người theo dõi</h1>
                <h1>Đang theo dõi {{ $post->user->following ?? 0 }}</h1>
            </div>
        </section>
    </header>
    <x-home.post-card :listPost="$listPost" />
    <script>
        function toggleFollow(userId) {
            const btnFollow = document.getElementById('btn-follow')
            $.ajax({
                url: `/follow/${userId}`,
                type: 'GET',
                success: function(response) {
                    if (response.status === 'success') {
                        if (response.message === 'add') {
                            btnFollow.innerText = 'Đang theo dõi'
                        } else {
                            btnFollow.innerText = 'Theo dõi'
                        }
                    } else {
                        showAlertWithTimeout(response.message, 'error');
                    }
                },
                error: function(error) {
                    console.log(error)
                    showAlertWithTimeout(error, 'error');
                },
            });
        }
    </script>
</x-app-layout>
