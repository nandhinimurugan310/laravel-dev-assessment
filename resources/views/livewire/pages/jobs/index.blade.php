<div>
    <div class="container mx-auto py-4">
        <div class="flex justify-between items-center py-8">
            <h1 class="text-2xl font-bold">Jobs</h1>
        </div>
        <div class="w-full">
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-4 py-3">Title</th>
                                <th scope="col" class="px-4 py-3">Description</th>
                                <th scope="col" class="px-4 py-3">Company Logo</th>
                                <th scope="col" class="px-4 py-3">Company Name</th>
                                <th scope="col" class="px-4 py-3">Experience</th>
                                <th scope="col" class="px-4 py-3">Salary</th>
                                <th scope="col" class="px-4 py-3">Location</th>
                                <th scope="col" class="px-4 py-3">Skills</th>
                                <th scope="col" class="px-4 py-3">Extra</th>
                                <th scope="col" class="px-4 py-3">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jobs as $job)
                                <tr class="border-b dark:border-gray-700">
                                    <th scope="row" class="px-4 py-3 font-semibold text-gray-900 whitespace-nowrap dark:text-white">{{ $job->title }}</th>
                                    <td class="px-4 py-3 whitespace-nowrap">{{ \Str::words($job->description, 7) }}</td>
                                    <td class="px-4 py-3 text-center">
                                        <img src="{{ asset('storage/' . $job->company_logo) }}" class="h-12 w-auto block mx-auto" alt="{{ $job->company_name }}">
                                    </td>
                                    <td><span class="font-medium text-gray-900">{{ $job->company_name }}</span></td>
                                    <td class="px-4 py-3">{{ $job->experience }}</td>
                                    <td class="px-4 py-3">{{ $job->salary }}</td>
                                    <td class="px-4 py-3">{{ $job->location }}</td>
                                    <td class="px-4 py-3">
                                        <!-- Display the skill names with light gray color and compact design -->
                                        <div class="flex items-center flex-wrap gap-1">
                                            @foreach ($job->skills_names as $skillName)
                                                <span class="px-2 py-1 text-xs text-gray-700 bg-gray-200 rounded-full">
                                                    {{ $skillName }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
    <div class="flex items-center flex-wrap gap-2">
        @foreach (is_array($job->extra_info) ? $job->extra_info : explode(',', $job->extra_info) as $extra)
            <span class="px-2 py-1 text-xs text-gray-700 bg-[#ffb833] rounded-full">
                {{ $extra }}
            </span>
        @endforeach
    </div>
</td>

                                    <td class="px-4 py-3 flex items-center justify-end">
                                        <button wire:click="deleteJob({{ $job->id }})" class="text-sm px-3 py-1.5 rounded hover:bg-slate-100 transition-colors text-red-500">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
