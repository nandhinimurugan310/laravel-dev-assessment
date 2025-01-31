<template>
  <Head title="Dashboard" />
  <AuthenticatedLayout>
    <div class="max-w-6xl mx-auto py-10 px-4">
      <!-- Search Section -->
      <div class="bg-gray-50 p-10 rounded-lg text-center shadow-sm">
        <h1 class="text-4xl font-bold text-gray-900">Find your dream job</h1>
        <p class="text-gray-600 mt-2 text-base">
          Looking for jobs? Browse our latest job openings to view & apply to the best jobs today!
        </p>
        <div class="mt-4 flex justify-center gap-3 flex-wrap">
          <!-- Job Title Input -->
          <div class="relative w-80">
            <input
              v-model="form.title"
              type="text"
              placeholder="Job title or keyword"
              class="pl-10 p-3 w-full border rounded-lg text-sm"
            />
            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
          </div>

          <!-- Location Input -->
          <div class="relative w-80">
            <input
              v-model="form.location"
              type="text"
              placeholder="Location"
              class="pl-10 p-3 w-full border rounded-lg text-sm"
            />
            <i class="fas fa-map-marker-alt absolute left-3 top-3 text-gray-400"></i>
          </div>

          <!-- Search Button -->
          <button
            @click="form.get(route('dashboard'))"
            class="bg-blue-600 text-white px-6 py-3 rounded-lg text-sm font-medium hover:bg-blue-700"
          >
            Find jobs
          </button>
        </div>
      </div>

      <!-- Job Listings -->
      <div class="mt-8">
        <!-- No Jobs Found Message -->
        <div v-if="!$page.props.jobs.length" class="text-center text-xl font-semibold text-gray-600">
          No jobs found
        </div>

        <!-- Job Listings -->
        <div v-else class="grid gap-6 grid-cols-2">
          <div
            v-for="job in $page.props.jobs"
            :key="job.id"
            class="p-5 border rounded-lg shadow-md bg-white flex flex-col gap-4 relative"
          >
            <div class="flex items-center gap-3">
              <img
                :src="`/storage/${job.company_logo}`"
                alt="Company Logo"
                class="w-12 h-12 object-contain rounded-lg"
              />
              <div class="flex-1">
                <h2 class="text-lg font-semibold text-gray-900">{{ job.title }}</h2>
                <p class="text-sm text-gray-500">{{ job.company_name }}</p>
              </div>

              <!-- Extra Info Positioned to the Right -->
              <div class="flex gap-1 flex-wrap absolute top-2 right-2">
                <span
                  v-for="info in job.extra_info"
                  :key="info"
                  class="bg-orange-200 px-2 py-1 rounded-full text-xs text-gray-700"
                  >{{ info }}</span
                >
              </div>
            </div>

            <!-- Job Details with Icons -->
            <div class="text-sm text-gray-500 flex gap-2 items-center">
              <i class="fas fa-briefcase text-gray-400"></i>
              <span>{{ job.experience }} Yrs</span> |
              <i class="fas fa-dollar-sign text-gray-400"></i>
              <span>{{ job.salary }} PA</span> |
              <i class="fas fa-map-marker-alt text-gray-400"></i>
              <span>{{ job.location }}</span>
            </div>

            <p class="mt-1 text-gray-600 text-sm truncate">{{ job.description }}</p>

            <!-- Skills Section Placed Below -->
            <div class="mt-2 flex gap-2 flex-wrap">
              <span
                v-for="skill in job.skills"
                :key="skill"
                class="bg-gray-200 px-2 py-1 rounded-full text-xs text-gray-700"
                >{{ skill }}</span
              >
            </div>

            <!-- Time Ago -->
            <div class="absolute bottom-2 right-2 text-xs text-gray-400">{{ timeAgo(job.created_at) }}</div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import { ref } from 'vue';
import { Head, useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const form = useForm({
  title: '',
  location: '',
});

const timeAgo = (date) => {
  const now = new Date();
  const past = new Date(date);
  const diff = Math.floor((now - past) / 1000);
  if (diff < 60) return 'Just now';
  if (diff < 3600) return `${Math.floor(diff / 60)} minutes ago`;
  if (diff < 86400) return `${Math.floor(diff / 3600)} hours ago`;
  return `${Math.floor(diff / 86400)} days ago`;
};
</script>
