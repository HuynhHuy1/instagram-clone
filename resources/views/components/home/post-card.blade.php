@props(['listPost'])
@php
    $id = Auth::user()->id;
    $isUserLikePost = false;
@endphp
@foreach ($listPost as $key => $post)
    @php
        $post->time = App\util\DateUtil::formatTimestamp($post->created_at);
        if ($post->likes->count() != 0) {
            foreach ($post->likes as $like) {
                if ($like->user_id == $id) {
                    $isUserLikePost = true;
                }
                $post->isUserLikePost = $isUserLikePost;
            }
        }
        if (!Gate::allows('show-post', [$post, true, true])) {
            unset($listPost[$key]);
        }
    @endphp
    <section class="post flex flex-col " id="post_{{ $post->id }}">
        <header class="flex flex-row p-4 ">
            <a href="{{ route('profile', ['id' => $post->user_id]) }}">
                <img src="{{ $post->user->avatar }}" alt="Image" class="w-14 h-14 rounded-full">
            </a>
            <div class="self-center ml-4 mr-80">
                <h4>{{ $post->user->name }}</h4>
                <h5>{{ $post->time }}</h5>
            </div>
            @can('update', $post)
                <div class="self-center relative" id="post_option_{{ $post->id }}"
                    onclick="openOptionPost({{ $post->id }})">
                    <svg aria-label="Tùy chọn khác" class="_ab6- ml-12 " color="rgb(0, 0, 0)" fill="rgb(0, 0, 0)"
                        height="32" role="img" viewBox="0 0 24 24" width="32">
                        <circle cx="12" cy="12" r="1.5"></circle>
                        <circle cx="6" cy="12" r="1.5"></circle>
                        <circle cx="18" cy="12" r="1.5"></circle>
                    </svg>
                    <x-home.modal-option :postId="$post->id" />
                    <x-home.update-post-card :post="$post" :postId="$post->id" />
                </div>
            @endcan
        </header>
        <main class="mx-4 mb-2">
            <h4 class="mb-4">
                {{ $post->content }}
            </h4>
            @foreach ($post->files as $file)
                @if ($file->post_file != null)
                    <img src="{{ asset('storage/post/' . $file->post_file) }}" alt="" width="600px"
                        height="700px" class="rounded-xl">
                @endif
            @endforeach

        </main>
        <footer>
            <div class="flex flex-row ml-4 space-x-4 mt-2 text-center">
                @if ($post->isUserLikePost)
                    <svg aria-label="Thích" class="x1lliihq x1n2onr6" color="rgb(38, 38, 38)" fill="red"
                        height="24" role="img" viewBox="0 0 24 24" width="24"
                        x-on:click="handleLike({{ $post->id }}, {{ $post->likes->count() }})"
                        id="like_icon_svg_{{ $post->id }}">
                        <title>Thích</title>
                        <path
                            d="M16.792 3.904A4.989 4.989 0 0 1 21.5 9.122c0 3.072-2.652 4.959-5.197 7.222-2.512 2.243-3.865 3.469-4.303 3.752-.477-.309-2.143-1.823-4.303-3.752C5.141 14.072 2.5 12.167 2.5 9.122a4.989 4.989 0 0 1 4.708-5.218 4.21 4.21 0 0 1 3.675 1.941c.84 1.175.98 1.763 1.12 1.763s.278-.588 1.11-1.766a4.17 4.17 0 0 1 3.679-1.938m0-2a6.04 6.04 0 0 0-4.797 2.127 6.052 6.052 0 0 0-4.787-2.127A6.985 6.985 0 0 0 .5 9.122c0 3.61 2.55 5.827 5.015 7.97.283.246.569.494.853.747l1.027.918a44.998 44.998 0 0 0 3.518 3.018 2 2 0 0 0 2.174 0 45.263 45.263 0 0 0 3.626-3.115l.922-.824c.293-.26.59-.519.885-.774 2.334-2.025 4.98-4.32 4.98-7.94a6.985 6.985 0 0 0-6.708-7.218Z">
                        </path>
                    </svg>
                    <p class="ml-4" id="like_number_{{ $post->id }}">{{ $post->likes->count() ?? 0 }} Lượt
                        thích</p>
                @else
                    <svg aria-label="Thích" class="x1lliihq x1n2onr6" color="rgb(38, 38, 38)" fill="rgb(38, 38, 38)"
                        height="24" role="img" viewBox="0 0 24 24" width="24"
                        x-on:click="handleLike({{ $post->id }}, {{ $post->likes->count() }})"
                        id="like_icon_svg_{{ $post->id }}">
                        <title>Thích</title>
                        <path
                            d="M16.792 3.904A4.989 4.989 0 0 1 21.5 9.122c0 3.072-2.652 4.959-5.197 7.222-2.512 2.243-3.865 3.469-4.303 3.752-.477-.309-2.143-1.823-4.303-3.752C5.141 14.072 2.5 12.167 2.5 9.122a4.989 4.989 0 0 1 4.708-5.218 4.21 4.21 0 0 1 3.675 1.941c.84 1.175.98 1.763 1.12 1.763s.278-.588 1.11-1.766a4.17 4.17 0 0 1 3.679-1.938m0-2a6.04 6.04 0 0 0-4.797 2.127 6.052 6.052 0 0 0-4.787-2.127A6.985 6.985 0 0 0 .5 9.122c0 3.61 2.55 5.827 5.015 7.97.283.246.569.494.853.747l1.027.918a44.998 44.998 0 0 0 3.518 3.018 2 2 0 0 0 2.174 0 45.263 45.263 0 0 0 3.626-3.115l.922-.824c.293-.26.59-.519.885-.774 2.334-2.025 4.98-4.32 4.98-7.94a6.985 6.985 0 0 0-6.708-7.218Z">
                        </path>
                    </svg>
                    <p class="ml-4" id="like_number_{{ $post->id }}">{{ $post->likes->count() ?? 0 }}</p>
                @endif
                <svg aria-label="Bình luận" class="x1lliihq x1n2onr6" color="rgb(0, 0, 0)" fill="rgb(0, 0, 0)"
                    height="24" role="img" viewBox="0 0 24 24" width="24"
                    onclick="getComment({{ $post->id }})">
                    <title>Bình luận</title>
                    <path d="M20.656 17.008a9.993 9.993 0 1 0-3.59 3.615L22 22Z" fill="none" stroke="currentColor"
                        stroke-linejoin="round" stroke-width="2"></path>
                </svg>
                <p class="ml-4  " id="like_number_{{ $post->id }}">{{ $post->comments->count() ?? 0 }} </p>


            </div>
            <form>
                <div class="flex flex-row mt-4">
                    <textarea id="text_comment_{{ $post->id }}" rows="1"
                        class="block mx-4 p-2.5 w-9/12 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 resize-none"
                        placeholder="Bình luận của bạn ..." oninput="validFormComment1({{ $post->id }})"></textarea>
                    <button type="button" id="btn_send_comment_{{ $post->id }}"
                        class="
                        justify-center p-2 text-blue-600 rounded-full cursor-pointer hover:bg-blue-100
                        dark:text-blue-500 dark:hover:bg-gray-600 hidden"
                        onclick="createComment1({{ $post->id }})">
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
@endforeach

<script>
    function getComment(postId) {
        let modalPostDetail = document.getElementById('comment_modal')
        modalPostDetail.classList.remove('hidden')
        axios.get(`/post/${postId}/comment`)
            .then(function(response) {
                var data = response.data;
                showPostDetail(data.data);
            })
            .catch(function(error) {
                console.error('Lỗi khi lấy danh sách bài viết:', error);
            });
    }

    function showPostDetail(data) {
        let postComment = document.getElementById('post-comments');
        let postContent = document.getElementById('post-content');
        let headerImage = document.getElementById('header-image');
        let headerName = document.getElementById('header-name');
        const imagePost = document.getElementById('image_comment');
        var userId = {{ auth()->user()->id }};
        var url = '{{ asset('storage/post') }}'
        var urlAvatar = '{{ asset('storage/avatar') }}'
        imagePost.setAttribute('src', "")
        console.log(data[0])
        const pathImage = data[0].file.post_file;
        var urlImage = `${url}/${pathImage}`
        imagePost.setAttribute('src', urlImage)
        var htmlPost = `
                <div class="flex flex-row w-full px-2 py-4 ml-4">
                    <header class="flex flex-row space-x-4">
                        <img src= "${data[0].user.avatar}"
                            alt="" class="w-8 h-8 rounded-full">
                        <h3 class="">${data[0].user.name}</h3>
                    </header>
                </div>
                `;
        let htmlComments = "";
        for (key in data) {
            htmlComments += renderCommentList(data[key], userId, 1)
        }
        postContent.innerHTML = htmlPost;
        postComment.innerHTML = htmlComments;

    }

    function renderCommentList(comment, userId, levelComment) {
        let htmlComments = ``;
        if (userId == comment.user.id) {
            htmlComments += `
                <div class="flex flex-row space-x-4 mt-2 mb-4 bg-stone-200 rounded-lg" id="post_comment_${comment.id}" style=" margin-left: ${20 * levelComment}px;">
                    <img src="${comment.user.avatar}" alt="" class="w-8 h-8 item-center rounded-full">
                    <div class="flex flex-col pl-2 pr-4 w-full py-1 ">
                        <h1>${comment.user.name}</h1>
                        <h5>${comment.content}</h5>
                    </div>
                    <div class="self-center relative" id="comment_option_${comment.id}" onclick="openOptionComment(${comment.id})">
                        <svg aria-label="Tùy chọn khác" class="_ab6- ml-12 " color="rgb(0, 0, 0)" fill="rgb(0, 0, 0)" height="32"
                            role="img" viewBox="0 0 24 24" width="32">
                            <circle cx="12" cy="12" r="1.5"></circle>
                            <circle cx="6" cy="12" r="1.5"></circle>
                            <circle cx="18" cy="12" r="1.5"></circle>
                        </svg>
                        <div class="absolute top-6 right-5 w-96 bg-stone-100 rounded-lg hidden" id="modal-option-comment_${comment.id}">
                            <ol class="flex flex-col py-4 justify-center items-center">
                                <li class="hover:bg-stone-200 py-2 w-full text-center" onclick="handleDeleteComment(event,${comment.id})">Xoá
                                    bình luận</li>
                                <li class="hover:bg-stone-200 py-2 w-full text-center" onclick="closeOptionComment(event,${comment.id})">Huỷ
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div id="reply_comment" class= "hidden" style=" margin-left: ${20 * levelComment}px;">
                        <div class="relative">
                            <input type="text" id="btn_reply_comment"
                                class="block w-full p-2  text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="">
                            <button type="button"
                                class="text-white absolute right-0 bottom-0.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Gửi</button>
                        </div>
                </div>
                `;
        } else {
            htmlComments += `
                <div class="flex flex-row ml-4 space-x-4 mt-2 mb-4" >
                    <img src="${url}/${comment.user.avatar}" alt="" class="w-8 h-8 rounded-full">
                    <div class="flex flex-col pl-2 pr-4 w-full py-1 bg-stone-200 rounded-lg">
                        <h1>${comment.user.name}</h1>
                        <h5>${comment.content}</h5>
                    </div>
                </div>
                `;
        }
        levelComment += 1
        console.log(comment.level_comment);
        if (levelComment > getCommentSize(comment)) {
            return htmlComments;
        }
        for (const commentChild of comment.child) {
            htmlComments += renderCommentList(commentChild, userId, levelComment);
        }
        return htmlComments;
    }

    function getCommentSize(comment) {
        let size = 1;
        if (comment.child === undefined) {
            return size;
        }
        for (const commentChild of comment.child) {
            size += getCommentSize(commentChild);
        }
        return size;
    }
    


    function closePostDetail() {
        let modalPostDetail = document.getElementById('comment_modal')
        modalPostDetail.classList.add('hidden')
    }

    function handleLike(postID, initialLikeNumber) {
        let iconLikeDiv = document.getElementById(`like_icon_svg_${postID}`);
        let likeNumberElement = document.getElementById(`like_number_${postID}`);
        let likeNumber = parseInt(likeNumberElement.innerText[0])
        $.ajax({
            url: `/post/${postID}/like`,
            type: 'POST',
            success: function(response) {
                console.log(response);
                if (response.status === 'success') {
                    if (response.message === 'unlike') {
                        iconLikeDiv.setAttribute('fill', 'rgb(38, 38, 38)');
                        likeNumberElement.innerText = `${likeNumber - 1} lượt thích`;
                    } else {
                        iconLikeDiv.setAttribute('fill', 'red');
                        likeNumberElement.innerText = `${likeNumber + 1} lượt thích`;
                    }
                }
            },
        });
    }


    function createComment1(postId) {
        const textaraComment = document.getElementById(`text_comment_${postId}`);
        const valueComment = textaraComment.value;
        const btnSendComment = document.getElementById(`btn_send_comment_${postId}`)

        if (valueComment.length === 0 || valueComment.length > 235) {
            alert('Bình luận không hợp lệ!');
            return;
        }

        let data = {
            'content': valueComment,
            'post_id': postId,
        }
        $.ajax({
            url: `/post/${postId}/comment`,
            type: 'POST',
            data: data,
            success: function(response) {
                if (response.status == 'success') {
                    textaraComment.value = ""
                    btnSendComment.classList.add('hidden')
                    showAlertWithTimeout(response.message, 'success');
                } else {
                    alert(response.message);
                }
            },
            error: function(error) {
                console.error('Lỗi khi gửi bình luận:', error);
            },
        });
    }

    function validFormComment1(postId) {
        const btnSendComment = document.getElementById(`btn_send_comment_${postId}`)
        const textaraComment = document.getElementById(`text_comment_${postId}`)
        const valueComment = textaraComment.value;
        if (valueComment.length == 0 || valueComment.length > 235) {
            btnSendComment.classList.add('hidden')
        } else {
            btnSendComment.classList.remove('hidden')
        }
    }

    function openOptionPost(postId) {
        const modelOption = document.getElementById(`modal-option-post_${postId}`);
        console.log(postId)
        modelOption.classList.remove('hidden');
    }

    function closeOptionPost(event, postId) {
        const modelOption = document.getElementById(`modal-option-post_${postId}`)
        modelOption.classList.add('hidden')
        event.stopPropagation();
    }

    function updateOptionPost(event, postId) {
        const modalUpdatePost = document.getElementById(`update-post-modal_${postId}`)
        modalUpdatePost.classList.remove('hidden')
        const modelOption = document.getElementById(`modal-option-post_${postId}`)
        modelOption.classList.add('hidden');
        event.stopPropagation();
    }

    function deleteOptionPost(event, postId) {
        console.log('day la xoa')
        event.stopPropagation();
    }

    function openOptionComment(commentId) {
        const modelOption = document.getElementById(`modal-option-comment_${commentId}`);
        modelOption.classList.remove('hidden');
    }

    function closeOptionComment(event, commentId) {
        const modelOption = document.getElementById(`modal-option-comment_${commentId}`)
        modelOption.classList.add('hidden')
        event.stopPropagation();
    }

    function handleDeleteComment(event, commentId) {
        const popUp = document.getElementById('pop_up')
        const postComment = document.getElementById(`post_comment_${commentId}`)
        const modelOption = document.getElementById(`modal-option-comment_${commentId}`);
        console.log('hello')
        $.ajax({
            url: `post/${commentId}/comment/`,
            type: 'DELETE',
            success: function(response) {
                if (response.status == 'success') {
                    showAlertWithTimeout(response.message, 'success');
                    postComment.classList.add('hidden')
                    modelOption.classList.add('hidden');
                } else {
                    showAlertWithTimeout(response.message, 'error');
                }
            },
            error: function(error) {
                showAlertWithTimeout(response.message, 'error');
            },
        });
    }

    function handleDeletePost(event, postId) {
        const modelOption = document.getElementById(`modal-option-post_${postId}`)
        const post = document.getElementById(`post_${postId}`)
        modelOption.classList.add('hidden')
        event.stopPropagation();
        $.ajax({
            url: `/${postId}`,
            type: 'DELETE',
            success: function(response) {
                if (response.status === 'success') {
                    showAlertWithTimeout(response.message, 'success');
                    post.classList.add('hidden')

                } else {
                    showAlertWithTimeout(response.message, 'error');
                }
            },
            error: function(error) {
                showAlertWithTimeout(error, 'error');
            },
        });
    }
</script>
