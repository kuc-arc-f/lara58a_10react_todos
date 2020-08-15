
@extends('layouts.app_react')

@section('title', '新規作成')

@section('content')
<div id="app"></div>

<!-- -->
<script type="text/babel">

class Create extends React.Component {
    constructor(props){
        super(props)
//        this.state = {title: '', description: ''}
        this.state = {title: '', content: ''}
        this.handleClick = this.handleClick.bind(this);
    }
    componentDidMount(){
    }    
    handleChangeTitle(e){
        this.setState({title: e.target.value})
    }
    handleChangeContent(e){
        this.setState({content: e.target.value})
    }
    handleClick(){
            console.log("#-handleClick")
            this.add_item()
    //        console.log( this.state )
    }  
    async add_item(){
        var task = {
            title: this.state.title,
            content: this.state.content,
        }
        axios.post('/api/apitodos/create_todo' , task ).then(res => {
                console.log(res.data );
                window.location.href = "/react_todos"
        });
    }
    render() {
        return (
        <div>
            <h1>Todos - Create</h1>
            <hr />
            <div className="col-md-6">
                <div className="form-group">
                    <label>Title:</label>
                    <input type="text" className="form-control"
                    onChange={this.handleChangeTitle.bind(this)}/>
                </div>
            </div>
            <div className="col-sm-10">
                <div className="form-group">
                    <label>Content:</label>
                    <textarea type="text" className="form-control" rows="10"
                    onChange={this.handleChangeContent.bind(this)} ></textarea>
                </div>
            </div>
            <br />            
            <div className="form-group">
                <button className="btn btn-primary" onClick={this.handleClick}>
                    Create</button>
            </div>            

        </div>
        )
    }
}
ReactDOM.render(<Create />, document.getElementById('app'));
</script>


@endsection
