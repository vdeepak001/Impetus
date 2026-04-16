<?php

namespace App\Livewire\SuperAdmin\CourseSubTitle;

use App\Models\CourseTitle;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\Url;
use Livewire\Component;

class Index extends Component
{
    #[Url(except: '')]
    public $search = '';

    #[Url(except: 'all')]
    public $filter = 'all';

    #[Url(except: 'id')]
    public $sortField = 'id';

    #[Url(except: 'desc')]
    public $sortDirection = 'desc';

    public $perPage = 10;

    public $page = 1;

    public function setFilter($filter)
    {
        $this->filter = $filter;
        $this->resetPage();
    }

    public function toggleStatus($titleId)
    {
        $title = CourseTitle::findOrFail($titleId);
        $newStatus = ! $title->active_status;

        CourseTitle::where('course_id', $title->course_id)->update([
            'active_status' => $newStatus,
        ]);

        $status = $newStatus ? 'activated' : 'deactivated';

        $this->dispatch('notify',
            message: "Sub-title {$status} successfully!",
            title: 'Status Updated',
            variant: 'success'
        );
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingFilter(): void
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
        $this->resetPage();
    }

    public function gotoPage($page): void
    {
        $this->page = (int) $page;
    }

    public function render()
    {
        $query = CourseTitle::with(['course', 'user']);

        // Apply Search
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('title_name', 'like', '%'.$this->search.'%')
                    ->orWhereHas('course', function ($cq) {
                        $cq->where('couse_name', 'like', '%'.$this->search.'%');
                    });
            });
        }

        // Apply Status Filter
        if ($this->filter === 'active') {
            $query->where('active_status', true);
        } elseif ($this->filter === 'inactive') {
            $query->where('active_status', false);
        }

        $rows = $query->orderBy('id')->get()
            ->groupBy('course_id')
            ->map(function ($items) {
                $latestItem = $items->sortByDesc('id')->first();

                $mergedTitles = $items
                    ->pluck('title_name')
                    ->flatMap(function ($titleName) {
                        return preg_split('/\s*(?:\||!)\s*/', (string) $titleName) ?: [];
                    })
                    ->map(fn ($title) => trim($title))
                    ->filter()
                    ->unique()
                    ->values();

                $latestItem->title_name = $mergedTitles->implode(' | ');
                $latestItem->active_status = $items->contains(fn ($item) => (bool) $item->active_status);

                return $latestItem;
            })
            ->values();

        if ($this->sortField === 'title_name') {
            $rows = $this->sortDirection === 'asc'
                ? $rows->sortBy('title_name', SORT_NATURAL | SORT_FLAG_CASE)->values()
                : $rows->sortByDesc('title_name', SORT_NATURAL | SORT_FLAG_CASE)->values();
        }

        if ($this->sortField === 'active_status') {
            $rows = $this->sortDirection === 'asc'
                ? $rows->sortBy('active_status')->values()
                : $rows->sortByDesc('active_status')->values();
        }

        if ($this->sortField === 'id') {
            $rows = $this->sortDirection === 'asc'
                ? $rows->sortBy('id')->values()
                : $rows->sortByDesc('id')->values();
        }

        $currentPage = max(1, (int) $this->page);
        $total = $rows->count();
        $items = $rows->slice(($currentPage - 1) * $this->perPage, $this->perPage)->values();
        $subTitles = new LengthAwarePaginator(
            $items,
            $total,
            $this->perPage,
            $currentPage,
            ['path' => request()->url(), 'pageName' => 'page']
        );

        return view('livewire.super-admin.course-sub-title.index', [
            'subTitles' => $subTitles,
            'totalCount' => $rows->count(),
            'activeCount' => $rows->where('active_status', true)->count(),
            'inactiveCount' => $rows->where('active_status', false)->count(),
        ]);
    }
}
