<div class="container mx-auto py-4">
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold">Skills</h1>
    </div>

    @if(session()->has('message'))
        <div class="bg-green-100 text-green-700 p-2 rounded my-2">
            {{ session('message') }}
        </div>
    @endif

    <div class="flex mt-4">
        <div class="w-2/3">
            <table class="w-full border-collapse border border-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border px-4 py-2">Name</th>
                        <th class="border px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($skills as $skill)
                        <tr>
                            <td class="border px-4 py-2">{{ $skill->name }}</td>
                            <td class="border px-4 py-2">
                                <button wire:click="deleteSkill({{ $skill->id }})" class="text-red-500">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $skills->links() }}
        </div>

        <div class="w-1/3 ml-4">
            <div class="bg-white p-4 shadow rounded">
                <h2 class="text-lg font-bold">Add new skill</h2>
                <input type="text" wire:model="name" class="w-full border p-2 rounded mt-2" placeholder="Skill name">
                @error('name') <p class="text-red-500">{{ $message }}</p> @enderror
                <button wire:click="addSkill" class="bg-blue-500 text-white px-4 py-2 rounded mt-2">Save</button>
            </div>
        </div>
    </div>
</div>
