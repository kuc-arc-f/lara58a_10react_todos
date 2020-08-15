// LibTodo

//
var LibTodo = {
    convert_todos: function(items, complete){
        var ret = []
        items.forEach(function(item){
            if(item.complete == complete){
                ret.push(item)
            }
        });
        return ret;
    },    

}
