<!doctype html>
<html lang="eS">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #007bff;
            color: white;
        }

        #browseFile, #cancelUpload {
            transition: all 0.3s;
        }

        #browseFile:hover, #cancelUpload:hover {
            transform: scale(1.05);
        }

        .progress {
            height: 25px;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container pt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center py-3">
                        <h5 class="mb-0">Subir Archivo Podcast</h5>
                    </div>
    
                    <input type="hidden" id="episodio_id" name="episodio_id" value="2">
    
                    <div class="card-body">
                        <div id="upload-container" class="text-center mb-4">
                            <button id="browseFile" class="btn btn-primary btn-lg">
                                <i class="fas fa-cloud-upload-alt me-2"></i> Buscar Archivo
                            </button>
                            <button id="cancelUpload" class="btn btn-danger btn-lg ms-2" style="display: none;">
                                <i class="fas fa-times me-2"></i> Cancelar
                            </button>
                        </div>
                        <div id="file-name" class="text-center mb-3"></div>
                        <div class="progress mt-3" style="height: 25px; display: none;">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"
                                style="width: 0%; background-color: #00338D;">0%</div>
                        </div>
                    </div>
    
                    <div class="card-footer p-4" style="display: none;">
                        <audio id="audioPreview" src="" controls style="width: 100%;"></audio>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/resumablejs@1.1.0/resumable.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script type="text/javascript">
        var episodioId = document.getElementById("episodio_id").value;

        let browseFile = $('#browseFile');
        let resumable = new Resumable({
            target: '{{ route('admin.episodios.upload_largetest') }}',
            query: {
                _token: '{{ csrf_token() }}',
                episodioId: episodioId,
            },
            fileType: ['mp3'],
            headers: {
                'Accept': 'application/json'
            },
            testChunks: false,
            throttleProgressCallbacks: 1,
            maxFiles: 1,
        });

        resumable.assignBrowse(browseFile[0]);

        resumable.on('fileAdded', function(file) {
            if (resumable.files.length > 1) {
                alert('Error: Solo se permite subir un archivo a la vez.');
                resumable.removeFile(file);
                return;
            }
            $('#file-name').text('Archivo seleccionado: ' + file.fileName);
            $('#cancelUpload').show();
            $('#browseFile').hide();
            showProgress();
            resumable.upload();
        });

        resumable.on('fileProgress', function(file) {
            updateProgress(Math.floor(file.progress() * 100));
        });

        resumable.on('fileSuccess', function(file, response) {
            response = JSON.parse(response);
            $('#audioPreview').attr('src', response.path);
            $('.card-footer').show();
            $('#file-name').text('Archivo subido: ' + file.fileName);
        });

        resumable.on('fileError', function(file, response) {
            alert('Error al subir el archivo.');
            clearUpload();
        });

        let progress = $('.progress');

        function showProgress() {
            progress.find('.progress-bar').css('width', '0%');
            progress.find('.progress-bar').html('0%');
            progress.find('.progress-bar').removeClass('bg-success');
            progress.show();
        }

        function updateProgress(value) {
            progress.find('.progress-bar').css('width', `${value}%`)
            progress.find('.progress-bar').html(`${value}%`)
        }

        function hideProgress() {
            progress.hide();
        }

        function clearUpload() {
            hideProgress();
            $('#file-name').text('');
            $('.card-footer').hide();
            $('#cancelUpload').hide();
            $('#browseFile').show();
            resumable.cancel();
        }

        $('#cancelUpload').on('click', function() {
            clearUpload();
        });
    </script>
</body>

</html>