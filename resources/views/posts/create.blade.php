<x-app-layout>
    <div class="py-12 pt-24">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="rounded bg-neutral-50 border relative ">
                {{-- <button class="bg-white rounded-md font-semibold text-gray-400 absolute top-3 left-3   hover:bg-gray-200 transition px-2 py-[2px] text-sm text-center inline-flex items-center ml-auto">
                    <span class="mr-1 text-[16px]"><</span>Back
                </button> --}}
                    <form method="POST" action="{{ route('post.store') }}" class=" w-full" enctype="multipart/form-data">
                    @csrf

                    {{-- Image --}}
                    <div class="grid grid-cols-2 min-h-72 px-6">
                        <div class="pt-4">
                            <x-input-label for="image" :value="__('Upload image')" />
                            <input  type="file" class="" id="image" name="image" />
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                        </div>
        
                        <!-- Caption -->
                        <div class="border-l w-full p-4">
                            <textarea rows="10" id="caption" class="block mt-1 p-0  border placeholder:text-neutral-400 placeholder:font-normal text-neutral-500  bg-transparent text-sm  w-full border-none resize-none focus-visible:ring-0 focus-visible:border-0 focus-visible:outline-none "   type="text" name="caption" :value="old('caption')" placeholder="Write caption for the post"   autofocus autocomplete="caption"></textarea>
                            <x-input-error :messages="$errors->get('caption')" class="mt-2" />
                        </div>
                    </div>
            
            
                    <div class="flex flex-col items-center justify-center mt-4 absolute bottom-3 right-3">            
                        <button class="mt-2 bg-sky-500 text-white px-2 h-8 rounded-md text-sm font-semibold border hover:bg-sky-600">
                            {{ __('Create post') }}
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
