@extends('layouts.app_react')

@section('title', "編集")

@section('content')
<div id="app"></div>


<!-- -->
<script type="text/babel">
var task_id= {{$task_id}};

class Edit extends React.Component {
	constructor(props) {
		super(props);
		this.state = {
			title: '', 
			content: '' ,
			complete : 0,
			complete_btn_name: "完了登録",
		}
		this.id = parseInt(props.id)
		this.handleClick = this.handleClick.bind(this);
		this.handleClickDelete = this.handleClickDelete.bind(this);
		this.handleClickComplete = this.handleClickComplete.bind(this);
//console.log(this.id)
	}
	componentDidMount(){
		this.get_item( this.id )        
	}
	async get_item(id){
		var task = {
				id: id,
			};    
		axios.post('/api/apitodos/get_item' ,task).then(res =>  {
			var dat = res.data
console.log( dat )
			var item = dat
			var btn_name = "完了登録"
			if(item.complete === 1){
				btn_name = "未完に戻す"
			}			
			this.setState({ 
				title: item.title,
				content: item.content,
				complete: item.complete,
				complete_btn_name: btn_name,
			});            
//console.log( this.state.data.title )
		})        
	}
	async save_item(){
		var task = {
			id: this.id,
			title: this.state.title,
			content: this.state.content,
			complete: this.state.complete,
		}
		axios.post('/api/apitodos/update_todo', task ).then(res => {
//                console.log(res.data );
			window.location.href = "/react_todos"
		});        
	}
	async delete_item(){
		var task = {
			id: this.id ,
		};        
		axios.post('/api/apitodos/delete_todo',task).then(res =>  {
			console.log( res.data )
			window.location.href = "/react_todos"
		})        
	}      
	handleChangeTitle(e){
		this.setState({title: e.target.value})
	}
	handleChangeContent(e){
		this.setState({content: e.target.value})
	}
	handleClick(){
			console.log("#-handleClick")
			this.save_item()
	//        console.log( this.state )
	} 
	handleClickDelete(){
		console.log("#-handleClickDelete")
		this.delete_item()
	}
    handleClickComplete(){
        var value= 0
        if(this.state.complete == 0){
            value = 1
		}
		var task = {
			id: this.id,
			complete: value,
		}
		axios.post('/api/apitodos/update_todo', task ).then(res => {
//                console.log(res.data );
			window.location.href = "/react_todos"
		});		
    }	   
	render(){
		return (
		<div className="mt-2">
			<h1>Edit</h1>
			<hr />
			<div className="form-group">
				<label>Title :</label>
				<input type="text" className="form-control" onChange={this.handleChangeTitle.bind(this)}
				value={this.state.title}  />
			</div>
			<div className="form-group">
				<label>content</label>
				<textarea className="form-control"  rows="10" value={this.state.content}
					onChange={this.handleChangeContent.bind(this)}></textarea>
			</div>   
			<button onClick={this.handleClick}>Save</button>
            <hr />
            <button className="btn btn-outline-success btn-sm mt-2"
				onClick={this.handleClickComplete}>
                {this.state.complete_btn_name}
            </button>			
			<hr />            
			<button onClick={this.handleClickDelete}>Delete</button>
		</div>
		)
	}
}
ReactDOM.render(<Edit id={task_id}  />, document.getElementById('app'));
</script>

@endsection
