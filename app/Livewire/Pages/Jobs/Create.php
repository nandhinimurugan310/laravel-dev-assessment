<?php
namespace App\Livewire\Pages\Jobs;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Job;
use App\Models\Skill;

class Create extends Component
{
    use WithFileUploads;

    public $title, $description, $experience, $salary, $location, $extra_info, $company_name, $company_logo, $skills = [];

    protected $rules = [
        'title' => 'required|min:3',
        'description' => 'required|min:10',
        'experience' => 'required',
        'salary' => 'required',
        'location' => 'required',
        'company_name' => 'required',
        'company_logo' => 'nullable|image|max:1024',
        'skills' => 'required|array|min:1',
    ];

    public function save()
    {
        $this->validate();

        if ($this->company_logo) {
            $logoPath = $this->company_logo->store('logos', 'public');
        } else {
            $logoPath = null;
        }

        Job::create([
            'title' => $this->title,
            'description' => $this->description,
            'experience' => $this->experience,
            'salary' => $this->salary,
            'location' => $this->location,
            'extra_info' => $this->extra_info,
            'company_name' => $this->company_name,
            'company_logo' => $logoPath,
            'skills' => $this->skills,
        ]);

        session()->flash('message', 'Job created successfully!');
        $this->reset();
    }

    public function render()
    {
        return view('livewire.pages.jobs.create', [
            'allSkills' => Skill::all()
        ]);
    }
}

