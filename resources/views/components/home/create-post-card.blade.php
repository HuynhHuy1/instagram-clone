@props(['user'])
<div id="create_modal" tabindex="-1" aria-hidden="true"
    class="fixed top-0 left-0 right-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full flex justify-center items-center flex-col hidden ">
    <div class="overlay fixed w-full h-full bg-stone-400 opacity-40 z-10"></div>
    <form action="{{ route('create_post') }}" method="post" enctype="multipart/form-data"
        class="w-8/12 h-5/6 flex flex-col bg-slate-100 rounded-xl z-20" id="form-upload-post">
        @csrf
        <header class="flex flex-row items-center justify-between">
            <svg aria-label="Đóng" onclick="handleCloseCreatePost()" class="x1lliihq x1n2onr6 ml-4"
                color="rgb(174,174,174)" fill="rgb(174,174,174)" height="18" role="img" viewBox="0 0 24 24"
                width="18">
                <title>Đóng</title>
                <polyline fill="none" points="20.643 3.357 12 12 3.353 20.647" stroke="currentColor"
                    stroke-linecap="round" stroke-linejoin="round" stroke-width="3"></polyline>
                <line fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="3" x1="20.649" x2="3.354" y1="20.649" y2="3.354"></line>
            </svg>
            <h1 class="flex-grow text-center py-4">Tạo bài viết mới</h1>
            <button class="rounded-xl text-stone-400 mr-8" id="btn-upload_post" disabled>Chia sẻ</button>
        </header>
        <main class="flex flex-row h-full ">
            <div class="rounded-bl-xl w-7/12 flex flex-col items-center justify-center space-y-4 "
                id="form-choose-image">
                <svg aria-label="Biểu tượng thể hiện file phương tiện, chẳng hạn như hình ảnh hoặc video"
                    class="x1lliihq x1n2onr6" color="rgb(0, 0, 0)" fill="rgb(0, 0, 0)" height="77" role="img"
                    viewBox="0 0 97.6 77.3" width="96">
                    <title>Biểu tượng thể hiện file phương tiện, chẳng hạn như hình ảnh hoặc video</title>
                    <path
                        d="M16.3 24h.3c2.8-.2 4.9-2.6 4.8-5.4-.2-2.8-2.6-4.9-5.4-4.8s-4.9 2.6-4.8 5.4c.1 2.7 2.4 4.8 5.1 4.8zm-2.4-7.2c.5-.6 1.3-1 2.1-1h.2c1.7 0 3.1 1.4 3.1 3.1 0 1.7-1.4 3.1-3.1 3.1-1.7 0-3.1-1.4-3.1-3.1 0-.8.3-1.5.8-2.1z"
                        fill="currentColor"></path>
                    <path
                        d="M84.7 18.4 58 16.9l-.2-3c-.3-5.7-5.2-10.1-11-9.8L12.9 6c-5.7.3-10.1 5.3-9.8 11L5 51v.8c.7 5.2 5.1 9.1 10.3 9.1h.6l21.7-1.2v.6c-.3 5.7 4 10.7 9.8 11l34 2h.6c5.5 0 10.1-4.3 10.4-9.8l2-34c.4-5.8-4-10.7-9.7-11.1zM7.2 10.8C8.7 9.1 10.8 8.1 13 8l34-1.9c4.6-.3 8.6 3.3 8.9 7.9l.2 2.8-5.3-.3c-5.7-.3-10.7 4-11 9.8l-.6 9.5-9.5 10.7c-.2.3-.6.4-1 .5-.4 0-.7-.1-1-.4l-7.8-7c-1.4-1.3-3.5-1.1-4.8.3L7 49 5.2 17c-.2-2.3.6-4.5 2-6.2zm8.7 48c-4.3.2-8.1-2.8-8.8-7.1l9.4-10.5c.2-.3.6-.4 1-.5.4 0 .7.1 1 .4l7.8 7c.7.6 1.6.9 2.5.9.9 0 1.7-.5 2.3-1.1l7.8-8.8-1.1 18.6-21.9 1.1zm76.5-29.5-2 34c-.3 4.6-4.3 8.2-8.9 7.9l-34-2c-4.6-.3-8.2-4.3-7.9-8.9l2-34c.3-4.4 3.9-7.9 8.4-7.9h.5l34 2c4.7.3 8.2 4.3 7.9 8.9z"
                        fill="currentColor"></path>
                    <path
                        d="M78.2 41.6 61.3 30.5c-2.1-1.4-4.9-.8-6.2 1.3-.4.7-.7 1.4-.7 2.2l-1.2 20.1c-.1 2.5 1.7 4.6 4.2 4.8h.3c.7 0 1.4-.2 2-.5l18-9c2.2-1.1 3.1-3.8 2-6-.4-.7-.9-1.3-1.5-1.8zm-1.4 6-18 9c-.4.2-.8.3-1.3.3-.4 0-.9-.2-1.2-.4-.7-.5-1.2-1.3-1.1-2.2l1.2-20.1c.1-.9.6-1.7 1.4-2.1.8-.4 1.7-.3 2.5.1L77 43.3c1.2.8 1.5 2.3.7 3.4-.2.4-.5.7-.9.9z"
                        fill="currentColor"></path>
                </svg>
                <input type="file" name="post_file" id="selectFileBtn" class="hidden" x-on:change="setImage($event)"
                    accept=".jpg, .jpeg, .png">
                <button type="button" class="bg-blue-500 px-8 py-2 rounded-2xl text-white"
                    x-on:click="handleBtnOnClick()" id="postFileInput"> Chọn từ máy tính
                </button>
            </div>
            <img src="" alt="" class="hidden rounded-bl-xl w-7/12" id="form-image-upload"
                onclick="handleBtnOnClick()">
            <section class="flex flex-col">
                <div class="flex flex-row w-full px-2 py-4 ml-4">
                    <header class="flex flex-row space-x-4">
                        <img id="header-image" src="{{ $user->avatar }}" alt="" class="w-8 h-8 rounded-full">
                        <h1 id="header-name" class="">{{ $user->name }}</h1>
                        <!-- Dropdown menu -->
                        <div class="relative inline-block text-left">
                            <div>
                                <button type="button" onclick="handleButtonPrivacy()"
                                    class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50"
                                    id="button-privacy" aria-expanded="true" aria-haspopup="true">
                                    Công khai
                                    <svg class="-mr-1 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor"
                                        aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                            <div class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none hidden"
                                role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1"
                                id="option-privacy">
                                <div class="py-1" role="none">
                                    <!-- Thêm thuộc tính data-value để lưu giá trị của tùy chọn -->
                                    <a href="#" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem"
                                        tabindex="-1" data-value="Chỉ bạn bè" onclick="selectOption(this)">Chỉ bạn
                                        bè</a>
                                    <a href="#" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem"
                                        tabindex="-1" data-value="Riêng tư" onclick="selectOption(this)">Riêng
                                        tư</a>
                                </div>
                            </div>
                        </div>

                    </header>
                </div>
                <textarea
                    class=" h-full w-80 ml-4  no-resize appearance-none block bg-slate-100 text-gray-700 border border-slate-100 rounded py-3 px-4 mb-3 leading-tight resize-none focus:outline-none "
                    placeholder="Viết chú thích ..." name="content" oninput="checkContentLength()"></textarea>
            </section>
        </main>
        <input type="hidden" name="privacy_mode" id="privacy_mode_input" value="public">
    </form>
</div>
<script>
    function handleBtnOnClick() {
        const selectFileBtn = document.getElementById('selectFileBtn');
        const postFileInput = document.getElementById('postFileInput');
        selectFileBtn.click();
    }

    function setImage(event) {
        const formChooseImage = document.getElementById('form-choose-image')
        const image = document.getElementById('form-image-upload')
        const btnUpLoad = document.getElementById('btn-upload_post')
        formChooseImage.classList.add('hidden')
        const file = event.target.files[0];
        if (file != null) {
            const reader = new FileReader();
            reader.onload = function(event) {
                image.setAttribute('src', event.target.result);
            };
            image.classList.remove('hidden');
            reader.readAsDataURL(file);
            checkContentLength()
        }
    }

    function handleCloseCreatePost() {
        const modalCreatePost = document.getElementById('create_modal')
        modalCreatePost.classList.add('hidden')
        const formChooseImage = document.getElementById('form-choose-image')
        const formUploadPost = document.getElementById('form-upload-post')
        const image = document.getElementById('form-image-upload')
        formChooseImage.classList.remove('hidden')
        formUploadPost.reset()
        image.classList.add('hidden');
    }

    function checkContentLength() {
        const textarea = document.querySelector('textarea[name="content"]');
        const btnUpLoad = document.getElementById('btn-upload_post')
        let content = textarea.value;
        const wordCount = content.length;
        if (wordCount > 235) {
            btnUpLoad.classList.add('text-stone-400')
            btnUpLoad.classList.remove('text-cyan-500')
            btnUpLoad.disabled = true;
        } else {
            btnUpLoad.classList.remove('text-stone-400')
            btnUpLoad.classList.add('text-cyan-500')
            btnUpLoad.disabled = false;
        }
    }

    function handleButtonPrivacy() {
        var dropdownMenu = document.getElementById("option-privacy");
        dropdownMenu.classList.toggle("hidden");
    }

    function selectOption(option) {
        var selectedValue = option.getAttribute("data-value");
        var buttonText = document.getElementById("button-privacy");
        buttonText.innerText = selectedValue;
        var privacyInput = document.getElementById("privacy_mode_input");
        if (selectedValue === 'Công khai') {
            privacyInput.value = 'public';
            console.log('hello');
        } else if (selectedValue === 'Chỉ bạn bè') {
            privacyInput.value = 'friend';
            console.log('hello 1');
        } else if (selectedValue === 'Riêng tư') {
            privacyInput.value = 'private';
            console.log('hello ');
        }
        handleButtonPrivacy();
    }
</script>
