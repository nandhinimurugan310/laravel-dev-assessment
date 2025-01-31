<?php
namespace App\Livewire\Pages\Skills;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Skill;
use Illuminate\Support\Facades\DB;

class Index extends Component
{
    use WithPagination;
    
    public $name;

    protected $rules = [
        'name' => 'required|unique:skills,name|min:3',
    ];

    public function addSkill()
    {
        $this->validate();
        DB::table('skills')->insert(['name' => $this->name, 'created_at' => now(), 'updated_at' => now()]);
        $this->reset('name');
        session()->flash('message', 'Skill added successfully!');
    }

    public function deleteSkill($id)
    {
        DB::table('skills')->where('id', $id)->delete();
        session()->flash('message', 'Skill deleted successfully!');
    }

    public function render()
    {
        return view('livewire.pages.skills.index', [
            'skills' => DB::table('skills')->latest()->paginate(10)
        ]);
    }
}
