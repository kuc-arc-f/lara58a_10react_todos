@extends('layouts.app_react')
@section('title', 'todo')

@section('content')
{{ link_to_route('react_todos.create', 'Create' ,null, ['class' => 'btn btn-primary']) }}
<hr class="mt-2 mb-2"/>
<div id="app"></div>

<!-- -->
<script type="text/babel" src="/js/libs/LibTodo.js?a1" ></script>
<script type="text/babel" src="/js/react_component/Todos/IndexRow.js" ></script>

<script type="text/babel">
class List extends React.Component {
    constructor(props) {
        super(props);
        this.state = {data: '', type: 0, items_org: [] }
        this.handleClickTypeNone = this.handleClickTypeNone.bind(this);
        this.handleClickTypeComplete = this.handleClickTypeComplete.bind(this);        
    }
    componentDidMount(){
        this.get_items(0);
    }
    handleClickTypeNone(){
        this.setState({ type: 0 })
// console.log(this.state.type )
        this.get_items(0)
        this.change_complete_tab(0)
    }
    handleClickTypeComplete(){
        this.setState({ type: 1 })
// console.log(this.state.type )
        this.get_items(1)
        this.change_complete_tab(1)
    }    
    change_complete_tab(type){
        $('#nav_complete_none_tab').removeClass('active');
        $('#nav_complete_tab').removeClass('active');
        if(type === 1){
            $('#nav_complete_tab').addClass('active');
        }else{
            $('#nav_complete_none_tab').addClass('active');
        }
    }        
    get_items(type){
console.log( type );        
        axios.get("/api/apitodos").then(res =>  {
            var items = res.data
            var arr = LibTodo.convert_todos(items, type );
//console.log(arr );
            this.setState({ data: arr })
        })
    }    
    tabRow(){
        if(this.state.data instanceof Array){
            return this.state.data.map(function(object, index){
                return <IndexRow obj={object} key={index} />
            })
        }
    }
    render(){
        return (
        <div>
            <h3>index</h3>
            <ul className="nav nav-tabs">
                <li className="nav-item">
                    <button className="nav-link active" id="nav_complete_none_tab"
                    onClick={this.handleClickTypeNone} >
                        未完
                    </button>                    
                </li>
                <li className="nav-item">
                    <button className="nav-link" id="nav_complete_tab"
                    onClick={this.handleClickTypeComplete} >
                        完了
                    </button>                    
                </li>
            </ul>            
            <table className="table table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                {this.tabRow()}
                </tbody>
            </table>            
        </div>
        )
    }
    
}

ReactDOM.render(<List />, document.getElementById('app'));
</script>

@endsection
