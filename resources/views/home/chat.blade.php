<x-app-layout>
    <div class="container mx-auto shadow-lg rounded-lg absolute top-0 h-screen " style="width: 1140px;left:295px"
        id="container">
        <div class="flex flex-row justify-between h-full bg-slate-50 bottom-2 ">
            <div class="flex flex-col w-2/5 border-r-2 overflow-y-auto">
                <div class="border-b-2 py-4 px-2 flex flex-row">
                    <input type="text" placeholder="search chatting"
                        class="py-2 px-2 border-2 border-gray-200 rounded-2xl w-full" id="input_seach_chat" />
                    <button class="ml-4 bg-slate-300 rounded-md mr-4 px-2" onclick="handleSendBtn()">Gửi</button>
                </div>
                <div id="container_list_user_chat">
                    @foreach ($listUser as $user)
                        <div class="flex flex-row py-4 px-2 justify-center items-center border-b-2"
                            id="{{ 'user-chat-' . $user->id }}"
                            onclick="handleClickChatDetail({{ $user->id }}, '{!! $user->avatar !!}','{!! $user->name !!}')">
                            <div class="w-1/4">
                                <img src="{{ $user->avatar }}" class="object-cover h-12 w-12 rounded-full"
                                    alt="" />
                            </div>
                            <div class="w-full">
                                <div class="text-lg font-semibold">{{ $user->name }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
            <div class="w-full px-5 flex flex-col justify-between">
                <div class="flex flex-col mt-5" id="chat-list" style="overflow: scroll;">
                </div>
                <div class="py-5 flex flex-row relative">
                    <input class="w-full bg-gray-300 py-5 px-3 rounded-xl mr-4" type="text"
                        placeholder="type your message here..." oninput="validFormChat()" id="input-chat" />
                    <svg xmlns="http://www.w3.org/2000/svg" height="2em" viewBox="0 0 512 512"
                        class="absolute top-8 right-10 hidden" id="btn-send-chat" onclick="handleBtnChat()">
                        <path
                            d="M307 34.8c-11.5 5.1-19 16.6-19 29.2v64H176C78.8 128 0 206.8 0 304C0 417.3 81.5 467.9 100.2 478.1c2.5 1.4 5.3 1.9 8.1 1.9c10.9 0 19.7-8.9 19.7-19.7c0-7.5-4.3-14.4-9.8-19.5C108.8 431.9 96 414.4 96 384c0-53 43-96 96-96h96v64c0 12.6 7.4 24.1 19 29.2s25 3 34.4-5.4l160-144c6.7-6.1 10.6-14.7 10.6-23.8s-3.8-17.7-10.6-23.8l-160-144c-9.4-8.5-22.9-10.6-34.4-5.4z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.socket.io/4.6.0/socket.io.min.js"
        integrity="sha384-c79GN5VsunZvi+Q/WObgk2in0CbZsHnjEqvFxC5DxHn9lTfNce2WW6h2pH6u/kF+" crossorigin="anonymous">
    </script>
    <script>
        const socket = io('http://localhost:3002')
        console.log(socket)
        let currentReceiver = null
        let avatarUserReceiver = null
        let nameUserReceiver = null

        function handleBtnChat() {
            const btnSearch = document.getElementById("btn-send-chat");
            const textSearch = document.getElementById("input-chat");
            var valueSearch = textSearch.value;
            textSearch.value = "";
            sendMessage(valueSearch);
        }

        function sendMessage(valueSearch) {
            const user = {!! Auth::user() !!}
            const receiver = currentReceiver;
            socket.emit('on-chat', {
                'message': valueSearch,
                'sender': user.id,
                'receiver': receiver,
                'room': createRoomName(user.id, receiver)
            });
        }
        socket.on('chat-user', (data) => {
            const roomString = data.room
            const roomArray = roomString.split(":")[1].split("_");
            var userLogin = {!! Auth::user() !!}
            let html =``
            if (roomArray.includes(`${userLogin.id}`)) {
                const user = data.user
                const message = data.message
                const listChat = document.getElementById('chat-list')
                if (data.sender === userLogin.id) {
                    html += `
                    <div class="flex justify-end mb-4">
                        <div class="mr-2 py-3 px-4 bg-blue-400 rounded-bl-3xl rounded-tl-3xl rounded-tr-xl text-white">
                            ${message}
                        </div>
                        <img src="${userLogin.avatar}"
                            class="object-cover h-8 w-8 rounded-full" alt="" />
                    </div>
                 `
                } else {
                    html += `
                <div class="flex justify-start mb-4">
                    <img src="${avatarUserReceiver}"
                        class="object-cover h-8 w-8 rounded-full" alt="" />
                    <div class="ml-2 py-3 px-4 bg-gray-400 rounded-br-3xl rounded-tr-3xl rounded-tl-xl text-white">
                        ${message}
                    </div>
                </div>
                 `
                }
                listChat.insertAdjacentHTML('beforeend', html)
                if (data.sender === userLogin.id) {
                    insertMessageToDB(message, data.sender, data.receiver)
                }
            }

        })

        function createRoomName(userSend, userReceiver) {
            return `room:${Math.min(userSend, userReceiver)}_${Math.max(userSend, userReceiver)}`
        }

        function insertMessageToDB(message, userSendId, userReceiverId) {
            $.ajax({
                url: `/chat/chat`,
                type: 'Post',
                data: {
                    'message': message,
                    'sender_id': userSendId,
                    'receiver_id': userReceiverId,
                },
                success: function(response) {},
                error: function(error) {
                    console.log(error)
                },
            });
        }

        function validFormChat() {
            const textSearch = document.getElementById("input-chat");
            const btnSearch = document.getElementById("btn-send-chat");
            var valueSearch = textSearch.value;
            if (valueSearch != 0) {
                btnSearch.classList.remove("hidden");
            }
        }

        function handleClickChatDetail(receiverId, avatarUserReceiver, nameUserReceiver2) {
            var html = ``
            var userLogin = {!! Auth::user() !!}
            const listChat = document.getElementById('chat-list')
            const btnSendChat = document.getElementById(`btn-send-chat`)
            nameUserReceiver = nameUserReceiver2
            listChat.innerHTML = ""
            $.ajax({
                url: `chat/detail/${receiverId}`,
                type: 'get',
                success: function(response) {
                    html += `<h1 style=" text-align: center; margin-bottom: 40px;"> ${nameUserReceiver2} </h1>`
                    response.data.forEach(message => {
                        if (message.sender_id === userLogin.id) {
                            html += `
                    <div class="flex justify-end mb-4">
                        <div class="mr-2 py-3 px-4 bg-blue-400 rounded-bl-3xl rounded-tl-3xl rounded-tr-xl text-white">
                            ${message.message}
                        </div>
                        <img src="${message.avatar}"
                            class="object-cover h-8 w-8 rounded-full" alt="" />
                    </div>
                 `
                        } else {
                            html += `
                <div class="flex justify-start mb-4">
                    <img src="${message.avatar}"
                        class="object-cover h-8 w-8 rounded-full" alt="" />
                    <div class="ml-2 py-3 px-4 bg-gray-400 rounded-br-3xl rounded-tr-3xl rounded-tl-xl text-white">
                        ${message.message}
                    </div>
                </div>
                 `
                        }

                    });
                    listChat.insertAdjacentHTML('beforeend', html)
                    avatarUserReceiver = avatarUserReceiver
                    currentReceiver = receiverId
                },

                error: function(error) {
                    console.log(error)
                },
            });
        }

        function handleSendBtn() {
            const valueSearch = document.getElementById('input_seach_chat').value
            $.ajax({
                url: `/user/${valueSearch}`,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    renderSearchUserChat(response.data)
                },
                error: function(error) {
                    console.error('Lỗi khi gọi Ajax:', error);
                }
            });
        }

        function renderSearchUserChat(users) {
            var html = ``;
            var listUserChat = document.getElementById('container_list_user_chat')
            if (users.length != 0) {
                users.forEach(user => {
                    html += `
                    <div class="flex flex-row py-4 px-2 justify-center items-center border-b-2"
                            id="user-chat-${user . id}" onclick="handleClickChatDetail(${user . id},'${user.avatar}',${nameUserReceiver} )">
                            <div class="w-1/4">
                                <img src="${user . avatar} " class="object-cover h-12 w-12 rounded-full"
                                    alt="" />
                            </div>
                            <div class="w-full">
                                <div class="text-lg font-semibold">${user . name} </div>
                            </div>
                    </div>
            `
                });
            }
            listUserChat.innerHTML = html
        }
    </script>


</x-app-layout>
