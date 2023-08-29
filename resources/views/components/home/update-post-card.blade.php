@props(['post','postId'])
<div id="update-post-modal_{{$postId}}" tabindex="-1" aria-hidden="true"
    class="fixed top-0 left-0 right-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full flex justify-center items-center flex-col hidden">
    <form action="{{ route('update_post', ['id' => $post->id]) }}" method="POST"
        class="w-8/12 h-5/6 flex flex-col bg-slate-100 rounded-xl z-20">
        @csrf
        @method('PUT')
        <header class="flex flex-row items-center justify-between">
            <svg aria-label="Đóng" class="x1lliihq x1n2onr6 ml-4" color="rgb(174,174,174)" fill="rgb(174,174,174)"
                height="18" role="img" viewBox="0 0 24 24" width="18" onclick="closeModalUpdatePost({{$postId}})">
                <title>Đóng</title>
                <polyline fill="none" points="20.643 3.357 12 12 3.353 20.647" stroke="currentColor"
                    stroke-linecap="round" stroke-linejoin="round" stroke-width="3"></polyline>
                <line fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="3" x1="20.649" x2="3.354" y1="20.649" y2="3.354"></line>
            </svg>
            <h1 class="flex-grow text-center py-4">Sửa bài viết</h1>
            <button class="rounded-xl text-stone-400 mr-8" id="btn-update_post_{{$postId}}" disabled>Chia sẻ</button>
        </header>
        <main class="flex flex-row h-full " style="height:calc(100% - 56px)">
            @foreach ($post->files as $file)
                @if ($file->post_file != null)
                    <img src="{{ asset('storage/post/' . $file->post_file) }}" alt=""
                        class="rounded-bl-xl w-7/12" id="form-image">
                @endif
            @endforeach

            <section class="flex flex-col">
                <div class="flex flex-row w-full px-2 py-4 ml-4">
                    <header class="flex flex-row space-x-4">
                        <img src="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAoHCBYWFRYWFBUZGRYWGhoaHRwZGBwaGhgYGR4cHBkZHBodIC4lHB8rHxgcJjgoKy8xNTZDHCQ7QDs0PzA0NTEBDAwMEA8QHxISHzQsJSsxMT8/PzU0NjQ0NT80NDQ0NDE0NjQ0NDQ0NDY2NDQxNj0xMT81NDQ0NDQ2MTQ2NDE0NP/AABEIAOEA4QMBIgACEQEDEQH/xAAcAAEAAQUBAQAAAAAAAAAAAAAABQIDBAYHAQj/xABGEAACAQMCAgYHBAkACAcAAAABAgADBBESIQUxBkFRYXGBBxMiMkKRoRQjUnIzYoKSorHB0fBDk7KzwtLh8RUkNERjc6T/xAAaAQEAAwEBAQAAAAAAAAAAAAAAAQIDBAUG/8QAKxEBAQACAQMCBgIBBQAAAAAAAAECEQMSITEEQQUiUWFx0ROxgTNCkaHB/9oADAMBAAIRAxEAPwDs0REBERAREQEREBERAREQEREBERAREQEREBERAREQEREBERAREQEREBERAREQEREDyUVKgUEsQANyScADtJPKQPSnpTSs0GfbqsDopg4J72Pwr3/IGcc470guLts13JXOQi7U18F6z3nJ75S5SLTG11fifpBsqWQrtVYdVIah++SFPkTNduPSqc/d2ox2tV3/AHQv9ZzYAdZA8c/2lTJtnP8Ab5/3mdzrSYRv6+lOtne3p4/Ow+uJIWXpTpnatbunfTdX88MF/rOW6seUK4bceY/qI68joj6E4Nx63ulLUKgbHMbq6+KnBHjykrPm22u3pOr03ZHXkynB7/EHrHIzpPQz0hGo60LsrqYhUqAacseSuvIEnkRgchjrl8c9+VMsNeHSoiJooREQEREBERAREQEREBERAREQEREBERAShjscDPdK54TA+buIcQq1a9R7glaxdtQPwFTjQB1Bcacd0xmrr1bGTnBejf264rPTJS2FRzrO7FSxZVXPNtJByeWd89fQLToTZJjFDWe2ozPnxBOn5Cc2WUldOONscdat/n+dUs+sxuDjz2ndD0VtD/7Wj/q1+vbMm14LQp707ekh7VpqD8wMyvV9luj7uJW3B7msNVO3qMPxBG0nwYjHyMtXnDa9HerRqIO1kYLv+tjB+c7+wlDqCCCMgjBB5Hxkdaf4/u+eXckymb90y6KIqNcW66NG7oPdK9bqPhxzIG2M+ehBZpLLGeWNxuq7L6MelrXKG3rnNakoKsTvVpjbJ7WUkAnryDzzOhT5p4FxBra4pV1z924LAfEp2dfNSw+U+k0YEAg5BGQe0GbY3cY5TVVxESypERAREQEREBERAREQEREBERAREQPJB9M7s0rG6dThhScKexmGlT82EnJqnpNQtw6uq82aiv71amP6yL4TPLG6HWYpWlBAMewGP5nGpvqTJ8LInhlZURdTBQp05YgDkMc5LUayN7rq35WB/lOSd3Zl8t0qxKSJcMxL29p0l11HVF5ZY437O+TpWVVUltuU1LiPpEtVOmmlSoeogBVPhqOr+GYVt0qvnbIsjoIOwSpnuOrHPylbKvLGyOAwKtuGBBHaDsZx02hUkHqOPltOr21wXGSjoetXUqwPgf5zVuOcFCNrTJRyefNWO+M9YMY3S/Jj1SWNTFvO+9FapaztiefqkB7yqgH6icbW2nXuhf8A6Kh3Bh8mYTbjvdy8uOonoiJuwIiICIiAiIgIiICIiAiIgIiICIiB5InpPaNUtayqNT6dSr+J6ZDovmygSWmFxG/Wiut8nJChVBZndjhVUDmT8huSQATIvhM8ub3vRW3qJ9prVnfWqspyAgVgCioo35EdZznM1hOHWyv91UrIyrr1Gm2FTIXXq0qQmogauW/OdC4fZmtbBCrIFesgVgupUSq6qpxkA6ABtkRxLonTuKq1aq4KqFwmAp053OQTnBxseoTldl76uop6O62TS7+sI3D4wSpG2dznlz75h9KOGJVZFdm0pk4BABJxz2mzW1kqOxUYJGWxyyewch5ASyFBc5APPGRn/OUzvZrLL/w0peHNTSq9nRpn1KFmYhmY4BOkHmTtyz/ae9HuOXDtjIKgU9WlGUKzhiVILt7IKEasb5HLM36lYpzCICSeSjn2wlgi4AUADkAAAPADaX128M+r5vPb6Md11pyweruMguIU9VN18/kczaisgbxMMw8fr/3lL2a43fZrNtw9nOEXJ/ztm3cK4yLalTp1qToikguTTKrqYkMwDlwu+7aduZwATMfg1MLqJ2A/mdh/WZ4p03pMXAKurFieoYOR5DaXwysu4z5cJZqtpiRfRssbS2NTPrDQpa889WhdWe/OZKTscBERAREQEREBERAREQEREBERAREQEhuk9matrVVRlwpen3VUGumf3gM9oyOuTE8J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"
                            alt="" class="w-8 h-8 rounded-full">
                        <h1 class="">{{ $post->user->name }}</h1>
                    </header>
                </div>
                <textarea
                    class=" h-full w-80 ml-4  no-resize appearance-none block bg-slate-100 text-gray-700 border border-slate-100 rounded py-3 px-4 mb-3 leading-tight resize-none focus:outline-none "
                    placeholder="Viết chú thích ..." name="content_upload" oninput="checkContentLengthForUpdate(event,{{$postId}})">{{ $post->content }}</textarea>
            </section>
        </main>
        <textarea name="version" class="hidden">{{$post->version}}</textarea>
    </form>
</div>
<script>
    function handleBtnOnClick() {
        const selectFileBtn = document.getElementById('selectFileBtn');
        const postFileInput = document.getElementById('postFileInput');
        selectFileBtn.click();
    }

    function checkContentLengthForUpdate(event,postId) {
        const textarea = document.querySelector('textarea[name="content_upload"]');
        const btnUpLoad1 = document.getElementById(`btn-update_post_${postId}`)
        let content = textarea.value;
        const wordCount = content.length;
        if (wordCount > 235) {
            btnUpLoad1.classList.add('text-stone-400')
            btnUpLoad1.classList.remove('text-cyan-500')
            btnUpLoad1.disabled = true;
        } else {
            btnUpLoad1.classList.remove('text-stone-400')
            btnUpLoad1.classList.add('text-cyan-500')
            btnUpLoad1.disabled = false;
        }
    }

    function closeModalUpdatePost(postId) {
        const modalUpdatePost = document.getElementById(`update-post-modal_${postId}`)
        modalUpdatePost.classList.add('hidden')
    }
</script>
