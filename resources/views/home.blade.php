<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- font awesome icons  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/style.css">
    <script>
        function adjustTextareaHeight(textarea) {
            textarea.style.height = 'auto';
            textarea.style.height = textarea.scrollHeight + 'px';
        }
    </script>
</head>

<body class="antialiased">
    <div class="header-margin">
        <h1 id="header">Notes</h1>
    </div>

    <div class="note-cards">

        @if (count($notes) > 0)
        @php
        $colors = ['#67b0f4','#73D4B7','#FFA737', '#CEE397', '#C7C4E8', '#CB915E', '#7FEFBD'];
        $colorCount = count($colors);
        @endphp

        @for ($i = 0; $i < count($notes); $i++) <!-- -->
            <div class="note-card" style="background-color: {{ $colors[$i % $colorCount] }}">
                <form method="POST" action="{{ route('remove', $notes[$i]->id) }}">
                    {{ csrf_field() }}
                    <div class="note-card-delete card-button">
                        <i class="fa fa-trash"></i>
                    </div>
                </form>

                <div class="card-content">
                    <h2>{{$notes[$i]->title}}</h2>
                    <p>{{ $notes[$i]->body }}</p>
                </div>
                <div class="button card-button edit-button">
                    <i class="fa fa-pencil"></i>
                </div>
                <div class="card-date">
                    {{ date_format($notes[$i]->created_at ,"F j, Y") }}
                </div>
                <dialog>

                    <form method="POST" action="{{ route('updateNote', $notes[$i]->id) }}">
                        {{ csrf_field() }}
                        <div>
                            <input class="text-input" type="text" name="title" placeholder="my great note..." value="{{ $notes[$i]->title }}" required>
                        </div>

                        <div>
                            <textarea name="body" placeholder="tell us more" oninput="adjustTextareaHeight(this)" required>{{ $notes[$i]->body }}</textarea>
                        </div>

                        <div class="modal-actions">
                            <button type="submit" name="submit">Save</button>
                        </div>
                    </form>
                </dialog>
            </div>
            @endfor
            @else
            <div class="empty-state">
                <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
                <lottie-player src="https://assets6.lottiefiles.com/packages/lf20_4fewfamh.json" background="transparent" speed="1" style="width: 300px; height: 300px;" loop autoplay></lottie-player>
                <p>start by adding some notes</p>
            </div>
            @endif


    </div>

    </div>

    <dialog id="note-modal">
        <form method="POST" action="{{ route('addNote') }}">
            {{ csrf_field() }}
            <div>
                <input class="text-input" type="text" name="title" placeholder="my great note" required>
            </div>

            <div>
                <textarea name="body" placeholder="once upon a time.." oninput="adjustTextareaHeight(this)" required></textarea>
            </div>

            <div class="modal-actions">
                <button type="submit" name="submit">Save</button>
            </div>
        </form>
    </dialog>


    <div id="add-note-button" class="button floating-action-button">
        <i class="fa fa-plus"></i>
    </div>
    <script>
        const fab = document.querySelector("#add-note-button");
        const addDialog = document.getElementById("note-modal");

        fab.addEventListener("click", () => {
            addDialog.showModal();
        });

        const cards = document.getElementsByClassName('note-card');
        [...cards].forEach(e => {
            const removeButton = e.querySelector('.note-card-delete');
            const removeForm = e.querySelector('form');

            e.addEventListener("mouseover", () => {
                removeButton.style.display = "flex";
            });

            e.addEventListener("mouseleave", () => {
                removeButton.style.display = "none";
            });

            removeButton.addEventListener("click", () => {
                removeForm.submit();
            })

            const editDialog = e.querySelector('dialog');
            const editButton = e.querySelector('.edit-button')

            editButton.addEventListener("click", () => {
                editDialog.showModal()
            });
        });
    </script>
</body>

</html>