@extends('layouts.app')

@section('title', 'タスク一覧')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">
        タスク一覧
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-9">
                <form>
                    <input name="text" id="txt_1" value="123" ></input>
                </form>
        
                <br />
                new:<br />
                {{ link_to_route('tasks.create', '[ create ]' ) }}
                <br />
                <br />
                <a href="make/"  class="btn btn-primary ">詳細はこちら </a><br />
                <a href="#" onClick="a1();">[ test1 ]</a>

            </div>
            <div class="col-sm-3"> ad :
                @include('element.side_ads', [] )                 
            </div>
        </div><!-- row_end -->

    </div>    
</div><!-- panel_end\ -->
<hr />


@endsection
