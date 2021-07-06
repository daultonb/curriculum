@extends('layouts.app')

@section('content')

<div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            @include('programs.wizard.header')

            <div class="card">

                <h3 class="card-header wizard" >
                    Program Learning Outcomes
                </h3>

                <div class="card-body">

                    <h6 class="card-subtitle mb-4 text-center lh-lg">
                        Program-level learning outcomes (PLOs) are the knowledge, skills and attributes that students are expected to attain by the end of a program of study.
                        You can add, edit and delete program outcomes. <strong>It is recommended that a program has 6 - 8 PLOs max</strong>. You can also add program outcome categories to group outcomes (optional).                    
                    </h6>


                    <div class="card m-3">
                        <h5 class="card-header wizard text-start">
                            Categories
                        </h5>

                        <div class="card-body">
                            @if($ploCategories->count() < 1)
                                <div class="alert alert-warning wizard">
                                    <i class="bi bi-exclamation-circle-fill pr-2 fs-5"></i>There are no PLO categories set for this program yet.                    
                                </div>

                            @else
                                <table class="table table-light table-bordered" >
                                    <tr class="table-primary">
                                        <th>PLO Category</th>
                                        <th class="text-center w-25">Actions</th>
                                    </tr>

                                    @foreach($ploCategories as $category)
                                    <tr>
                                        <td>
                                            {{$category->plo_category}}
                                        </td>

                                        <td class="text-center align-middle">                                            
                                            <button type="button" style="width:60px;" class="btn btn-secondary btn-sm m-1" data-toggle="modal" data-target="#editCategoryModal{{$category->plo_category_id}}">
                                                Edit
                                            </button>

                                            <button style="width:60px;" type="button" class="btn btn-danger btn-sm btn btn-danger btn-sm m-1" data-toggle="modal" data-target="#deleteCategories{{$category->plo_category_id}}">
                                                Delete
                                            </button>

                                            <!-- Edit Category Modal -->
                                            <div class="modal fade" id="editCategoryModal{{$category->plo_category_id}}" tabindex="-1" role="dialog" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="editCategoryModalLabel">Edit
                                                                    Program Learning Outcome Category</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>

                                                            <form method="POST"
                                                                action="{{ action('PLOCategoryController@update', $category->plo_category_id) }}">
                                                                @csrf
                                                                {{method_field('PUT')}}

                                                                <div class="modal-body">

                                                                    <div class="form-group row">
                                                                        <label for="category" class="col-md-4 col-form-label text-md-right">Category Name</label>

                                                                        <div class="col-md-8">
                                                                        <input id="category" type="text" class="form-control @error('category') is-invalid @enderror" name="category" value="{{$category->plo_category}}" autofocus>

                                                                            @error('category')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>

                                                                    <input type="hidden" class="form-check-input" name="program_id" value={{$program->program_id}}>

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary col-2 btn-sm" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary col-2 btn-sm">Save</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                            </div>
                                            <!-- End of Edit Category Modal  -->

                                            <!-- Delete Confirmation Modal -->
                                            <div class="modal fade" id="deleteCategories{{$category->plo_category_id}}" tabindex="-1" role="dialog" aria-labelledby="deleteCategories{{$category->plo_category_id}}" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Delete Confirmation</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>

                                                            <div class="modal-body">
                                                            Are you sure you want to delete {{$category->plo_category}}?
                                                            </div>

                                                            <form action="{{route('ploCategory.destroy', $category->plo_category_id)}}" method="POST">
                                                                @csrf
                                                                {{method_field('DELETE')}}
                                                                <input type="hidden" class="form-check-input " name="program_id"
                                                                    value={{$program->program_id}}>

                                                                <div class="modal-footer">
                                                                    <button style="width:60px" type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                                                                    <button style="width:60px" type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                                </div>

                                                            </form>
                                                        </div>
                                                    </div>
                                            </div>
                                            <!-- End of Category Delete Confirmation Modal -->
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>
                            @endif
                        </div>

                        <div class="card-footer p-3">
                            <button type="button" class="btn bg-primary text-white btn-sm col-2 float-right" data-toggle="modal" data-target="#addCategoryModal">
                                <i class="bi bi-plus pr-2"></i>Add PLO Category
                            </button>

                            <!-- Add PLO category Modal -->
                            <div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addCategoryModalLabel">Add a Program Learning Outcome Category</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <form method="POST" action="{{ action('PLOCategoryController@store') }}">
                                            @csrf

                                            <div class="modal-body">
                                                <div class="form-group row">
                                                    <label for="category" class="col-md-4 col-form-label text-md-right">Category Name</label>

                                                    <div class="col-md-8">
                                                        <input id="category" type="text" class="form-control @error('category') is-invalid @enderror" name="category" autofocus>

                                                        @error('category')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>
                                                </div>

                                                <input type="hidden" class="form-check-input" name="program_id" value={{$program->program_id}}>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary col-2 btn-sm" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary col-2 btn-sm">Add</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- End Add PLO category Modal  -->
                        </div>
                    </div>

                    <div class="card m-3">
                        <h5 class="card-header wizard text-start">
                            Program Learning Outcomes
                        </h5>

                        <div class="card-body">
                            @if($plos->count() < 1)
                                <div class="alert alert-warning wizard">
                                    <i class="bi bi-exclamation-circle-fill pr-2 fs-5"></i>There are no program learning outcomes set for this program yet.                    
                                </div>
                            @else
                                @if ($ploCategories->count() < 1)
                                    <table class="table table-light table-bordered" >
                                        <tr class="table-primary">
                                            <th>Program Learning Outcome</th>
                                            <th class="text-center w-25" width>Actions</th>
                                        </tr>

                                        @foreach($plos as $plo)

                                        <tr>
                                            <td>
                                                <b>{{$plo->plo_shortphrase}}</b><br>
                                                {{$plo->pl_outcome}}
                                            </td>
                                            <td class="text-center align-middle">
                                    
                                                <button type="button" style="width:60px;" class="btn btn-secondary btn-sm m-1" data-toggle="modal" data-target="#editPLOModal{{$plo->pl_outcome_id}}">
                                                    Edit
                                                </button>

                                                <button style="width:60px;" type="button" class="btn btn-danger btn-sm btn btn-danger btn-sm m-1" data-toggle="modal" data-target="#deletePLO{{$plo->pl_outcome_id}}">
                                                    Delete
                                                </button>

                                                <!-- Edit PLO Modal -->
                                                <div class="modal fade" id="editPLOModal{{$plo->pl_outcome_id}}" tabindex="-1" role="dialog" aria-labelledby="editPLOModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="editPLOModalLabel">Edit Program Learning Outcome</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>

                                                            <form method="POST" action="{{ action('ProgramLearningOutcomeController@update', $plo->pl_outcome_id) }}">
                                                                @csrf
                                                                {{method_field('PUT')}}

                                                                <div class="modal-body">
                                                                    <div class="form-group row">
                                                                        <label for="plo" class="col-md-4 col-form-label text-md-right">Program Learning Outcome</label>

                                                                        <div class="col-md-8">
                                                                            <textarea id="plo" class="form-control" @error('plo') is-invalid @enderror rows="3" name="plo" required autofocus>{{$plo->pl_outcome}}</textarea>

                                                                            @error('plo')
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $message }}</strong>
                                                                                </span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row">
                                                                        <label for="title" class="col-md-4 col-form-label text-md-right">Short Phrase</label>
                                                                            <div class="col-md-8">
                                                                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{$plo->plo_shortphrase}}" autofocus>
                                                                                    @error('title')
                                                                                        <span class="invalid-feedback" role="alert">
                                                                                            <strong>{{ $message }}</strong>
                                                                                        </span>
                                                                                    @enderror

                                                                                    <small class="form-text text-muted">
                                                                                        Having a short phrase helps with data visualization at the end of this process <b>(4 words max)</b>.
                                                                                    </small>
                                                                                </div>
                                                                            </div>

                                                                            <input type="hidden" class="form-check-input" name="program_id" value={{$program->program_id}}>

                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary col-2 btn-sm" data-dismiss="modal">Close</button>
                                                                            <button type="submit" class="btn btn-primary col-2 btn-sm">Save</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End of Edit PLO Modal -->

                                                <!-- Delete PLO Confirmation Model -->
                                                <div class="modal fade" id="deletePLO{{$plo->pl_outcome_id}}" tabindex="-1" role="dialog" aria-labelledby="deletePLO{{$plo->pl_outcome_id}}" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Delete Confirmation</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>

                                                            <div class="modal-body">
                                                                Are you sure you want to delete {{$plo->plo_shortphrase}}?
                                                            </div>

                                                            <form action="{{route('plo.destroy', $plo->pl_outcome_id)}}" method="POST">
                                                                @csrf
                                                                {{method_field('DELETE')}}
                                                                <input type="hidden" class="form-check-input " name="program_id" value={{$program->program_id}}>

                                                                <div class="modal-footer">
                                                                    <button style="width:60px" type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                                                                    <button style="width:60px" type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                                </div>

                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End of Delete PLO Confirmation Modal -->
                                            </td>
                                        </tr>

                                        @endforeach
                                    </table>
                                @else 
                                    @foreach($ploCategories as $category)
                                        
                                       
                                            <div class="card-header">
                                                {{$category->plo_category}}
                                            </div>
                                       

                                            @if ($category->plos->count() < 1) 
                                                <div class="alert alert-warning wizard">
                                                    <i class="bi bi-exclamation-circle-fill pr-2 fs-5"></i>There are no program learning outcomes set for this PLO category.                   
                                                </div>
                                            @else 
                                                <table class="table table-light table-bordered" >
                                                    <tr class="table-primary">
                                                        <th>Program Learning Outcome</th>
                                                        <th class="text-center w-25" width>Actions</th>
                                                    </tr>

                                                    @foreach ($category->plos as $plo) 
                                                    <tr>
                                                        <td>
                                                            <b>{{$plo->plo_shortphrase}}</b><br>
                                                            {{$plo->pl_outcome}}
                                                        </td>
                                                        <td class="text-center align-middle">
                                                
                                                            <button type="button" style="width:60px;" class="btn btn-secondary btn-sm m-1" data-toggle="modal" data-target="#editCategoryModal{{$plo->pl_outcome_id}}">
                                                                Edit
                                                            </button>

                                                            <button style="width:60px;" type="button" class="btn btn-danger btn-sm btn btn-danger btn-sm m-1" data-toggle="modal" data-target="#deletePLO{{$plo->pl_outcome_id}}">
                                                                Delete
                                                            </button>
                                                        </td>
                                                    </tr>

                                                    <!-- Delete PLO Confirmation Model -->
                                                    <div class="modal fade" id="deletePLO{{$plo->pl_outcome_id}}" tabindex="-1" role="dialog" aria-labelledby="deletePLO{{$plo->pl_outcome_id}}" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                                <h5 class="modal-title">Delete Confirmation</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                </div>

                                                                <div class="modal-body">
                                                                            Are you sure you want to delete {{$plo->plo_shortphrase}}?
                                                                </div>

                                                                            <form action="{{route('plo.destroy', $plo->pl_outcome_id)}}" method="POST">
                                                                                @csrf
                                                                                {{method_field('DELETE')}}
                                                                                <input type="hidden" class="form-check-input " name="program_id"
                                                                                    value={{$program->program_id}}>

                                                                                <div class="modal-footer">
                                                                                    <button style="width:60px" type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                                                                                    <button style="width:60px" type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                                                </div>

                                                                            </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- End of Delete PLO Confirmation Modal -->


                                                    <!-- Edit PLO Modal -->
                                                    <div class="modal fade" id="editPLOModal{{$plo->pl_outcome_id}}" tabindex="-1" role="dialog" aria-labelledby="editPLOModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                                <h5 class="modal-title" id="editPLOModalLabel">Edit Program Learning Outcome</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                </div>

                                                                            <form method="POST" action="{{ action('ProgramLearningOutcomeController@update', $plo->pl_outcome_id) }}">
                                                                                @csrf
                                                                                {{method_field('PUT')}}

                                                                                <div class="modal-body">

                                                                                    <div class="form-group row">
                                                                                        <label for="plo" class="col-md-4 col-form-label text-md-right">Program Learning Outcome</label>

                                                                                        <div class="col-md-8">
                                                                                            <textarea id="plo" class="form-control" @error('plo') is-invalid @enderror rows="3" name="plo" required autofocus>{{$plo->pl_outcome}}
                                                                                            </textarea>

                                                                                            @error('plo')
                                                                                                <span class="invalid-feedback" role="alert">
                                                                                                    <strong>{{ $message }}</strong>
                                                                                                </span>
                                                                                            @enderror
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="form-group row">
                                                                                        <label for="title" class="col-md-4 col-form-label text-md-right">Short Phrase</label>

                                                                                        <div class="col-md-8">
                                                                                            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{$plo->plo_shortphrase}}" autofocus>

                                                                                            @error('title')
                                                                                                <span class="invalid-feedback" role="alert">
                                                                                                    <strong>{{ $message }}</strong>
                                                                                                </span>
                                                                                            @enderror

                                                                                            <small class="form-text text-muted">
                                                                                                Having a short phrase helps with data visualization at the end of this process <b>(4 words max)</b>.
                                                                                            </small>
                                                                                        </div>
                                                                                    </div>

                                                                                    <input type="hidden" class="form-check-input" name="program_id" value={{$program->program_id}}>

                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-secondary col-2 btn-sm" data-dismiss="modal">Close</button>
                                                                                    <button type="submit" class="btn btn-primary col-2 btn-sm">Save</button>
                                                                                </div>
                                                                            </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- End of Edit PLO Modal -->
                                                    @endforeach
                                                </table>
                                            @endif
                                        
                                    @endforeach

                                    
                                        <div class="card-header">
                                            Uncategorized PLOs
                                        </div>

                                        <table class="table table-light table-bordered" >
                                            <tr class="table-primary">
                                                <th>Program Learning Outcome</th>
                                                <th class="text-center w-25" width>Actions</th>
                                            </tr>

                                            @foreach ($plos as $plo)
                                                @if(!$plo->category)
                                                    <tr>
                                                        <td>
                                                            <b>{{$plo->plo_shortphrase}}</b><br>
                                                            {{$plo->pl_outcome}}
                                                        </td>
                                                        <td class="text-center align-middle">
                                                
                                                            <button type="button" style="width:60px;" class="btn btn-secondary btn-sm m-1" data-toggle="modal" data-target="#editCategoryModal{{$plo->pl_outcome_id}}">
                                                                Edit
                                                            </button>

                                                            <button style="width:60px;" type="button" class="btn btn-danger btn-sm btn btn-danger btn-sm m-1" data-toggle="modal" data-target="#deletePLO{{$plo->pl_outcome_id}}">
                                                                Delete
                                                            </button>
                                                        </td>
                                                    </tr>

                                                    <!-- Delete PLO Confirmation Model -->
                                                    <div class="modal fade" id="deletePLO{{$plo->pl_outcome_id}}" tabindex="-1" role="dialog" aria-labelledby="deletePLO{{$plo->pl_outcome_id}}" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                                <h5 class="modal-title">Delete Confirmation</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                </div>

                                                                <div class="modal-body">
                                                                            Are you sure you want to delete {{$plo->plo_shortphrase}}?
                                                                </div>

                                                                            <form action="{{route('plo.destroy', $plo->pl_outcome_id)}}" method="POST">
                                                                                @csrf
                                                                                {{method_field('DELETE')}}
                                                                                <input type="hidden" class="form-check-input " name="program_id"
                                                                                    value={{$program->program_id}}>

                                                                                <div class="modal-footer">
                                                                                    <button style="width:60px" type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                                                                                    <button style="width:60px" type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                                                </div>

                                                                            </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- End of Delete PLO Confirmation Modal -->


                                                    <!-- Edit PLO Modal -->
                                                    <div class="modal fade" id="editPLOModal{{$plo->pl_outcome_id}}" tabindex="-1" role="dialog" aria-labelledby="editPLOModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                                <h5 class="modal-title" id="editPLOModalLabel">Edit Program Learning Outcome</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                </div>

                                                                            <form method="POST" action="{{ action('ProgramLearningOutcomeController@update', $plo->pl_outcome_id) }}">
                                                                                @csrf
                                                                                {{method_field('PUT')}}

                                                                                <div class="modal-body">

                                                                                    <div class="form-group row">
                                                                                        <label for="plo" class="col-md-4 col-form-label text-md-right">Program Learning Outcome</label>

                                                                                        <div class="col-md-8">
                                                                                            <textarea id="plo" class="form-control" @error('plo') is-invalid @enderror rows="3" name="plo" required autofocus>{{$plo->pl_outcome}}
                                                                                            </textarea>

                                                                                            @error('plo')
                                                                                                <span class="invalid-feedback" role="alert">
                                                                                                    <strong>{{ $message }}</strong>
                                                                                                </span>
                                                                                            @enderror
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="form-group row">
                                                                                        <label for="title" class="col-md-4 col-form-label text-md-right">Short Phrase</label>

                                                                                        <div class="col-md-8">
                                                                                            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{$plo->plo_shortphrase}}" autofocus>

                                                                                            @error('title')
                                                                                                <span class="invalid-feedback" role="alert">
                                                                                                    <strong>{{ $message }}</strong>
                                                                                                </span>
                                                                                            @enderror

                                                                                            <small class="form-text text-muted">
                                                                                                Having a short phrase helps with data visualization at the end of this process <b>(4 words max)</b>.
                                                                                            </small>
                                                                                        </div>
                                                                                    </div>

                                                                                    <input type="hidden" class="form-check-input" name="program_id" value={{$program->program_id}}>

                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-secondary col-2 btn-sm" data-dismiss="modal">Close</button>
                                                                                    <button type="submit" class="btn btn-primary col-2 btn-sm">Save</button>
                                                                                </div>
                                                                            </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- End of Edit PLO Modal -->                                                
                                                @endif
                                            @endforeach
                                        </table>
                                
                                @endif
                            @endif
                        </div>

                        <div class="card-footer p-3">
                            <button type="button" class="btn bg-primary text-white btn-sm col-2 float-right" data-toggle="modal" data-target="#addPLOModal">
                                <i class="bi bi-plus pr-2"></i>Add PLO
                            </button>

                            <!-- Add PLO Modal -->
                            <div class="modal fade" id="addPLOModal" tabindex="-1" role="dialog"
                                aria-labelledby="addPLOModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addPLOModalLabel">Add a Program Learning Outcome</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <form method="POST" action="{{ action('ProgramLearningOutcomeController@store') }}">
                                            @csrf

                                            <div class="modal-body">

                                                <div class="form-group row">
                                                    <label for="plo" class="col-md-4 col-form-label text-md-right">Program Learning Outcome</label>

                                                    <div class="col-md-8">
                                                        <textarea id="plo" class="form-control" @error('plo') is-invalid @enderror rows="3" name="plo" required autofocus
                                                        placeholder="Illustrate...">
                                                        </textarea>

                                                        @error('plo')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="title" class="col-md-4 col-form-label text-md-right">Short Phrase</label>

                                                    <div class="col-md-8">
                                                        <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" autofocus
                                                        placeholder="Integrate...">

                                                        @error('title')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror

                                                        <small class="form-text text-muted">
                                                            Having a short phrase helps with data visualization at the end of this process <b>(4 words max)</b>.
                                                        </small>
                                                    </div>
                                                </div>
                                                
                                                @if(count($ploCategories)>0)
                                                    <div class="form-group row">
                                                        <label for="category" class="col-md-4 col-form-label text-md-right">PLO Category</label>

                                                        <div class="col-md-8">

                                                            <select class="custom-select" name="category" id="category" required autofocus>
                                                                <option selected hidden disabled>Choose...</option>
                                                                @foreach($ploCategories as $c)
                                                                    <option value="{{$c->plo_category_id}}">{{$c->plo_category}}</option>
                                                                @endforeach
                                                                <option value="">None</option>
                                                            </select>

                                                            @error('category')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                @endif
                                                
                                                <input type="hidden" class="form-check-input" name="program_id"
                                                    value={{$program->program_id}}>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary col-2 btn-sm"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary col-2 btn-sm">Add</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- End of Add PLO Modal -->
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="card-body mb-4">
                        <a href="{{route('programWizard.step2', $program->program_id)}}">
                            <button class="btn btn-sm btn-primary col-3 float-right">Mapping Scales<i class="bi bi-arrow-right mr-2"></i></button>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {

      $("form").submit(function () {
        // prevent duplicate form submissions
        $(this).find(":submit").attr('disabled', 'disabled');
        $(this).find(":submit").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');

      });
    });
  </script>
@endsection
