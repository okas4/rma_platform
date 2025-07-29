@props(['title', 'count' => 0, 'color' => 'primary', 'icon' => 'bar-chart'])

<div class="col-12 col-sm-6 col-lg-4 col-xl-3 mt-3">
    <div class="card bg-{{ $color }} text-white h-100 shadow-sm border-0 rounded-3">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div>
                <h6 class="text-white-50 small mb-1">{{ $title }}</h6>
                <h3 class="mb-0">{{ $count }}</h3>
            </div>
            <i class="bi bi-{{ $icon }} display-5 opacity-25"></i>
        </div>
    </div>
</div>
