<div class="modal fade" id="ModalCreate" tabindex="-1" aria-labelledby="ModalCreate" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="yourModalLabel">Animal Tag</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modal-{{ $fetchedRecord->animal_id }}">

            <div class="container">
                <div class="row justify-content-center">
                    {{-- <div class="row justify-content-center mt-4">
                        <div class="col-md-1">
                            <a id="print" type="button" class="btn btn-outline-primary">Prin</a>
                        </div>
                    </div> --}}
                    <div id='qr_code' class="row justify-content-center">
                        <div class="col-md-7">
                            <div class="card mt-7 text-center">
                                <div class="card-header bg-secondary">
                                    <b>ID : </b>{{ $fetchedRecord->animal_id }} <br>
                                    <b>Breed : </b>{{ $fetchedRecord->breed }} <br>
                                    <b>Gender : </b>{{ $fetchedRecord->gender }} <br>
                                    <b>DOB : </b>{{ $fetchedRecord->birth_date }} <br>
                                </div>
                                <div class="card-body">
                                    {{ QrCode::size(200)->generate($fetchedRecord->animal_id) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button id="print-{{ $fetchedRecord->animal_id }}" type="button" class="btn btn-primary">Print</button>
            </div>
        </div>
    </div>

	<script>
		document.getElementById('print-{{ $fetchedRecord->animal_id }}').addEventListener('click', function() {

		var content = document.getElementById('modal-{{ $fetchedRecord->animal_id }}').innerHTML;
		var originalContent = document.body.innerHTML;

		document.body.innerHTML = content;
		window.print();
		document.body.innerHTML = originalContent;
		location.reload();
		

		});
	</script>
</div>