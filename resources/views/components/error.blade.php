@if ($errors->any())
    <div class="alert alert-danger animate__animated animate__fadeInDown" x-data="{ showMessage: true }" x-show="showMessage" x-init="setTimeout(() => showMessage = false, 5000)">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error  }}</li>
            @endforeach
        </ul>
    </div>
@endif