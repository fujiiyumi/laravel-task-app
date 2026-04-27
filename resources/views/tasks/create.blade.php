<h1>タスク追加</h1> 

<form action="{{route('tasks.store')}}" method="post">
    @csrf
    <div>
        <label for="title">タイトル</label>
        <input type="text" id="title" name="title" 
        placeholder="タイトルを入力してください" 
        value="{{old('title')}}">
    </div>
    <div>
        <label for="content">内容</label>
        <textarea id="content" name="content" placeholder="内容を入力してください">{{old('content')}}</textarea>
    </div>

    <button type="submit">保存</button>
</form>