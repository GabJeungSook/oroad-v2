<div>
    <p class="font-mono ml-12">
        {{ Carbon\Carbon::parse($getRecord()->created_at)
            ->isToday() ?
            Carbon\Carbon::parse($getRecord()->created_at)->diffForHumans() :
            1 + Carbon\Carbon::parse($getRecord()->created_at)->diffInDays() . ' Day(s)'
        }}
    </p>
</div>
