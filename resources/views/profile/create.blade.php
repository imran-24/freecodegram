<x-app-layout>
    <div class="py-12 pt-24">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <h2 class="text-xl py-4 border-b">Edit Profile</h2>
                <form action="{{ route('profiles.store') }}" method="POST" >
                    @csrf
                    <div class="my-8  pl-4">
                        <!-- Name -->
                        <div>
                            <x-input-label for="username" :value="__('Username')" />
                            <x-text-input id="username" class="block mt-1 w-1/2" type="text" name="username" value="{{ auth()->user()->username }}" required autofocus autocomplete="username" />
                            <x-input-error :messages="$errors->get('username')" class="mt-2" />
                        </div>
    
                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input id="title" class="block mt-1 w-1/2" type="text" name="title" :value="old('title')" required autocomplete="username" />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>
    
                        <div class="mt-4 mr-2">
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description" rows="4" class="block mt-1 w-full ring-gray-200  focus:border-0 focus:ring-2  focus:ring-sky-500 rounded-md border-0 outline-0 ring-2" type="text" name="description" required autofocus autocomplete="description"></textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>
    
                        <div class="mt-4">
                            <x-input-label for="url" :value="__('Links')" />
                            <x-text-input id="url" class="block mt-1 w-1/2" type="text" name="url" :value="old('url')" required autofocus autocomplete="url" />
                            <x-input-error :messages="$errors->get('url')" class="mt-2" />
                        </div>
                    </div>
                    <div class="flex items-center justify-end">
                        <button type="submit"  class="mt-2 bg-sky-500 text-white px-2 h-8 rounded-md text-sm font-semibold border hover:bg-sky-600">
                            {{ __('Create Profile') }}
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
