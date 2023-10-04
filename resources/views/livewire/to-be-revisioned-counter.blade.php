<span class="position-absolute top-0 mt-2 start-75 translate-middle badge rounded-pill {{ $articles ? 'bg-2' : '' }}" wire:poll.500ms>
    @if ($articles)
        {{ $articles }}
    @endif
</span>
