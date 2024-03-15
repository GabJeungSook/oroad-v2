<div>
    {{ Carbon\Carbon::parse($getRecord()->created_at)->diffInDays() }}
</div>
