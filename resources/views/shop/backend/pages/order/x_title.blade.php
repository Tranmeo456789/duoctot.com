<div class="card-header">
    <h3 class="card-title">{{ $title }}</h3>
    <a href="{{ route('order.exportListOrderFileExcel', [
        'day_start' => request()->get('day_start'),
        'day_end' => request()->get('day_end')
    ]) }}" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-secondary card-tools">Xuất file Excel</a>
    @php
        if (!isset($hideBtn) || !$hideBtn ){
            echo '<div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                  </div>';
        }
    @endphp
</div>