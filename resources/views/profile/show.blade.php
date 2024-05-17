<x-app-layout>
    <div onclick="removeModal()"  id="modal" class="hidden bg-black/50 absolute inset-0 z-50 items-center justify-center">
        <div class="lg:h-[360px] lg:w-[680px] h-[330px] w-[620px]  bg-white relative overflow-hidden">
            {{--<div class="absolute top-3 right-3 ">
                 <button 
                onclick="removeModal()"
                type="button">
                    <img src="{{ asset('images/plus.png') }}" alt="" class="h-6 w-6 rotate-45 rounded-full ring-2 ring-neutral-200 p-1">
                </button> 
            </div>--}}

            <div id="info" class="grid grid-cols-5 ">
                
            </div>

        </div>
    </div>
    <div class="py-12 pt-24">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <div class="grid grid-flow-col grid-cols-12  items-center ">
                    <div class="col-span-3 mx-auto ">
                        <img src="{{ $user->profile->image ? asset('storage/' . $user->profile->image) : asset('images/user-placeholder.png') }}" alt="No Image" class="h-32 w-32 rounded-full object-center object-contain">
                    </div>
                    <div class="col-span-9">
                        <div class="flex flex-col  gap-y-2">
                            <div class="flex items-center gap-x-4">
                                <h2 class="text-2xl mb-1">{{ $user->username }}</h2>
                                @cannot('update', $user->profile)
                                <div id="main">
                                    <follow-button
                                       :user-id="{{ $user->id }}"
                                        :follows="{{ $following }}"
                                    ></follow-button>                                
                                </div>
                                @endcannot
                                
                                @can('update', $user->profile)
                                <a href="{{ route('profiles.edit', $user->profile) }}" class="inline-flex items-center rounded-md font-semibold text-neutral-400 hover:bg-gray-200 hover:text-gray-800 transition  px-2 py-[2px] text-sm text-center">
                                    <img src="{{ asset('images/edit.png') }}" alt="" class="h-4 w-4 mr-2"> Edit
                                </a>
                                <a href="{{ route('post.create') }}" class="bg-white rounded-md font-semibold text-black border-2  hover:bg-gray-200 transition px-2 py-[2px] text-sm text-center inline-flex items-center ml-auto">
                                    <span class="mr-1 text-[16px]">+</span>Add New Post
                                </a> 
                                @endcan
                                

                            </div>

                            <div class="flex items-center gap-x-6">
                                <div>
                                    <p class="font-medium">
                                        <span class="font-semibold">{{ $postCount }}</span>
                                        posts
                                    </p>
                                </div>
                                <div>
                                    <p class="font-medium">
                                        <span class="font-semibold">{{ $followersCount}}</span>
                                        followers
                                    </p>
                                </div>
                                <div>
                                    <p class="font-medium">
                                        <span class="font-semibold">{{ $followingCount }}</span>
                                        following
                                    </p>
                                </div>
                            </div>

                            <div>
                                <div>
                                    <a href="#" class="text-gray-800 font-bold tracking-tight">{{ $user->profile->title  }}</a>
                                </div>
                                <p class="">
                                    {{ $user->profile->description  }}
                                </p>
                                <div>
                                    <a href="#" class="text-blue-900 font-bold tracking-tight">{{ $user->profile->url ?? 'N/A' }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-10 w-full border-t flex items-center justify-center  gap-x-4">
                    <a href="#" class="uppercase font-bold py-4 text-xs inline-flex items-center">
                       <img src="{{ asset('images/pixels.png') }}" alt="grid" class="h-4 w-4 mr-2"> Posts</a>
                    <a href="#" class="uppercase font-bold py-4 text-xs inline-flex items-center">
                        <img src="{{ asset('images/social-media.png') }}" alt="tagged user" class="h-5 w-5 mr-2">Tagged</a>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4 px-4 md:px-0">
                    @foreach ($user->posts as $post)
                        <div >
                            <button 
                            id="modal_btn"
                            onclick="showModal({{ json_encode($post) }}, {{ json_encode($post->user) }})"
                            value="{{ $post->id }}"
                            type="link">
                                <img src="/storage/{{ $post->image }}" alt="" class="h-full w-full aspect-square object-cover object-center" >
                            </button>
                        <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
                            <img src="/storage/{{ $post->image }}" alt="" class="h-full w-full aspect-square object-cover object-center" >
                        </x-modal>
                        </div>
                    @endforeach
                    
                </div>
            </div>
        </div>
    </div>
    {{-- @section("script") --}}
        <script>
            const modal_btn = document.getElementById("modal_btn");
            const modal = document.getElementById("modal");
            const infoDiv = document.getElementById("info");

            function showModal(post, user) {
                infoDiv.innerHTML += 
                `
                <div class="col-span-3">
                    <img src="/storage/${post.image}" alt="image" class="relative   object-contain">
                </div>
                <div class="px-4 col-span-2 flex flex-col ">
                    
                    <div class="flex items-center gap-x-3 border-b py-4  border-neutral-100">
                        <img src="{{ asset('logo/freecodecamp-green.svg') }}" alt="" class="h-8 w-8 rounded-full">
                        <p class="text-sm font-semibold">${user.username}</p>
                        <button class="text-xs font-semibold text-sky-500">Follow</button>
                    </div>

                    <div class="flex-1 py-2">
                        <p class="text-sm tracking-tight text-gray-950">
                            <span class="text-sm font-semibold">${user.username}</span>
                            ${post.caption}
                        </p>
                    </div>

                    <div class="w-full sticky bottom-0 ">
                        <div class="flex flex-col gap-y-1 border-y border-neutral-100  py-2">
                            <div class="flex items-center gap-x-2 relative w-full">
                                <button type="button">
                                    <img src="{{ asset('images/heart.png') }}" alt="" class="w-6 h-6 shrink-0">
                                </button>
                                <button type="button">
                                    <img src="{{ asset('images/chat.png') }}" alt="" class="w-7 h-7 shrink-0">
                                </button>
                                <button type="button">
                                    <img src="{{ asset('images/share.png') }}" alt="" class="w-7 h-7 shrink-0">
                                </button>
                                <button type="button" class="justify-end ">
                                    <img src="{{ asset('images/bookmark.png') }}" alt="" class="w-7 h-7 shrink-0">
                                </button>
                            </div>
                            <div>
                                <p class="font-semibold text-sm">828 likes</p>
                            </div>
                            <div>
                                <p class="text-[10px] uppercase text-neutral-400/80">4 Days Ago</p>
                            </div>
                        </div>
                        <div class="py-3">
                            <p class="flex items-center text-sm text-gray-400">
                                <a href="{{ route('login') }}" class="font-medium text-gray-950 mr-1">Log in </a> to like or comment
                            </p>
                        </div>
                    </div>
                </div>
                `
                modal.classList.remove("hidden");
                modal.classList.add("flex");
            }
            function removeModal() {
                modal.classList.remove("flex");
                modal.classList.add("hidden");
                infoDiv.innerHTML = "";
            }
        </script>
    {{-- @endsection --}}
</x-app-layout>
