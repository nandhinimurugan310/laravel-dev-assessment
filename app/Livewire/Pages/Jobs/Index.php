<?php
namespace App\Livewire\Pages\Jobs;

use App\Models\Job;
use Livewire\Component;

class Index extends Component
{
    public $jobs;

    public function mount()
    {
        // Fetch jobs with the skills names
        $this->jobs = Job::all();
    }

    public function deleteJob($jobId)
    {
        $job = Job::find($jobId);
        if ($job) {
            $job->delete();
            // Remove the job from the array after deletion
            $this->jobs = $this->jobs->where('id', '!=', $jobId);
            session()->flash('message', 'Job deleted successfully.');
        } else {
            session()->flash('error', 'Job not found.');
        }
    }

    public function render()
    {
        return view('livewire.pages.jobs.index');
    }
}
