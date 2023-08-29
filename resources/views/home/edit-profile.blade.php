<x-app-layout>

    <div class="h-full">
        <form action="{{ route('profile_update') }}" method="POST" class="border-b-2 block md:flex"
            id="update_profile_form" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="w-full md:w-2/5 p-4 sm:p-6 lg:p-8 bg-white shadow-md">
                <div class="flex justify-between">
                    <span class="text-xl font-semibold block">Profile</span>
                    <button type="submit"
                        class="-mt-2 text-md font-bold text-white bg-gray-700 rounded-full px-5 py-2 hover:bg-gray-800">Edit</button>
                </div>
                <div class="w-full p-8 mx-2 flex justify-center relative">
                    @if ($user->avatar == '')
                        <img id="showImage" class="max-w-xs w-32 items-center border avatar_null"
                            src="https://png.pngtree.com/png-vector/20191026/ourlarge/pngtree-avatar-vector-icon-white-background-png-image_1870181.jpg"
                            alt="" onclick="setImageUpdateProfile()">
                    @else
                        <img id="showImage" class="max-w-xs w-32 items-center border" src="{{ $user->avatar }}"
                            alt="" onclick="setImageUpdateProfile()">
                        <button class="absolute top-0 right-0" onclick="handleCancleImage(event)">x</button>
                    @endif
                </div>
            </div>
            <input type="file" accept="image/*" name="avatar" id="update_pofile-avatar" class="hidden"
                onchange="handleInputImage(event)">
            <div class="w-full md:w-3/5 p-8 bg-white lg:ml-4 shadow-md">
                <div class="rounded  shadow p-6">
                    <div class="pb-6">
                        <label for="name" class="font-semibold text-gray-700 block pb-1">Name</label>
                        <div class="flex">
                            <input type="text" name="name" class="border-1  rounded-r px-4 py-2 w-full"
                                type="text" value="{{ $user->name }}" />
                        </div>
                    </div>
                    <div class="pb-4">
                        <label for="about" class="font-semibold text-gray-700 block pb-1">Email</label>
                        <input type="text" name="email" class="border-1  rounded-r px-4 py-2 w-full" type="email"
                            value="{{ $user->email }}" />
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script>
        $("#update_profile_form").validate({
            onfocusout: false,
            onkeyup: false,
            onclick: false,
            rules: {
                "email": {
                    required: true,
                    email: true,
                },
                "name": {
                    required: true,
                    minlength: 8
                },
                "avatar": {
                    extension: "png",
                    filesize: 1048576,
                }
            }
        });


        function setImageUpdateProfile() {
            const avatar = document.getElementById("showImage")
            const inputFile = document.getElementById("update_pofile-avatar")
            if (avatar.classList.contains('avatar_null')) {
                inputFile.click();
            }
        }

        function handleInputImage(event) {
            const image = document.getElementById('showImage')
            const file = event.target.files[0];
            if (file != null) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    image.setAttribute('src', event.target.result);
                };
                reader.readAsDataURL(file);
            }
        }

        function handleCancleImage(event) {
            event.preventDefault()
            const avatar = document.getElementById("showImage")
            avatar.src =
                "https://png.pngtree.com/png-vector/20191026/ourlarge/pngtree-avatar-vector-icon-white-background-png-image_1870181.jpg";
            avatar.classList.add('avatar_null')
        }
    </script>
</x-app-layout>
