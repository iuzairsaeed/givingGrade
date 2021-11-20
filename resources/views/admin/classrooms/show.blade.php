@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title-wrap bar-teal">
                    <h4 class="card-title" id="horz-layout-colored-controls">Classrooms</h4>
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
                                <label class="label-control" for="vendor_no">Status </label>
                                <input type="text" class="form-control border-primary" value ={{$record->active ==1 ? 'YES ' : 'NO'}} readonly>
                            </div>

                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="label-control" for="vendor_no">Teacher </label>
                                <input type="text" class="form-control border-primary" value ={{$record->teacher->name}} readonly>
                            </div>

                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="label-control" for="vendor_no">Subjects </label>
                                {{-- @foreach ($record->subjects as $subject ) --}}

                                <input type="text" class="form-control border-primary" value={{ count($record->subjects()->get()) > 0 ? implode( ",", $record->subjects()->get()->pluck('title')->toArray()) : ""}} readonly>
                                {{-- @endforeach --}}
                            </div>

                        </div>


                        <div class="col-lg-4 col-md-6 col-sm-12" id="imageShow">
                            <img src="{{ asset("storage/{$record->image}") }}" class="img-thumbnail cursor-pointer" style="width:30%; height:50%;">

                        </div>
                    </div>
                    <div class="form-actions right">
                    <a href="{{route('classrooms.index')}}">
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

