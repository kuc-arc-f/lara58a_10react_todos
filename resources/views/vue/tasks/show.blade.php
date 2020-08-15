@extends('layouts.app')

@section('title', "show")

@section('content')
<div id="app">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h1>Show</h1>
            <hr />
            <br />
        </div>
        <div class="panel-body">
            <div>タスク名: @{{this.title}}
            </div>
            <div>content: @{{this.content}}
            </div>
        </div>
        <div class="panel-footer">
            <br />
            {{ link_to_route('vue_tasks.index', '戻る' ,null, ['class' => 'btn btn-outline-primary']) }}
        </div>
    </div>
</div>
<!-- -->
<script>
new Vue({
    el: '#app',
    created () {
    },  
    mounted: function() {
        this.getItem();
    },      
    data: {
        item: null,
        title: '',
        content  : '',
    },
    methods: {
        getItem: function() {
            var task = {
                "id" : {{$task_id}},
            };
            axios.post('/api/apitasks/get_item' ,task).then(res => {
                this.item = res.data;
                this.title = this.item.title;
                this.content = this.item.content;
console.log(this.item  );                
                console.log(res.data.id );
//                window.location.href = '/tasks';
            });
        }        
    }
});
</script>

@endsection
