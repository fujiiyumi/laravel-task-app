<x-app-layout>
<h1>タスク編集</h1>
@if($errors->any())
<ul>
    @foreach($errors->all() as $error)
    <li style="color: red;">{{$error}}</li>
    @endforeach
</ul>
@endif

<form action="{{route('tasks.update',$task->id)}}" method="post">
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

    <div>
        <label for="status">ステータス</label>
        <select name="status" id="status">
            <option value="未着手" @selected($task->status==='未着手')>未着手</option>
            <option value="進行中" @selected($task->status==='進行中')>進行中</option>
            <option value="完了" @selected($task->status==='完了')>完了</option>
        </select>
    </div>
    
    <button type="submit">更新</button>
</form>

</x-app-layout>