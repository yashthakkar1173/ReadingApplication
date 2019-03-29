@extends('layouts.app')

@section('content')
<script src="https://cdn.ckeditor.com/4.11.3/standard/ckeditor.js"></script>

    <h1>Edit Post</h1>
    {!!Form::open(['action'=>['PostsController@update',$post->id],'method'=>'POST'])!!}
        <div class="form-group row">
            {{Form::label('title','Title',['class'=>'col-sm-2 col-form-label'])}}
            <div class="col-sm-10">
                {{Form::text('title',$post->title,['class'=>'form-control','placeholder'=>'Title'])}}
            </div>
        </div>
        <div class="form-group row">
            {{Form::label('summarty','Summary',['class'=>'col-sm-2 col-form-label'])}}
            <div class="col-sm-10">
                {{Form::text('description',$post->description,['class'=>'form-control','placeholder'=>'Summary'])}}
            </div>
        </div>
        <div class="form-group row">
            {{Form::label('author','Author',['class'=>'col-sm-2 col-form-label'])}}
            <div class="col-sm-10">
                {{Form::text('author',$post->author,['class'=>'form-control','placeholder'=>'Author'])}}
            </div>
        </div>
        <div class="form-group row">
            {{Form::label('tags','Tags',['class'=>'col-sm-2 col-form-label'])}}
            <div class="col-sm-10">
                {{Form::text('tags',$post->tags,['class'=>'form-control','placeholder'=>'Tags'])}}
            </div>
        </div>

        <div class="form-group row">
            {{Form::label('type','Type',['class'=>'col-sm-2 col-form-label'])}}
            <div class="col-sm-10">
                <?php 
                    if($post->type==1){
                        $bookValue=true;
                        $articleValue=false;
                    }else{
                        $bookValue=false;
                        $articleValue=true;
                    }
                ?>
                <?php echo Form::radio('type', '1',$bookValue)?> Book
                &emsp;&emsp;
                <?php echo Form::radio('type', '0',$articleValue)?> Article
            </div>
        </div>

        <div class="form-group row">
            {{Form::label('body','Body',['class'=>'col-sm-2 col-form-label'])}}
            <div class="col-sm-10">
                {{-- <TODO:> Ck editor not working</TODO:> --}}
                {{-- {{Form::textarea('body','',['id'=>'article-ckeditor','class'=>'form-control','placeholder'=>'Body'])}} --}}
                {{Form::textarea('body',$post->body,['class'=>'form-control','placeholder'=>'Body'])}}
                {{-- <textarea name="editor1"></textarea> --}}
            </div>
        </div>

        <div class="form-group row">
            {{Form::label('evaluation questions','Evaluation Questions',['class'=>'col-sm-2 col-form-label'])}}
            <div class="col-sm-10 form-control'">
                <?php 
                if($post->evaluation==1){
                    $yesValue=true;
                    $noValue=false;
                }else{
                    $yesValue=false;
                    $noValue=true;
                }
                ?>
                <?php echo Form::radio('evaluation', '1',$yesValue)?> Yes
                &emsp;&emsp;
                <?php echo Form::radio('evaluation', '0',$noValue)?> No
            </div>
        </div>
        {{Form::hidden('_method','PUT')}}
        {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
    {!!Form::close()!!}
@endsection