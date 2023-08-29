@props(['postId'])
<div class="absolute top-6 right-5 w-96 bg-stone-100 rounded-lg hidden" id="modal-option-post_{{ $postId }}">
    <ol class="flex flex-col py-4 justify-center items-center">
        <li class="hover:bg-stone-200 py-2 w-full text-center" onclick="updateOptionPost(event,{{ $postId }})">Chỉnh
            sửa bài
            viết</li>
        <li class="hover:bg-stone-200 py-2 w-full text-center" onclick="handleDeletePost(event,{{ $postId }})">Xoá
            bài viết</li>
        <li class="hover:bg-stone-200 py-2 w-full text-center" onclick="closeOptionPost(event,{{ $postId }})">Huỷ
        </li>
    </ol>
</div>
