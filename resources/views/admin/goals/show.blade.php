@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title-wrap bar-teal">
                    <h4 class="card-title" id="horz-layout-colored-controls">Goal</h4>
                </div>
            </div>
            <div class="card-body px-4">

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="label-control" for="vendor_no">Title </label>
                                <input type="text" id="title" class="form-control border-primary  @error('title') is-invalid @enderror" value={{$record->title}} name="title" placeholder="Enter Title" readonly>
                            </div>
                            @if($errors->first('title'))
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="label-control" for="vendor_no">Description </label>
                                <textarea type="text" id="description"  class="form-control border-primary @error('description') is-invalid @enderror" name="description" placeholder="Enter Description" readonly>{{$record->description}}</textarea>
                            </div>

                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="label-control" for="vendor_no">Actual Target </label>
                                <input type="number" id="currentTarget" value={{$record->actual_target}} class="form-control border-primary @error('currentTarget') is-invalid @enderror" name="currentTarget" placeholder="Enter Current Target" readonly>
                            </div>

                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="label-control" for="vendor_no">Current Target </label>
                                <input type="number" id="currentTarget" value={{$record->current_target}} class="form-control border-primary @error('currentTarget') is-invalid @enderror" name="currentTarget" placeholder="Enter Current Target" readonly>
                            </div>

                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="label-control" for="vendor_no">No Of Student </label>
                                <input type="number" id="student" value={{$record->student_count}} class="form-control border-primary @error('student') is-invalid @enderror" name="student" placeholder="Enter No of Student" readonly>
                            </div>

                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="label-control" for="vendor_no">Start Date </label>
                                <input type="date" id="startDate" value={{$record->starting_date}} class="form-control border-primary @error('startDate') is-invalid @enderror" name="startDate" placeholder="Enter Start date" readonly>
                            </div>

                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label class="label-control" for="vendor_no">End Date </label>
                                <input type="date" id="endDate" value={{$record->ending_date}} class="form-control border-primary @error('endDate') is-invalid @enderror" name="endDate" placeholder="Enter End date" readonly>
                            </div>

                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label class="label-control" for="vendor_no">Status </label>
                                <input type="text" class="form-control border-primary" value ={{$record->active ==1 ? 'YES ' : 'NO'}} readonly>
                            </div>

                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label class="label-control" for="vendor_no">Charity </label>
                                <input type="text" class="form-control border-primary" value ={{$record->charity}} readonly>
                            </div>

                        </div>


                        <div class="col-lg-4 col-md-6 col-sm-12" id="imageShow">
                            <img src="{{ asset("storage/{$record->image}") }}" class="img-thumbnail cursor-pointer" style="width:30%; height:50%;">

                        </div>
                    </div>
                    <div class="form-actions right">
                    <a href="{{route('goals.index')}}">
                        <button type="button" class="btn btn-danger mr-1">
                             Back
                        </button>
                        </a>
                    </div>
            </div>
        </div>
    </div>
</div>

@endsection

