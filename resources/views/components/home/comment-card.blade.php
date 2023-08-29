{{-- <div id="comment_modal" tabindex="-1" aria-hidden="true"
    class="fixed top-0 left-0 right-0 z-50 w-full p-4 overflow-x-hidden hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full flex justify-center items-center flex-col">
    <div class="overlay fixed w-full h-full bg-stone-400 opacity-40 z-10"></div>
    <section class="w-8/12 h-5/6 flex flex-col bg-slate-100 rounded-xl z-20">
        <header class="flex flex-row items-center justify-between">
            <svg aria-label="Đóng" class="x1lliihq x1n2onr6 ml-4" color="rgb(174,174,174)" fill="rgb(174,174,174)"
                height="18" role="img" viewBox="0 0 24 24" width="18" x-on:click="closePostDetail()">
                <title>Đóng</title>
                <polyline fill="none" points="20.643 3.357 12 12 3.353 20.647" stroke="currentColor"
                    stroke-linecap="round" stroke-linejoin="round" stroke-width="3"></polyline>
                <line fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="3" x1="20.649" x2="3.354" y1="20.649" y2="3.354"></line>
            </svg>
            <h1 class="flex-grow text-center py-4">Bình luận bài viết</h1>
        </header>
        <main class="flex flex-row " style="height:calc(100% - 56px)">
            <img src="" alt="" class="rounded-bl-xl w-7/12 max-h-" id="image_comment">
            <section class="flex flex-col">
                <div id="post-content"></div>
                <hr class="w-96 mb-4">
                <div id="post-comments" style="
                overflow: scroll;height: 290px;">
                </div>
            </section>
        </main>
    </section>
</div> --}}

<div id="comment_modal" tabindex="-1" aria-hidden="true"
    class="fixed top-0 left-0 right-0 z-50 w-full p-4 overflow-x-hidden hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full flex justify-center items-center flex-col">
    <div class="overlay fixed w-full h-full bg-stone-400 opacity-40 z-10"></div>
    <section class="w-8/12 h-5/6 flex flex-col bg-slate-100 rounded-xl z-20">
        <header class="flex flex-row items-center justify-between">
            <svg aria-label="Đóng" class="x1lliihq x1n2onr6 ml-4" color="rgb(174,174,174)" fill="rgb(174,174,174)"
                height="18" role="img" viewBox="0 0 24 24" width="18" x-on:click="closePostDetail()">
                <title>Đóng</title>
                <polyline fill="none" points="20.643 3.357 12 12 3.353 20.647" stroke="currentColor"
                    stroke-linecap="round" stroke-linejoin="round" stroke-width="3"></polyline>
                <line fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="3" x1="20.649" x2="3.354" y1="20.649" y2="3.354"></line>
            </svg>
            <h1 class="flex-grow text-center py-4">Bình luận bài viết</h1>
        </header>
        <main class="flex flex-row " style="height:calc(100% - 56px)">
            <img src="" alt="" class="rounded-bl-xl w-7/12 max-h-" id="image_comment">
            <section class="flex flex-col">
                <div id="post-content"></div>
                <hr class="w-96 mb-4">
                <div id="post-comments" style="
                overflow: scroll;height: 350px;">
                </div>
            </section>
        </main>
    </section>
</div>
