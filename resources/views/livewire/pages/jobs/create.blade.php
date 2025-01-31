<div class="container mx-auto py-4">
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold">Create new job posting</h1>
    </div>

    @if(session()->has('message'))
        <div class="bg-green-100 text-green-700 p-2 rounded my-2">
            {{ session('message') }}
        </div>
    @endif

    <div class="flex">
        <!-- Job Details Section -->
        <div class="w-2/3 p-4 bg-white shadow rounded">
            <h2 class="font-semibold mb-4">Job details</h2>

            <div class="mb-2">
                <label class="block font-medium">Title</label>
                <input type="text" wire:model="title" placeholder="Enter job title"
                    class="w-full border p-2 rounded">
                @error('title') <p class="text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="mb-2">
                <label class="block font-medium">Description</label>
                <textarea wire:model="description" placeholder="Enter job description"
                    class="w-full border p-2 rounded"></textarea>
                @error('description') <p class="text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="flex gap-2">
                <div class="w-1/2">
                    <label class="block font-medium">Experience</label>
                    <input type="text" wire:model="experience" placeholder="Eg. 1-3 Yrs"
                        class="w-full border p-2 rounded">
                    @error('experience') <p class="text-red-500">{{ $message }}</p> @enderror
                </div>

                <div class="w-1/2">
                    <label class="block font-medium">Salary</label>
                    <input type="text" wire:model="salary" placeholder="Eg. 3-5 LPA"
                        class="w-full border p-2 rounded">
                    @error('salary') <p class="text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="flex gap-2 mt-2">
                <div class="w-1/2">
                    <label class="block font-medium">Location</label>
                    <input type="text" wire:model="location" placeholder="Eg. Remote / Chennai"
                        class="w-full border p-2 rounded">
                    @error('location') <p class="text-red-500">{{ $message }}</p> @enderror
                </div>

                <div class="w-1/2">
                    <label class="block font-medium">Extra Info</label>
                    <input type="text" wire:model="extra_info" placeholder="Eg. Full-Time, Urgent"
                        class="w-full border p-2 rounded">
                </div>
            </div>
        </div>

        <!-- Company Details Section -->
        <div class="w-1/3 ml-4">
            <div class="p-4 bg-white shadow rounded">
                <h2 class="font-semibold mb-4">Company details</h2>

                <div class="mb-2">
                    <label class="block font-medium">Name</label>
                    <input type="text" wire:model="company_name" placeholder="Company Name"
                        class="w-full border p-2 rounded">
                    @error('company_name') <p class="text-red-500">{{ $message }}</p> @enderror
                </div>

                <!-- Logo Upload with Live Preview Using Alpine.js -->
                <div class="mb-2" x-data="{ preview: null }">
                    <label class="block font-medium">Logo</label>
                    <input type="file" wire:model="company_logo" 
                        @change="preview = URL.createObjectURL($event.target.files[0])" 
                        class="w-full border p-2 rounded">
                    @error('company_logo') <p class="text-red-500">{{ $message }}</p> @enderror

                    <!-- Preview Image Before Upload -->
                    <template x-if="preview">
                        <img :src="preview" class="w-24 h-24 mt-2 rounded border">
                    </template>
                </div>
            </div>

            <!-- Skills Selection -->
            <div class="p-4 bg-white shadow rounded mt-4">
                <h2 class="font-semibold mb-4">Skills</h2>
                <select wire:model="skills" multiple class="w-full border p-2 rounded">
                    <option value="">Select Skill</option>
                    @foreach($allSkills as $skill)
                        <option value="{{ $skill->id }}">{{ $skill->name }}</option>
                    @endforeach
                </select>
                @error('skills') <p class="text-red-500">{{ $message }}</p> @enderror
            </div>
        </div>
    </div>

    <!-- Save Button -->
    <button wire:click="save" class="bg-blue-500 text-white px-4 py-2 rounded mt-4 hover:bg-blue-600">
        Save
    </button>
</div>
