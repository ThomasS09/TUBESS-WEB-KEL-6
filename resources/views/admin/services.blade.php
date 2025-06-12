<!DOCTYPE html>
<html>
<head>
    <title>Kelola Layanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <x-app-layout>
        <x-slot name="header">
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Manage Services') }}
                </h2>
                <button onclick="openServiceModal()" class="bg-blue-500 text-white px-4 py-2 rounded-md">
                    Add New Service
                </button>
            </div>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 bg-gray-50 text-left">Name</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left">Price</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left">Duration</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($services as $service)
                                <tr>
                                    <td class="px-6 py-4">{{ $service->name }}</td>
                                    <td class="px-6 py-4">Rp {{ number_format($service->price, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4">{{ $service->duration_minutes }} minutes</td>
                                    <td class="px-6 py-4">
                                        <button onclick="editService({{ $service->id }})" class="text-indigo-600 hover:text-indigo-900">Edit</button>
                                        <button onclick="deleteService({{ $service->id }})" class="ml-4 text-red-600 hover:text-red-900">Delete</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Service Modal -->
        <div id="serviceModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
            <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                <div class="mt-3">
                    <h3 class="text-lg font-medium" id="modal-title">Add New Service</h3>
                    <form id="serviceForm" class="mt-4">
                        @csrf
                        <input type="hidden" id="service_id" name="service_id">
                        
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Service Name</label>
                            <input type="text" id="name" name="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                            <textarea id="description" name="description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700"></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Price (Rp)</label>
                            <input type="number" id="price" name="price" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Duration (minutes)</label>
                            <input type="number" id="duration_minutes" name="duration_minutes" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
                        </div>

                        <div class="flex justify-end">
                            <button type="button" onclick="closeServiceModal()" class="bg-gray-500 text-white px-4 py-2 rounded-md mr-2">Cancel</button>
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </x-app-layout>
</body>
</html>
