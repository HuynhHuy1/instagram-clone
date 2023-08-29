<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"
        integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <title>Document</title>
</head>

<body>
    @php
        $userId1 = Auth::user();
    @endphp
    <div class="container flex flex-row max-w-screen-2xl relative justify-center" x-data="{ showModelCreate: false, showModalSearch: false, showcomments: false }">
        <div
            class="sidebar basis-2/12 h-screen flex flex-col py-12 ml-4 pr-14 fixed top-0 left-0 border-r-0.5 border-slate-200 ">
            <div class="logo mx-4">
                <svg aria-label="Instagram" class="_ab6-" color="rgb(0, 0, 0)" fill="rgb(0, 0, 0)" height="40"
                    role="img" viewBox="32 4 113 32" width="120">
                    <path clip-rule="evenodd"
                        d="M37.82 4.11c-2.32.97-4.86 3.7-5.66 7.13-1.02 4.34 3.21 6.17 3.56 5.57.4-.7-.76-.94-1-3.2-.3-2.9 1.05-6.16 2.75-7.58.32-.27.3.1.3.78l-.06 14.46c0 3.1-.13 4.07-.36 5.04-.23.98-.6 1.64-.33 1.9.32.28 1.68-.4 2.46-1.5a8.13 8.13 0 0 0 1.33-4.58c.07-2.06.06-5.33.07-7.19 0-1.7.03-6.71-.03-9.72-.02-.74-2.07-1.51-3.03-1.1Zm82.13 14.48a9.42 9.42 0 0 1-.88 3.75c-.85 1.72-2.63 2.25-3.39-.22-.4-1.34-.43-3.59-.13-5.47.3-1.9 1.14-3.35 2.53-3.22 1.38.13 2.02 1.9 1.87 5.16ZM96.8 28.57c-.02 2.67-.44 5.01-1.34 5.7-1.29.96-3 .23-2.65-1.72.31-1.72 1.8-3.48 4-5.64l-.01 1.66Zm-.35-10a10.56 10.56 0 0 1-.88 3.77c-.85 1.72-2.64 2.25-3.39-.22-.5-1.69-.38-3.87-.13-5.25.33-1.78 1.12-3.44 2.53-3.44 1.38 0 2.06 1.5 1.87 5.14Zm-13.41-.02a9.54 9.54 0 0 1-.87 3.8c-.88 1.7-2.63 2.24-3.4-.23-.55-1.77-.36-4.2-.13-5.5.34-1.95 1.2-3.32 2.53-3.2 1.38.14 2.04 1.9 1.87 5.13Zm61.45 1.81c-.33 0-.49.35-.61.93-.44 2.02-.9 2.48-1.5 2.48-.66 0-1.26-1-1.42-3-.12-1.58-.1-4.48.06-7.37.03-.59-.14-1.17-1.73-1.75-.68-.25-1.68-.62-2.17.58a29.65 29.65 0 0 0-2.08 7.14c0 .06-.08.07-.1-.06-.07-.87-.26-2.46-.28-5.79 0-.65-.14-1.2-.86-1.65-.47-.3-1.88-.81-2.4-.2-.43.5-.94 1.87-1.47 3.48l-.74 2.2.01-4.88c0-.5-.34-.67-.45-.7a9.54 9.54 0 0 0-1.8-.37c-.48 0-.6.27-.6.67 0 .05-.08 4.65-.08 7.87v.46c-.27 1.48-1.14 3.49-2.09 3.49s-1.4-.84-1.4-4.68c0-2.24.07-3.21.1-4.83.02-.94.06-1.65.06-1.81-.01-.5-.87-.75-1.27-.85-.4-.09-.76-.13-1.03-.11-.4.02-.67.27-.67.62v.55a3.71 3.71 0 0 0-1.83-1.49c-1.44-.43-2.94-.05-4.07 1.53a9.31 9.31 0 0 0-1.66 4.73c-.16 1.5-.1 3.01.17 4.3-.33 1.44-.96 2.04-1.64 2.04-.99 0-1.7-1.62-1.62-4.4.06-1.84.42-3.13.82-4.99.17-.8.04-1.2-.31-1.6-.32-.37-1-.56-1.99-.33-.7.16-1.7.34-2.6.47 0 0 .05-.21.1-.6.23-2.03-1.98-1.87-2.69-1.22-.42.39-.7.84-.82 1.67-.17 1.3.9 1.91.9 1.91a22.22 22.22 0 0 1-3.4 7.23v-.7c-.01-3.36.03-6 .05-6.95.02-.94.06-1.63.06-1.8 0-.36-.22-.5-.66-.67-.4-.16-.86-.26-1.34-.3-.6-.05-.97.27-.96.65v.52a3.7 3.7 0 0 0-1.84-1.49c-1.44-.43-2.94-.05-4.07 1.53a10.1 10.1 0 0 0-1.66 4.72c-.15 1.57-.13 2.9.09 4.04-.23 1.13-.89 2.3-1.63 2.3-.95 0-1.5-.83-1.5-4.67 0-2.24.07-3.21.1-4.83.02-.94.06-1.65.06-1.81 0-.5-.87-.75-1.27-.85-.42-.1-.79-.13-1.06-.1-.37.02-.63.35-.63.6v.56a3.7 3.7 0 0 0-1.84-1.49c-1.44-.43-2.93-.04-4.07 1.53-.75 1.03-1.35 2.17-1.66 4.7a15.8 15.8 0 0 0-.12 2.04c-.3 1.81-1.61 3.9-2.68 3.9-.63 0-1.23-1.21-1.23-3.8 0-3.45.22-8.36.25-8.83l1.62-.03c.68 0 1.29.01 2.19-.04.45-.02.88-1.64.42-1.84-.21-.09-1.7-.17-2.3-.18-.5-.01-1.88-.11-1.88-.11s.13-3.26.16-3.6c.02-.3-.35-.44-.57-.53a7.77 7.77 0 0 0-1.53-.44c-.76-.15-1.1 0-1.17.64-.1.97-.15 3.82-.15 3.82-.56 0-2.47-.11-3.02-.11-.52 0-1.08 2.22-.36 2.25l3.2.09-.03 6.53v.47c-.53 2.73-2.37 4.2-2.37 4.2.4-1.8-.42-3.15-1.87-4.3-.54-.42-1.6-1.22-2.79-2.1 0 0 .69-.68 1.3-2.04.43-.96.45-2.06-.61-2.3-1.75-.41-3.2.87-3.63 2.25a2.61 2.61 0 0 0 .5 2.66l.15.19c-.4.76-.94 1.78-1.4 2.58-1.27 2.2-2.24 3.95-2.97 3.95-.58 0-.57-1.77-.57-3.43 0-1.43.1-3.58.19-5.8.03-.74-.34-1.16-.96-1.54a4.33 4.33 0 0 0-1.64-.69c-.7 0-2.7.1-4.6 5.57-.23.69-.7 1.94-.7 1.94l.04-6.57c0-.16-.08-.3-.27-.4a4.68 4.68 0 0 0-1.93-.54c-.36 0-.54.17-.54.5l-.07 10.3c0 .78.02 1.69.1 2.09.08.4.2.72.36.91.15.2.33.34.62.4.28.06 1.78.25 1.86-.32.1-.69.1-1.43.89-4.2 1.22-4.31 2.82-6.42 3.58-7.16.13-.14.28-.14.27.07l-.22 5.32c-.2 5.37.78 6.36 2.17 6.36 1.07 0 2.58-1.06 4.2-3.74l2.7-4.5 1.58 1.46c1.28 1.2 1.7 2.36 1.42 3.45-.21.83-1.02 1.7-2.44.86-.42-.25-.6-.44-1.01-.71-.23-.15-.57-.2-.78-.04-.53.4-.84.92-1.01 1.55-.17.61.45.94 1.09 1.22.55.25 1.74.47 2.5.5 2.94.1 5.3-1.42 6.94-5.34.3 3.38 1.55 5.3 3.72 5.3 1.45 0 2.91-1.88 3.55-3.72.18.75.45 1.4.8 1.96 1.68 2.65 4.93 2.07 6.56-.18.5-.69.58-.94.58-.94a3.07 3.07 0 0 0 2.94 2.87c1.1 0 2.23-.52 3.03-2.31.09.2.2.38.3.56 1.68 2.65 4.93 2.07 6.56-.18l.2-.28.05 1.4-1.5 1.37c-2.52 2.3-4.44 4.05-4.58 6.09-.18 2.6 1.93 3.56 3.53 3.69a4.5 4.5 0 0 0 4.04-2.11c.78-1.15 1.3-3.63 1.26-6.08l-.06-3.56a28.55 28.55 0 0 0 5.42-9.44s.93.01 1.92-.05c.32-.02.41.04.35.27-.07.28-1.25 4.84-.17 7.88.74 2.08 2.4 2.75 3.4 2.75 1.15 0 2.26-.87 2.85-2.17l.23.42c1.68 2.65 4.92 2.07 6.56-.18.37-.5.58-.94.58-.94.36 2.2 2.07 2.88 3.05 2.88 1.02 0 2-.42 2.78-2.28.03.82.08 1.49.16 1.7.05.13.34.3.56.37.93.34 1.88.18 2.24.11.24-.05.43-.25.46-.75.07-1.33.03-3.56.43-5.21.67-2.79 1.3-3.87 1.6-4.4.17-.3.36-.35.37-.03.01.64.04 2.52.3 5.05.2 1.86.46 2.96.65 3.3.57 1 1.27 1.05 1.83 1.05.36 0 1.12-.1 1.05-.73-.03-.31.02-2.22.7-4.96.43-1.79 1.15-3.4 1.41-4 .1-.21.15-.04.15 0-.06 1.22-.18 5.25.32 7.46.68 2.98 2.65 3.32 3.34 3.32 1.47 0 2.67-1.12 3.07-4.05.1-.7-.05-1.25-.48-1.25Z"
                        fill="currentColor" fill-rule="evenodd"></path>
                </svg>
            </div>
            <ul class="menu my-14 flex flex-col space-y-8">
                <a href="{{ route('home') }}">
                    <li class="custom-menu-sidebar">
                        <svg aria-label="Trang chủ" class="_ab6-" color="rgb(0, 0, 0)" fill="rgb(0, 0, 0)"
                            height="28" role="img" viewBox="0 0 24 24" width="28">
                            <path
                                d="M22 23h-6.001a1 1 0 0 1-1-1v-5.455a2.997 2.997 0 1 0-5.993 0V22a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V11.543a1.002 1.002 0 0 1 .31-.724l10-9.543a1.001 1.001 0 0 1 1.38 0l10 9.543a1.002 1.002 0 0 1 .31.724V22a1 1 0 0 1-1 1Z">
                            </path>
                        </svg>
                        <h4>Trang chủ</h4>
                    </li>
                </a>

                <li class="custom-menu-sidebar" onclick="openSearchModal()">
                    <svg aria-label="Tìm kiếm" class="_ab6-" color="rgb(0, 0, 0)" fill="rgb(0, 0, 0)" height="28"
                        role="img" viewBox="0 0 24 24" width="28">
                        <path d="M19 10.5A8.5 8.5 0 1 1 10.5 2a8.5 8.5 0 0 1 8.5 8.5Z" fill="none"
                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                        </path>
                        <line fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" x1="16.511" x2="22" y1="16.511" y2="22"></line>
                    </svg>
                    <h4>Tìm kiếm</h4>
                </li>

                <a href="/chat/chat">
                    <li class="custom-menu-sidebar" onclick="openSearchModal()">
                        <svg aria-label="Direct" class="_ab6-" color="rgb(0, 0, 0)" fill="rgb(0, 0, 0)" height="24"
                            role="img" viewBox="0 0 24 24" width="24">
                            <line fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="2"
                                x1="22" x2="9.218" y1="3" y2="10.083"></line>
                            <polygon fill="none" points="11.698 20.334 22 3.001 2 3.001 9.218 10.084 11.698 20.334"
                                stroke="currentColor" stroke-linejoin="round" stroke-width="2"></polygon>
                        </svg>
                        <h4>Nhắn tin</h4>
                    </li>
                </a>

                <li class="custom-menu-sidebar" onclick="showModelCreate()">
                    <svg aria-label="Bài viết mới" class="_ab6-" color="rgb(0, 0, 0)" fill="rgb(0, 0, 0)"
                        height="28" role="img" viewBox="0 0 24 24" width="28">
                        <path
                            d="M2 12v3.45c0 2.849.698 4.005 1.606 4.944.94.909 2.098 1.608 4.946 1.608h6.896c2.848 0 4.006-.7 4.946-1.608C21.302 19.455 22 18.3 22 15.45V8.552c0-2.849-.698-4.006-1.606-4.945C19.454 2.7 18.296 2 15.448 2H8.552c-2.848 0-4.006.699-4.946 1.607C2.698 4.547 2 5.703 2 8.552Z"
                            fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2"></path>
                        <line fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" x1="6.545" x2="17.455" y1="12.001" y2="12.001"></line>
                        <line fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" x1="12.003" x2="12.003" y1="6.545" y2="17.455"></line>
                    </svg>
                    <h4>Tạo</h4>
                </li>
                <a href="{{ route('profile', ['id' => $userId1]) }}">
                    <li class="custom-menu-sidebar">
                        <svg xmlns="http://www.w3.org/2000/svg" height="28px" witdh="28px" viewBox="0 0 448 512">
                            <path
                                d="M304 128a80 80 0 1 0 -160 0 80 80 0 1 0 160 0zM96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM49.3 464H398.7c-8.9-63.3-63.3-112-129-112H178.3c-65.7 0-120.1 48.7-129 112zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3z" />
                        </svg>
                        <h4>Trang cá nhân </h4>
                    </li>
                </a>
            </ul>
            <div class="sidebar_more custom-menu-sidebar absolute right-0 left-0 bottom-6" onclick="openModalMore()">
                <svg aria-label="Cài đặt" class="_ab6-" color="rgb(0, 0, 0)" fill="rgb(0, 0, 0)" height="24"
                    role="img" viewBox="0 0 24 24" width="24">
                    <line fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" x1="3" x2="21" y1="4" y2="4"></line>
                    <line fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" x1="3" x2="21" y1="12" y2="12"></line>
                    <line fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" x1="3" x2="21" y1="20" y2="20"></line>
                </svg>
                <h4>Xem thêm</h4>
                <ul class="menu my-14 flex flex-col space-y-4 absolute bottom-4 bg-stone-200 rounded-lg py-4 w-full left-0 hidden"
                    id="modal-more">
                    <a href="{{ route('show-form-update-password') }}">
                        <li class="custom-menu-sidebar">
                            <h5 class="text-center">Đổi mật khẩu</h5>
                        </li>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <li class="custom-menu-sidebar" onclick="logout()">
                        <h5>Đăng xuất</h5>
                    </li>
                </ul>
            </div>
        </div>
        <div class="content ml-80 flex flex-col w-2/4 mt-10">
            {{ $slot }}
        </div>
        <x-home.create-post-card :user="$userId1" />
        <x-home.search />
        <x-home.comment-card />
        <x-home.pop_up />
    </div>
    <script>
        function openModalMore() {
            const modalMore = document.getElementById("modal-more")
            modalMore.classList.toggle('hidden')
        }

        function logout() {
            document.getElementById('logout-form').submit();
        }

        var currentPage = 2;
        var postsOnPage = 4;
        var isLoad = true;
        $(window).bind('scroll', function() {
            var docHeight = document.documentElement.scrollHeight;
            var winHeight = window.innerHeight;
            var scrollPos = window.scrollY;
            if (isLoad) {
                if (docHeight - winHeight <= scrollPos) {
                    loadMorePost()
                }
            }
        });

        function loadMorePost() {
            const listPostDiv = document.getElementById('list_post')
            const urlAvatar = '{{ asset('storage/avatar') }}'
            const urlPost = '{{ asset('storage/post') }}'
            const userID = '{{ Auth::user()->id }}'
            $.ajax({
                url: "post/get-more-post",
                method: "GET",
                data: {
                    current_page: currentPage
                },
                success: function(listPost) {
                    currentPage += 1;
                    if (listPost.data.length < postsOnPage) {
                        isLoad = false
                    }
                    var userId = {!! json_encode(Auth::user()->id) !!};
                    listPost.data.forEach(post => {
                        const timeCreatePostFormat = convertTime(post.created_at);
                        post.isUserLikePost = false;
                        if (post.likes.length !== 0) {
                            post.likes.forEach(like => {
                                if (like.user_id === userId) {
                                    post.isUserLikePost = true;
                                }
                            });
                        }
                        console.log(listPost);
                        html = `
    <section class="post flex flex-col " id="post_${post.id}">
        <header class="flex flex-row p-4 ">
            <a href="profile/${post.user.id}">
                <img src="${post.user.avatar}" alt="Image"
                    class="w-14 h-14 rounded-full">
            </a>
            <div class="self-center ml-4 mr-80">
                <h4>${post.user.name}</h4>
                <h5>${timeCreatePostFormat}</h5>
            </div>
            ${userID == post.user.id ? `
                                            <div class="self-center relative" id="post_option_${post.id}"
                                                                                onclick="openOptionPost(${post.id})">
                                                    <svg aria-label="Tùy chọn khác" class="_ab6- ml-12 " color="rgb(0, 0, 0)" fill="rgb(0, 0, 0)"
                                                        height="32" role="img" viewBox="0 0 24 24" width="32">
                                                        <circle cx="12" cy="12" r="1.5"></circle>
                                                        <circle cx="6" cy="12" r="1.5"></circle>
                                                        <circle cx="18" cy="12" r="1.5"></circle>
                                                    </svg>
                                                    <div class="absolute top-6 right-5 w-96 bg-stone-100 rounded-lg hidden" id="modal-option-post_${post.id}">
                                                        <ol class="flex flex-col py-4 justify-center items-center">
                                                            <li class="hover:bg-stone-200 py-2 w-full text-center" onclick="updateOptionPost(event,${post.id})">Chỉnh
                                                                sửa bài
                                                                viết</li>
                                                            <li class="hover:bg-stone-200 py-2 w-full text-center" onclick="handleDeletePost(event,${post.id})">Xoá
                                                                bài viết</li>
                                                            <li class="hover:bg-stone-200 py-2 w-full text-center" onclick="closeOptionPost(event,${post.id})">Huỷ
                                                            </li>
                                                        </ol>
                                                    </div>

                                            </div>
                                            <div id="update-post-modal_${post.id}" tabindex="-1" aria-hidden="true"
                                                class="fixed top-0 left-0 right-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full flex justify-center items-center flex-col hidden">
                                                <form action="/${post.id}" method="POST"
                                                    class="w-8/12 h-5/6 flex flex-col bg-slate-100 rounded-xl z-20">
                                                    @csrf
                                                    @method('PUT')
                                                    <header class="flex flex-row items-center justify-between">
                                                        <svg aria-label="Đóng" class="x1lliihq x1n2onr6 ml-4" color="rgb(174,174,174)" fill="rgb(174,174,174)"
                                                            height="18" role="img" viewBox="0 0 24 24" width="18" onclick="closeModalUpdatePost(${post.id})">
                                                            <title>Đóng</title>
                                                            <polyline fill="none" points="20.643 3.357 12 12 3.353 20.647" stroke="currentColor"
                                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="3"></polyline>
                                                            <line fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="3" x1="20.649" x2="3.354" y1="20.649" y2="3.354"></line>
                                                        </svg>
                                                        <h1 class="flex-grow text-center py-4">Sửa bài viết</h1>
                                                        <button class="rounded-xl text-stone-400 mr-8" id="btn-update_post_${post.id}" disabled>Chia sẻ</button>
                                                    </header>
                                                    <main class="flex flex-row h-full " style="height:calc(100% - 56px)">
                                                                <img src="${urlPost}/${post.files[0].post_file}" alt=""
                                                                    class="rounded-bl-xl w-7/12" id="form-image">
                                                        <section class="flex flex-col">
                                                            <div class="flex flex-row w-full px-2 py-4 ml-4">
                                                                <header class="flex flex-row space-x-4">
                                                                    <img src="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAoHCBYWFRYWFBUZGRYWGhoaHRwZGBwaGhgYGR4cHBkZHBodIC4lHB8rHxgcJjgoKy8xNTZDHCQ7QDs0PzA0NTEBDAwMEA8QHxISHzQsJSsxMT8/PzU0NjQ0NT80NDQ0NDE0NjQ0NDQ0NDY2NDQxNj0xMT81NDQ0NDQ2MTQ2NDE0NP/AABEIAOEA4QMBIgACEQEDEQH/xAAcAAEAAQUBAQAAAAAAAAAAAAAABQIDBAYHAQj/xABGEAACAQMCAgYHBAkACAcAAAABAgADBBESIQUxBkFRYXGBBxMiMkKRoRQjUnIzYoKSorHB0fBDk7KzwtLh8RUkNERjc6T/xAAaAQEAAwEBAQAAAAAAAAAAAAAAAQIDBAUG/8QAKxEBAQACAQMCBgIBBQAAAAAAAAECEQMSITEEQQUiUWFx0ROxgTNCkaHB/9oADAMBAAIRAxEAPwDs0REBERAREQEREBERAREQEREBERAREQEREBERAREQEREBERAREQEREBERAREQEREDyUVKgUEsQANyScADtJPKQPSnpTSs0GfbqsDopg4J72Pwr3/IGcc470guLts13JXOQi7U18F6z3nJ75S5SLTG11fifpBsqWQrtVYdVIah++SFPkTNduPSqc/d2ox2tV3/AHQv9ZzYAdZA8c/2lTJtnP8Ab5/3mdzrSYRv6+lOtne3p4/Ow+uJIWXpTpnatbunfTdX88MF/rOW6seUK4bceY/qI68joj6E4Nx63ulLUKgbHMbq6+KnBHjykrPm22u3pOr03ZHXkynB7/EHrHIzpPQz0hGo60LsrqYhUqAacseSuvIEnkRgchjrl8c9+VMsNeHSoiJooREQEREBERAREQEREBERAREQEREBERAShjscDPdK54TA+buIcQq1a9R7glaxdtQPwFTjQB1Bcacd0xmrr1bGTnBejf264rPTJS2FRzrO7FSxZVXPNtJByeWd89fQLToTZJjFDWe2ozPnxBOn5Cc2WUldOONscdat/n+dUs+sxuDjz2ndD0VtD/7Wj/q1+vbMm14LQp707ekh7VpqD8wMyvV9luj7uJW3B7msNVO3qMPxBG0nwYjHyMtXnDa9HerRqIO1kYLv+tjB+c7+wlDqCCCMgjBB5Hxkdaf4/u+eXckymb90y6KIqNcW66NG7oPdK9bqPhxzIG2M+ehBZpLLGeWNxuq7L6MelrXKG3rnNakoKsTvVpjbJ7WUkAnryDzzOhT5p4FxBra4pV1z924LAfEp2dfNSw+U+k0YEAg5BGQe0GbY3cY5TVVxESypERAREQEREBERAREQEREBERAREQPJB9M7s0rG6dThhScKexmGlT82EnJqnpNQtw6uq82aiv71amP6yL4TPLG6HWYpWlBAMewGP5nGpvqTJ8LInhlZURdTBQp05YgDkMc5LUayN7rq35WB/lOSd3Zl8t0qxKSJcMxL29p0l11HVF5ZY437O+TpWVVUltuU1LiPpEtVOmmlSoeogBVPhqOr+GYVt0qvnbIsjoIOwSpnuOrHPylbKvLGyOAwKtuGBBHaDsZx02hUkHqOPltOr21wXGSjoetXUqwPgf5zVuOcFCNrTJRyefNWO+M9YMY3S/Jj1SWNTFvO+9FapaztiefqkB7yqgH6icbW2nXuhf8A6Kh3Bh8mYTbjvdy8uOonoiJuwIiICIiAiIgIiICIiAiIgIiICIiB5InpPaNUtayqNT6dSr+J6ZDovmygSWmFxG/Wiut8nJChVBZndjhVUDmT8huSQATIvhM8ub3vRW3qJ9prVnfWqspyAgVgCioo35EdZznM1hOHWyv91UrIyrr1Gm2FTIXXq0qQmogauW/OdC4fZmtbBCrIFesgVgupUSq6qpxkA6ABtkRxLonTuKq1aq4KqFwmAp053OQTnBxseoTldl76uop6O62TS7+sI3D4wSpG2dznlz75h9KOGJVZFdm0pk4BABJxz2mzW1kqOxUYJGWxyyewch5ASyFBc5APPGRn/OUzvZrLL/w0peHNTSq9nRpn1KFmYhmY4BOkHmTtyz/ae9HuOXDtjIKgU9WlGUKzhiVILt7IKEasb5HLM36lYpzCICSeSjn2wlgi4AUADkAAAPADaX128M+r5vPb6Md11pyweruMguIU9VN18/kczaisgbxMMw8fr/3lL2a43fZrNtw9nOEXJ/ztm3cK4yLalTp1qToikguTTKrqYkMwDlwu+7aduZwATMfg1MLqJ2A/mdh/WZ4p03pMXAKurFieoYOR5DaXwysu4z5cJZqtpiRfRssbS2NTPrDQpa889WhdWe/OZKTscBERAREQEREBERAREQEREBERAREQEhuk9matrVVRlwpen3VUGumf3gM9oyOuTE8J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"
                                                                        alt="" class="w-8 h-8 rounded-full">
                                                                    <h1 class="">${post.user.name}</h1>
                                                                </header>
                                                            </div>
                                                            <textarea
                                                                class=" h-full w-80 ml-4  no-resize appearance-none block bg-slate-100 text-gray-700 border border-slate-100 rounded py-3 px-4 mb-3 leading-tight resize-none focus:outline-none "
                                                                placeholder="Viết chú thích ..." name="content_upload" oninput="checkContentLengthForUpdate(event,${post.id})">${post.content}</textarea>
                                                        </section>
                                                    </main>
                                                    <textarea name="version" class="hidden">${post.version}</textarea>
                                                </form>
                                            </div>                                
                                            ` 

                                                            : `` 
            }

        </header>
        <main class="mx-4 mb-2">
            <h4 class="mb-4">
                ${post.content}
            </h4>
               <img src="${urlPost}/${post.files[0].post_file}" alt="" width="600px"
                        height="700px" class="rounded-xl">
        </main>
        
        <footer>
        <div class="flex flex-row ml-4 space-x-4 mt-2">
            ${post.isUserLikePost ? `
                                                                            <svg aria-label="Thích" class="x1lliihq x1n2onr6" color="rgb(38, 38, 38)" fill="red"
                                                                                    height="24" role="img" viewBox="0 0 24 24" width="24"
                                                                                    x-on:click="handleLike(${post.id},${post.likes.length})"
                                                                                    id="like_icon_svg_${post.id}">
                                                                                    <title>Thích</title>
                                                                                    <path
                                                                                        d="M16.792 3.904A4.989 4.989 0 0 1 21.5 9.122c0 3.072-2.652 4.959-5.197 7.222-2.512 2.243-3.865 3.469-4.303 3.752-.477-.309-2.143-1.823-4.303-3.752C5.141 14.072 2.5 12.167 2.5 9.122a4.989 4.989 0 0 1 4.708-5.218 4.21 4.21 0 0 1 3.675 1.941c.84 1.175.98 1.763 1.12 1.763s.278-.588 1.11-1.766a4.17 4.17 0 0 1 3.679-1.938m0-2a6.04 6.04 0 0 0-4.797 2.127 6.052 6.052 0 0 0-4.787-2.127A6.985 6.985 0 0 0 .5 9.122c0 3.61 2.55 5.827 5.015 7.97.283.246.569.494.853.747l1.027.918a44.998 44.998 0 0 0 3.518 3.018 2 2 0 0 0 2.174 0 45.263 45.263 0 0 0 3.626-3.115l.922-.824c.293-.26.59-.519.885-.774 2.334-2.025 4.98-4.32 4.98-7.94a6.985 6.985 0 0 0-6.708-7.218Z">
                                                                                    </path>
                                                                            </svg>
                                                                            <p class="ml-4" id="like_number_${post.id}">${post.likes.length ?? 0}</p>
                                                                        ` : `
                                                                        <svg aria-label="Thích" class="x1lliihq x1n2onr6" color="rgb(38, 38, 38)" fill="rgb(38, 38, 38)"
                                                                                    height="24" role="img" viewBox="0 0 24 24" width="24"
                                                                                    x-on:click="handleLike(${post.id},${post.likes.length})"
                                                                                    id="like_icon_svg_${post.id}">
                                                                                    <title>Thích</title>
                                                                                    <path
                                                                                        d="M16.792 3.904A4.989 4.989 0 0 1 21.5 9.122c0 3.072-2.652 4.959-5.197 7.222-2.512 2.243-3.865 3.469-4.303 3.752-.477-.309-2.143-1.823-4.303-3.752C5.141 14.072 2.5 12.167 2.5 9.122a4.989 4.989 0 0 1 4.708-5.218 4.21 4.21 0 0 1 3.675 1.941c.84 1.175.98 1.763 1.12 1.763s.278-.588 1.11-1.766a4.17 4.17 0 0 1 3.679-1.938m0-2a6.04 6.04 0 0 0-4.797 2.127 6.052 6.052 0 0 0-4.787-2.127A6.985 6.985 0 0 0 .5 9.122c0 3.61 2.55 5.827 5.015 7.97.283.246.569.494.853.747l1.027.918a44.998 44.998 0 0 0 3.518 3.018 2 2 0 0 0 2.174 0 45.263 45.263 0 0 0 3.626-3.115l.922-.824c.293-.26.59-.519.885-.774 2.334-2.025 4.98-4.32 4.98-7.94a6.985 6.985 0 0 0-6.708-7.218Z">
                                                                                    </path>
                                                                        </svg>
                                                                        <p class="ml-4" id="like_number_${post.id}">${post.likes.length ?? 0}</p>
                                                                        `}
            <svg aria-label="Bình luận" class="x1lliihq x1n2onr6" color="rgb(0, 0, 0)" fill="rgb(0, 0, 0)"
                    height="24" role="img" viewBox="0 0 24 24" width="24"
                    onclick="getComment(${post.id})">
                    <title>Bình luận</title>
                    <path d="M20.656 17.008a9.993 9.993 0 1 0-3.59 3.615L22 22Z" fill="none" stroke="currentColor"
                        stroke-linejoin="round" stroke-width="2"></path>
            </svg>
            <p class="ml-4" id="">${post.comments.length ?? 0}</p>
            </div>
            <form>
                <div class="flex flex-row mt-4">
                    <textarea id="text_comment_${post.id}" rows="1"
                        class="block mx-4 p-2.5 w-9/12 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 resize-none"
                        placeholder="Bình luận của bạn ..." oninput="validFormComment1(${post.id})"></textarea>
                    <button type="button" id="btn_send_comment_${post.id}"
                        class="
                        justify-center p-2 text-blue-600 rounded-full cursor-pointer hover:bg-blue-100
                        dark:text-blue-500 dark:hover:bg-gray-600 hidden"
                        onclick="createComment1(${post.id})">
                        <svg class="w-5 h-5 rotate-90" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 18 20">
                            <path
                                d="m17.914 18.594-8-18a1 1 0 0 0-1.828 0l-8 18a1 1 0 0 0 1.157 1.376L8 18.281V9a1 1 0 0 1 2 0v9.281l6.758 1.689a1 1 0 0 0 1.156-1.376Z" />
                        </svg>
                        <span class="sr-only">Send message</span>
                    </button>
                </div>
            </form>
        </footer>
        <hr class="mt-8 mb-4 ml-4 mr-20">
    </section>
                            `
                        listPostDiv.insertAdjacentHTML('beforeend', html)
                    });
                },
                error: function(xhr, status, error) {
                    console.log("Error:", error);
                }
            });
        }

        function convertTime(timeCreate) {
            var formatter = "YYYY-MM-DD HH:mm:ss";

            var dateTime = moment(timeCreate, formatter);

            var currentDateTime = moment();
            var duration = moment.duration(currentDateTime.diff(dateTime));

            if (duration.days() > 1) {
                return duration.days() + " ngày trước";
            } else if (duration.hours() > 1) {
                return duration.hours() + " giờ trước";
            } else if (duration.minutes === 0) {
                return duration.minutes() + " phút trước";
            }
        }

        function showModelCreate() {
            const modalCreatePost = document.getElementById('create_modal')
            modalCreatePost.classList.remove('hidden')
        }
    </script>
</body>

</html>
