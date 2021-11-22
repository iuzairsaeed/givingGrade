@extends('admin.layouts.app')

@section('content')
<section id="dom">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <p class="mb-0">Charities</p>
                </div>
                <div class="card-body pt-3">

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @foreach ($records as $record )
            <div class="col-md-3 col-xs-6">
                <div class="card w-100">
                    <img src="{{ asset("storage/{$record->image}") }}" class="card-img-top my-3" style="object-fit:cover;" alt="..." height="300">
                    <div class="card-body">
                      <h5 class="card-title text-center">{{$record->title}}</h5>

                      <p class="card-text text-center">{{$record->description}}</p>
                      <div class="d-flex justify-content-between px-2">
                            <strong>Target</strong>
                            <p class="card-text text-center ">{{ $record->goal ? $record->goal->actual_target : 0 }}</p>
                      </div>
                      <input type="hidden"  id="target" value="{{$record->goal ? $record->goal->actual_target - $record->goal->current_target : 0}}">
                      <div class="d-flex justify-content-between px-2">
                        <strong>Donations</strong>
                        <p class="card-text text-center">{{ $record->goal ? $record->goal->current_target : 0 }}</p>
                     </div>

                      <div class="col text-center">
                        <button class="btn btn-primary text-center donateBtn mt-3 px-3" type ="button" id="donateBtn" data-id={{$record->id}}>Donate</button>
                      </div>

                    </div>
                </div>
            </div>
        @endforeach
        <div class=" col-md-12 py-4 text-center justify-content-center" style="margin:auto; display:flex">
            {{-- <nav aria-label="..."> --}}
                {{ $records->links() }}
            {{-- </nav> --}}
        </div>
        <div class="modal" id="donateModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header gradient-green-tea">
                        <h3 class="modal-title text-white" id="myModalLabel3">Donate</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <div class="row">
                            <input type="hidden" class="form-control" name="id" id="id">
                            <input type="hidden" class="form-control" name="id" id="targetDonate">
                            <div class="col-6 m-auto">
                                <div class="form-group text-center" >
                                    <input type="number" min="0" name="donation" id="donation" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="form-actions center pt-2">
                            <button type="button" class="btn btn-danger mr-1">
                                Cancel
                            </button>
                            <button type="submit" class="btn btn-raised btn-success updatebtn">
                                <i class="icon-note"></i> Pay Now
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('afterScript')
<script>
    $('#donateBtn').on('click',function(e){
        e.preventDefault();
        var id = $(this).attr('data-id');
        $('#id').val(id)
        target = $('#target').val()
        $('#donateModal').show()
        $('#targetDonate').val(target)
    });

    $('.btn-danger').on('click',function(e){
        e.preventDefault();
        $('#donateModal').hide()
    });
    $(document).on('click','.updatebtn',function(e){
        e.preventDefault();
        var id = $('#id').val();
        var name = $('#donation').val();
        let target = $('#targetDonate').val()
        $.ajax({
            type: 'POST',
            url: 'charity/'+id+'/donate',
            data: {
                "id":id,
                "donation":name,
                'target' : target,
                "_token":" {{ csrf_token() }}",
            },
            success:function(data){
                swal("Updated!", "Donation payed successfully!", "success").catch(swal.noop);
                var name = $('#donation').val('');
                $('#donateModal').hide()
                $('#ediPerm').modal('hide');
            },
            error: function (e) {
                swal("Error!", e.responseJSON.message, "error");
            }
        });
    });
</script>
@endsection
