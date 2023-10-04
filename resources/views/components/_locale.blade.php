<form action="{{ route('set_language_locale', $lang) }}" method="POST" class="d-flex">
    @csrf
    <button type="submit" class="nav-link flag" style="background-color: transparent; border: none;">
        <span class="fi fi-{{$nation}}" style="font-size: 0.8rem;"></span>
    </button>
</form>