<x-app-layout>
    <div class="py-12 pt-24">
        <div class="max-w-[30rem] lg:max-w-2xl mx-auto px-6  ">
            <div class="overflow-auto ">
    
                <div id="info" class="relative grid grid-cols-1 lg:grid-cols-3 px-4 lg:px-0 ">
                    
                    <div class="flex flex-col col-span-2 gap-y-2 ">
                        @foreach ($posts as $post )
                        <div class="flex flex-col gap-y-2 pb-4">

                            <div class="flex flex-col gap-y-2 py-1">
                                <div class="flex items-center gap-x-3  border-neutral-100">
                                    <a href="{{ route('profile.show', $post->user) }}">
                                        <img src="{{ $post->user->profile->image ? asset('storage/' . $post->user->profile->image) : asset('images/user-placeholder.png') }}" alt="" class="h-8 w-8 rounded-full">
                                    </a>
                                    <a href="{{ route('profile.show', $post->user) }}">
                                        <p class="text-sm font-semibold">{{$post->user->username}}</p>
                                    </a>
                                    <button class="text-xs font-semibold text-sky-500 mt-1">Follow</button>
                                </div>
        
                                <div>
                                    <p class="text-[10px] uppercase text-neutral-400/80">4 Days Ago</p>
                                </div>
                            </div>

                            <div class="min-h-[520px]">
                                <img src="/storage/{{ $post->image }}" alt="image" class="h-full object-contain rounded-[4px] border ">
                            </div>
                            
                            <div class=" flex flex-col gap-y-2">
        
                                <div class="flex flex-col ">
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
                                        <button type="button" class="justify-end ml-auto ">
                                            <img src="{{ asset('images/bookmark.png') }}" alt="" class="w-7 h-7 shrink-0">
                                        </button>
                                    </div>

                                    <div class="mt-1">
                                        <p class="font-semibold text-sm">828 likes</p>
                                    </div>

                                    <div class="flex-1 ">
                                        <p class="text-sm tracking-tight text-gray-950">
                                            <span class="text-sm font-semibold">{{$post->user->username}}</span>
                                            {{$post->caption}}
                                        </p>
                                    </div>
                                    
                                </div>

                            </div>

                            <div class="border-b-[1px] pt-4 "></div>
                        </div> 
                        @endforeach
                    </div>
                    
                    <div class="hidden lg:block col-span-1 ml-auto">
                        <div class="flex items-center gap-x-3 border-neutral-100">
                            
                            <a href="{{ route('profile.show', auth()->user()) }}">
                                <img src="{{ auth()->user()->profile->image ? asset('storage/' . auth()->user()->profile->image) : asset('images/user-placeholder.png') }}" alt="" class="h-10 w-10 rounded-full">
                            </a>
                            <a href="{{ route('profile.show', auth()->user()) }}">
                                <p class="text-sm font-semibold">{{auth()->user()->username}}</p>
                            </a>
                           
                           
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="text-xs font-semibold text-sky-500 mt-1">
                                    {{ __('Log Out') }}
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
                <div class="mx-auto flex items-center  absolute bottom-3 ">
                    {{ $posts->links() }}
                </div>
            </div>
    
        </div>
    </div>
</x-app-layout>
