<div>
    @if($reasons)
        @foreach($reasons as $reason)
            <div class="fs-6 d-flex my-3">
                <div class="fw-semibold">{{ '- '.$reason?->name }}</div>
            </div>
            @if (!$loop->last)
                <div class="separator separator-dashed"></div>
            @endif
        @endforeach
    @endif
</div>
