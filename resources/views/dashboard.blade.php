<!DOCTYPE html>
<html>
<head>
    <title>Upload Gambar</title>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<div class="container">
    <h2>Upload Gambar</h2>

    @if(session('success'))
        <p style="color: green; text-align:center;">
            {{ session('success') }}
        </p>
    @endif

    <form action="/dashboard" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="upload-box">
            <input type="file" name="image" required>
        </div>

        <button type="submit">Upload</button>
    </form>

    <hr>

    <h3 style="text-align:center;">Gallery</h3>

    <div class="gallery">
        @foreach($images as $img)
            <div class="card">
                <img src="{{ asset('storage/' . $img->image) }}" alt="gambar">

                <form action="/dashboard/{{ $img->id }}" method="post">
                    @csrf
                    @method('delete')

                    <button class="btn-delete">Hapus</button>
                </form>
            </div>
        @endforeach
    </div>


</div>

</body>
</html>