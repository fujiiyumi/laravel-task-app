<form action="{{route('tasks.update,$task->id')}}" method="post">
    @csrf
    @method('PUT')
    <div>
        <label for="title">タイトル</label>
        <input type="text" id="title" name="title" value="{{old('title',$task->title)}}">
    </div>
    <div>
        <label for="content">内容</label>
        <textarea id="content" name="content">{{old('content',$task->content)}}</textarea>
    </div>
    
    <button type="submit">更新</button>
</form>