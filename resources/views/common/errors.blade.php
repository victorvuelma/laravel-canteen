@if ($errors->any())
    <!-- Form Error List -->
    <div class="alert alert-danger">
        Ops! Algo errado ocorreu!
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif