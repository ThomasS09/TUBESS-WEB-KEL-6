<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Vehicle') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('vehicles.store') }}">
                        @csrf

                        <div class="grid grid-cols-1 gap-6 mt-4">
                            <div>
                                <x-label for="brand" :value="__('Brand')" />
                                <x-input id="brand" class="block mt-1 w-full" type="text" name="brand" required />
                                @error('brand')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <x-label for="model" :value="__('Model')" />
                                <x-input id="model" class="block mt-1 w-full" type="text" name="model" required />
                                @error('model')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <x-label for="plate_number" :value="__('Plate Number')" />
                                <x-input id="plate_number" class="block mt-1 w-full" type="text" name="plate_number" required />
                                @error('plate_number')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <x-label for="color" :value="__('Color')" />
                                <x-input id="color" class="block mt-1 w-full" type="text" name="color" required />
                                @error('color')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex justify-end mt-6">
                            <a href="{{ route('vehicles.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 focus:outline-none focus:bg-gray-600">Cancel</a>
                            <x-button class="ml-3">
                                {{ __('Save Vehicle') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>