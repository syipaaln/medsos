<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>Feed Video</title>
</head>
<body>
    <div class="container">
        <h2 class="text-center" style="margin-top: 40px;">New Feed</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> Input gagal<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('feed.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="col-md-12">
                <div class="flex items-center justify-center h-48 mb-3">
                    <video id="preview-video" class="object-cover object-center w-full" controls style="max-height: 200px; display: none;">
                        <source src="" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
                <div class="form-group">
                    <strong>Video:</strong>
                    <input id="videoInput" type="file" name="video" class="form-control" placeholder="Video" accept="video/*">
                </div>
            </div>
            <div class="form-group">
                <strong>Caption:</strong>
                <textarea name="caption" class="form-control"></textarea>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-4">
                <button type="submit" class="btn btn-primary rounded-pill" style="width: 100%">Create</button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('videoInput').addEventListener('change', function (event) {
            const videoPreview = document.getElementById('preview-video');
            const file = event.target.files[0];
    
            if (file) {
                const videoURL = URL.createObjectURL(file);
                videoPreview.src = videoURL;
                videoPreview.style.display = 'block';
            } else {
                videoPreview.style.display = 'none';
            }
        });
    </script>
</body>
</html>