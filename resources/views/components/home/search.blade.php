<div id="search_modal" tabindex="-1" aria-hidden="true"
    class="fixed top-0 left-0 right-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full flex justify-center items-center flex-col hidden">
    <div class="overlay fixed w-full h-full bg-stone-400 opacity-40 z-10" id="overplay_search_modal"
        onclick="closeSearchModal()"></div>
    <section class="w-4/12 h-5/6 flex flex-col bg-slate-100 rounded-xl z-20">
        <div class="relative mx-10 mt-8 mb-4">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
            </div>
            <input type="search" id="search_user" oninput="validFormSearch()"
                class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Search ..." required>
            <button type="submit" id="btn_search" onclick="handleBtnSearch()"
                class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 hidden">Search</button>
        </div>
        <div style="overflow: scroll" id="list_user_search">
        </div>
    </section>
</div>
<script>
    function handleBtnSearch() {
        const btnSearch = document.getElementById('btn_search')
        const textSearch = document.getElementById('search_user')
        var valueSearch = textSearch.value
        getUserByName(valueSearch)
    }

    function getUserByName(valueSearch) {
        $(document).ready(function() {
            $.ajax({
                url: `/user/${valueSearch}`,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    renderListUser(response.data)
                },
                error: function(error) {
                    console.error('Lỗi khi gọi Ajax:', error);
                }
            });
        });
    }

    function renderListUser(users) {
        const listUserSearch = document.getElementById('list_user_search')
        const url = '{{ asset('storage/avatar') }}'
        var html = ``;
        if (users.length != 0) {
            users.forEach(user => {
                html += `
                <a href="/profile/${user.id}">
                    <header class="flex flex-row space-x-4 p-4 items-center ml-4">
                        <img src="${user.avatar}"
                            alt="Image" class="w-12 h-12 rounded-full">
                        <h1 class="">${user.name}</h1>
                    </header>
                </a>
            `
            });
        } else {
            html = `
            <h1 class="text-center">Không có người dùng</h1>
            `
        }
        listUserSearch.innerHTML = html

    }

    function validFormSearch() {
        const textSearch = document.getElementById('search_user')
        const btnSearch = document.getElementById('btn_search')
        var valueSearch = textSearch.value
        if (valueSearch != 0) {
            btnSearch.classList.remove('hidden');
        }
    }

    function closeSearchModal() {
        const searchModal = document.getElementById('search_modal')
        searchModal.classList.add('hidden')
        console.log('hello');
    }

    function openSearchModal() {
        const searchModal = document.getElementById('search_modal')
        searchModal.classList.remove('hidden')
    }
</script>
