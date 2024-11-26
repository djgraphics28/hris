<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    // Properties for sorting and filtering
    public $sortBy = 'id';
    public $sortDirection = 'asc';
    public $search = '';
    public $statusFilter = [];

    protected $paginationTheme = 'bootstrap';

    // Listeners to update sorting dynamically
    protected $listeners = [
        'refreshTable' => '$refresh',
    ];

    public function sortBy($field)
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $users = User::query()
            ->when($this->search, function($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%');
            })
            ->when($this->statusFilter, function($query) {
                $query->whereIn('status', $this->statusFilter);
            })
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate(10); // Paginate results

        return view('livewire.users.index', [
            'users' => $users
        ]);
    }
}
