<script>
    var current_page = 1;
    var records_per_page = 15;

var s = <?php echo json_encode($bodyarray); ?>;

var objJson = <?php echo json_encode($bodyarray); ?>; // Can be obtained from another source, such as your objJson variable

console.log(s);

function prevPage()
{
    if (current_page > 1) {
        current_page--;
        changePage(current_page);
    }
}

function nextPage()
{
    if (current_page < numPages()) {
        current_page++;
        changePage(current_page);
    }
}
    
function changePage(page)
{
    var btn_next = document.getElementById("btn_next");
    var btn_prev = document.getElementById("btn_prev");
    var listing_table = document.getElementById("listingTable");
    var page_span = document.getElementById("page");
 
    // Validate page
    if (page < 1) page = 1;
    if (page > numPages()) page = numPages();

    listing_table.innerHTML = "";

    // for (var i = (page-1) * records_per_page; i < (page * records_per_page) && i < objJson.length; i++) {
    //     listing_table.innerHTML += objJson[i] + "<br>";
    // }
    for (var i = (page-1) * records_per_page; i < (page * records_per_page) && i < objJson.length; i++) {
        listing_table.innerHTML += objJson[i];
    }
    page_span.innerHTML = page + "/" + numPages();

    if (page == 1) {
        btn_prev.style.visibility = "hidden";
    } else {
        btn_prev.style.visibility = "visible";
    }

    if (page == numPages()) {
        btn_next.style.visibility = "hidden";
    } else {
        btn_next.style.visibility = "visible";
    }
}

function numPages()
{
    return Math.ceil(objJson.length / records_per_page);
}

window.onload = function() {
    changePage(1);
};
</script>
@extends('layouts.app')

@section('content')
    <a href="/posts" class="btn btn-outline-dark" role="button">Go Back</a>
    <div><br></div>
    <div class="alert alert-primary" role="alert">
        <h1>{{$post->title}}</h1>
        <p class="h4">{{$post->description}}</p>
    </div>

    <hr>
    {{-- not parsing it as html (we want it because editor gives us html)
    <div>{{$post->body}}</div> --}}
    
    {{-- <div>{!!$post->body!!}</div> This syntax will parse the body --}}
    <p id="listingTable" width="100px"></p>
    
    <a href="javascript:prevPage()" id="btn_prev" class="btn btn-outline-info btn-sm">Prev</a>
    Page: <span id="page"></span>
    <a href="javascript:nextPage()" id="btn_next" class="btn btn-outline-info btn-sm">Next</a>

    <hr>
    <div>
        <span style="font-size:20px;font-weight:500;padding-right:10px">Tags</span>
        @foreach($posttags as $tag)
            <span class="badge badge-info" style="font-size:12px;vertical-align:middle">{{$tag}}</span>
        @endforeach  
    </div>

    <hr>
        <?php 
            $createdByName = is_object($post->user)? $post->user->name : 'Deleted Admin';
        ?>
        <small>Written on {{$post->created_at}} by {{$createdByName}}</small>
    <hr>
    @if (!Auth::guest())        
        @if (Auth::user()->id == $post->user_id)        
            <a href="/posts/{{$post->id}}/edit" class="btn btn-outline-success">Edit</a>
            {!!Form::open(['action'=>['PostsController@destroy',$post->id],'method'=>'POST','class'=>'float-right'])!!}
                {{Form::hidden('_method','DELETE')}}
                {{Form::submit('Delete',['class'=>'btn btn-outline-danger'])}}
            {!!Form::close()!!}
        @endif
    @endif
@endsection