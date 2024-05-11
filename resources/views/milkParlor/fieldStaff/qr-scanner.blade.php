<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

</head>
<body>

    @if ($errors->any())
          <script>
            window.onload = function() {
                @foreach ($errors->all() as $error)
                    alert("{{ $error }}");
                @endforeach
            };
          </script>
    @endif

    <div class="container">
        <form action="/fieldStaff/milkParlor/add_milking_queue" method="POST">
            @csrf
            <div class="row justify-content-center">
                <div id='qr_code' class="row justify-content-center">
                    <div class="col-md-7">
                        <div class="card mt-7 text-center">
                            <div class="card-header text-bg-dark">
                                <h5>Animal ID:</h5>
                                <div class="row justify-content-center">
                                    <div class="col-md-3">
                                        <input type="text" name="animal_id" id="animal_id" class="form-control" value="{{ old('animal_id') }}" placeholder="Scan QR">
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <video id="preview" width="50%"></video>
                            </div>
                            <div class="card-footer text-bg-dark">
                                <button type="submit" class="btn btn-success">Add</button>
                                <a href="javascript:history.back(1)" class="btn btn-warning">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
        Instascan.Camera.getCameras().then(function(cameras){
            if(cameras.length > 0){
                scanner.start(cameras[0]);
            }
            else{
                alert('No Cameras found.');
            }

        }).catch(function(e) {
            console.error(e);
        });

        scanner.addListener('scan',function(c){
            document.getElementById('animal_id').value=c;
            // document.getElementByID('text').innerText=c;
            // console.log('Hemal');
        });
    </script>
    
</body>
</html>



